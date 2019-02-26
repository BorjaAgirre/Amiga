<?php
/**
 * PEAR_PackageFile_v2, package.xml version 2.0
 *
 * PHP versions 4 and 5
 *
 * @category   pear
 * @package    PEAR
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  1997-2009 The Authors
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @version    CVS: $Id$
 * @link       http://pear.php.net/package/PEAR
 * @since      File available since Release 1.4.0a1
 */
/**
 * For error handling
 */
require_once 'PEAR/ErrorStack.php';
/**
 * @category   pear
 * @package    PEAR
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  1997-2009 The Authors
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @version    Release: 1.9.5
 * @link       http://pear.php.net/package/PEAR
 * @since      Class available since Release 1.4.0a1
 */
class PEAR_PackageFile_v2
{

    /**
     * Parsed package information
     * @var array
     * @access private
     */
    var $_packageInfo = array();

    /**
     * path to package .tgz or false if this is a local/extracted package.xml
     * @var string|false
     * @access private
     */
    var $_archiveFile;

    /**
     * path to package .xml or false if this is an abstract parsed-from-string xml
     * @var string|false
     * @access private
     */
    var $_packageFile;

    /**
     * This is used by file analysis routines to log progress information
     * @var PEAR_Common
     * @access protected
     */
    var $_logger;

    /**
     * This is set to the highest validation level that has been validated
     *
     * If the package.xml is invalid or unknown, this is set to 0.  If
     * normal validation has occurred, this is set to PEAR_VALIDATE_NORMAL.  If
     * downloading/installation validation has occurred it is set to PEAR_VALIDATE_DOWNLOADING
     * or INSTALLING, and so on up to PEAR_VALIDATE_PACKAGING.  This allows validation
     * "caching" to occur, which is particularly important for package validation, so
     * that PHP files are not validated twice
     * @var int
     * @access private
     */
    var $_isValid = 0;

    /**
     * True if the filelist has been validated
     * @param bool
     */
    var $_filesValid = false;

    /**
     * @var PEAR_Registry
     * @access protected
     */
    var $_registry;

    /**
     * @var PEAR_Config
     * @access protected
     */
    var $_config;

    /**
     * Optional Dependency group requested for installation
     * @var string
     * @access private
     */
    var $_requestedGroup = false;

    /**
     * @var PEAR_ErrorStack
     * @access protected
     */
    var $_stack;

    /**
     * Namespace prefix used for tasks in this package.xml - use tasks: whenever possible
     */
    var $_tasksNs;

    /**
     * Determines whether this packagefile was initialized only with partial package info
     *
     * If this package file was constructed via parsing REST, it will only contain
     *
     * - package name
     * - channel name
     * - dependencies
     * @var boolean
     * @access private
     */
    var $_incomplete = true;

    /**
     * @var PEAR_PackageFile_v2_Validator
     */
    var $_v2Validator;

    /**
     * The constructor merely sets up the private error stack
     */
    function PEAR_PackageFile_v2()
    {
        $this->_stack = new PEAR_ErrorStack('PEAR_PackageFile_v2', false, null);
        $this->_isValid = false;
    }

    /**
     * To make unit-testing easier
     * @param PEAR_Frontend_*
     * @param array options
     * @param PEAR_Config
     * @return PEAR_Downloader
     * @access protected
     */
    function &getPEARDownloader(&$i, $o, &$c)
    {
        $z = &new PEAR_Downloader($i, $o, $c);
        return $z;
    }

    /**
     * To make unit-testing easier
     * @param PEAR_Config
     * @param array options
     * @param array package name as returned from {@link PEAR_Registry::parsePackageName()}
     * @param int PEAR_VALIDATE_* constant
     * @return PEAR_Dependency2
     * @access protected
     */
    function &getPEARDependency2(&$c, $o, $p, $s = PEAR_VALIDATE_INSTALLING)
    {
        if (!class_exists('PEAR_Dependency2')) {
            require_once 'PEAR/Dependency2.php';
        }
        $z = &new PEAR_Dependency2($c, $o, $p, $s);
        return $z;
    }

    function getInstalledBinary()
    {
        return isset($this->_packageInfo['#binarypackage']) ? $this->_packageInfo['#binarypackage'] :
            false;
    }

    /**
     * Installation of source package has failed, attempt to download and install the
     * binary version of this package.
     * @param PEAR_Installer
     * @return array|false
     */
    function installBinary(&$installer)
    {
        if (!OS_WINDOWS) {
            $a = false;
            return $a;
        }
        if ($this->getPackageType() == 'extsrc' || $this->getPackageType() == 'zendextsrc') {
            $releasetype = $this->getPackageType() . 'release';
            if (!is_array($installer->getInstallPackages())) {
                $a = false;
                return $a;
            }
            foreach ($installer->getInstallPackages() as $p) {
                if ($p->isExtension($this->_packageInfo['providesextension'])) {
                    if ($p->getPackageType() != 'extsrc' && $p->getPackageType() != 'zendextsrc') {
                        $a = false;
                        return $a; // the user probably downloaded it separately
                    }
                }
            }
            if (isset($this->_packageInfo[$releasetype]['binarypackage'])) {
                $installer->log(0, 'Attempting to download binary version of extension "' .
                    $this->_packageInfo['providesextension'] . '"');
                $params = $this->_packageInfo[$releasetype]['binarypackage'];
                if (!is_array($params) || !isset($params[0])) {
                    $params = array($params);
                }
                if (isset($this->_packageInfo['channel'])) {
                    foreach ($params as $i => $param) {
                        $params[$i] = array('channel' => $this->_packageInfo['channel'],
                            'package' => $param, 'version' => $this->getVersion());
                    }
                }
                $dl = &$this->getPEARDownloader($installer->ui, $installer->getOptions(),
                    $installer->config);
                $verbose = $dl->config->get('verbose');
                $dl->config->set('verbose', -1);
                foreach ($params as $param) {
                    PEAR::pushErrorHandling(PEAR_ERROR_RETURN);
                    $ret = $dl->download(array($param));
                    PEAR::popErrorHandling();
                    if (is_array($ret) && count($ret)) {
                        break;
                    }
                }
                $dl->config->set('verbose', $verbose);
                if (is_array($ret)) {
                    if (count($ret) == 1) {
                        $pf = $ret[0]->getPackageFile();
                        PEAR::pushErrorHandling(PEAR_ERROR_RETURN);
                        $err = $installer->install($ret[0]);
                        PEAR::popErrorHandling();
                        if (is_array($err)) {
                            $this->_packageInfo['#binarypackage'] = $ret[0]->getPackage();
                            // "install" self, so all dependencies will work transparently
                            $this->_registry->addPackage2($this);
                            $installer->log(0, 'Download and install of binary extension "' .
                                $this->_registry->parsedPackageNameToString(
                                    array('channel' => $pf->getChannel(),
                                          'package' => $pf->getPackage()), true) . '" successful');
                            $a = array($ret[0], $err);
                            return $a;
                        }
                        $installer->log(0, 'Download and install of binary extension "' .
                            $this->_registry->parsedPackageNameToString(
                                    array('channel' => $pf->getChannel(),
                                          'package' => $pf->getPackage()), true) . '" failed');
                    }
                }
            }
        }
        $a = false;
        return $a;
    }

    /**
     * @return string|false Extension name
     */
    function getProvidesExtension()
    {
        if (in_array($this->getPackageType(),
              array('extsrc', 'extbin', 'zendextsrc', 'zendextbin'))) {
            if (isset($this->_packageInfo['providesextension'])) {
                return $this->_packageInfo['providesextension'];
            }
        }
        return false;
    }

    /**
     * @param string Extension name
     * @return bool
     */
    function isExtension($extension)
    {
        if (in_array($this->getPackageType(),
              array('extsrc', 'extbin', 'zendextsrc', 'zendextbin'))) {
            return $this->_packageInfo['providesextension'] == $extension;
        }
        return false;
    }

    /**
     * Tests whether every part of the package.xml 1.0 is represented in
     * this package.xml 2.0
     * @param PEAR_PackageFile_v1
     * @return bool
     */
    function isEquivalent($pf1)
    {
        if (!$pf1) {
            return true;
        }
        if ($this->getPackageType() == 'bundle') {
            return false;
        }
        $this->_stack->getErrors(true);
        if (!$pf1->validate(PEAR_VALIDATE_NORMAL)) {
            return false;
        }
        $pass = true;
        if ($pf1->getPackage() != $this->getPackage()) {
            $this->_differentPackage($pf1->getPackage());
            $pass = false;
        }
        if ($pf1->getVersion() != $this->getVersion()) {
            $this->_differentVersion($pf1->getVersion());
            $pass = false;
        }
        if (trim($pf1->getSummary()) != $this->getSummary()) {
            $this->_differentSummary($pf1->getSummary());
            $pass = false;
        }
        if (preg_replace('/\s+/', '', $pf1->getDescription()) !=
              preg_replace('/\s+/', '', $this->getDescription())) {
            $this->_differentDescription($pf1->getDescription());
            $pass = false;
        }
        if ($pf1->getState() != $this->getState()) {
            $this->_differentState($pf1->getState());
            $pass = false;
        }
        if (!strstr(preg_replace('/\s+/', '', $this->getNotes()),
              preg_replace('/\s+/', '', $pf1->getNotes()))) {
            $this->_differentNotes($pf1->getNotes());
            $pass = false;
        }
        $mymaintainers = $this->getMaintainers();
        $yourmaintainers = $pf1->getMaintainers();
        for ($i1 = 0; $i1 < count($yourmaintainers); $i1++) {
            $reset = false;
            for ($i2 = 0; $i2 < count($mymaintainers); $i2++) {
                if ($mymaintainers[$i2]['handle'] == $yourmaintainers[$i1]['handle']) {
                    if ($mymaintainers[$i2]['role'] != $yourmaintainers[$i1]['role']) {
                        $this->_differentRole($mymaintainers[$i2]['handle'],
                            $yourmaintainers[$i1]['role'], $mymaintainers[$i2]['role']);
                        $pass = false;
                    }
                    if ($mymaintainers[$i2]['email'] != $yourmaintainers[$i1]['email']) {
                        $this->_differentEmail($mymaintainers[$i2]['handle'],
                            $yourmaintainers[$i1]['email'], $mymaintainers[$i2]['email']);
                        $pass = false;
                    }
                    if ($mymaintainers[$i2]['name'] != $yourmaintainers[$i1]['name']) {
                        $this->_differentName($mymaintainers[$i2]['handle'],
                            $yourmaintainers[$i1]['name'], $mymaintainers[$i2]['name']);
                        $pass = false;
                    }
                    unset($mymaintainers[$i2]);
                    $mymaintainers = array_values($mymaintainers);
                    unset($yourmaintainers[$i1]);
                    $yourmaintainers = array_values($yourmaintainers);
                    $reset = true;
                    break;
                }
            }
            if ($reset) {
                $i1 = -1;
            }
        }
        $this->_unmatchedMaintainers($mymaintainers, $yourmaintainers);
        $filelist = $this->getFilelist();
        foreach ($pf1->getFilelist() as $file => $atts) {
            if (!isset($filelist[$file])) {
                $this->_missingFile($file);
                $pass = false;
            }
        }
        return $pass;
    }

    function _differentPackage($package)
    {
        $this->_stack->push(__FUNCTION__, 'error', array('package' => $package,
            'self' => $this->getPackage()),
            'package.xml 1.0 package "%package%" does not match "%self%"');
    }

    function _differentVersion($version)
    {
        $this->_stack->push(__FUNCTION__, 'error', array('version' => $version,
            'self' => $this->getVersion()),
            'package.xml 1.0 version "%version%" does not match "%self%"');
    }

    function _differentState($state)
    {
        $this->_stack->push(__FUNCTION__, 'error', array('state' => $state,
            'self' => $this->getState()),
            'package.xml 1.0 state "%state%" does not match "%self%"');
    }

    function _differentRole($handle, $role, $selfrole)
    {
        $this->_stack->push(__FUNCTION__, 'error', array('handle' => $handle,
            'role' => $role, 'self' => $selfrole),
            'package.xml 1.0 maintainer "%handle%" role "%role%" does not match "%self%"');
    }

    function _differentEmail($handle, $email, $selfemail)
    {
        $this->_stack->push(__FUNCTION__, 'error', array('handle' => $handle,
            'email' => $email, 'self' => $selfemail),
            'package.xml 1.0 maintainer "%handle%" email "%email%" does not match "%self%"');
    }

    function _differentName($handle, $name, $selfname)
    {
        $this->_stack->push(__FUNCTION__, 'error', array('handle' => $handle,
            'name' => $name, 'self' => $selfname),
            'package.xml 1.0 maintainer "%handle%" name "%name%" does not match "%self%"');
    }

    function _unmatchedMaintainers($my, $yours)
    {
        if ($my) {
            array_walk($my, create_function('&$i, $k', '$i = $i["handle"];'));
            $this->_stack->push(__FUNCTION__, 'error', array('handles' => $my),
                'package.xml 2.0 has unmatched extra maintainers "%handles%"');
        }
        if ($yours) {
            array_walk($yours, create_function('&$i, $k', '$i = $i["handle"];'));
            $this->_stack->push(__FUNCTION__, 'error', array('handles' => $yours),
                'package.xml 1.0 has unmatched extra maintainers "%handles%"');
        }
    }

    function _differentNotes($notes)
    {
        $truncnotes = strlen($notes) < 25 ? $notes : substr($notes, 0, 24) . '...';
        $truncmynotes = strlen($this->getNotes()) < 25 ? $this->getNotes() :
            substr($this->getNotes(), 0, 24) . '...';
        $this->_stack->push(__FUNCTION__, 'error', array('notes' => $truncnotes,
            'self' => $truncmynotes),
            'package.xml 1.0 release notes "%notes%" do not match "%self%"');
    }

    function _differentSummary($summary)
    {
        $truncsummary = strlen($summary) < 25 ? $summary : substr($summary, 0, 24) . '...';
        $truncmysummary = strlen($this->getsummary()) < 25 ? $this->getSummary() :
            substr($this->getsummary(), 0, 24) . '...';
        $this->_stack->push(__FUNCTION__, 'error', array('summary' => $truncsummary,
            'self' => $truncmysummary),
            'package.xml 1.0 summary "%summary%" does not match "%self%"');
    }

    function _differentDescription($description)
    {
        $truncdescription = trim(strlen($description) < 25 ? $description : substr($description, 0, 24) . '...');
        $truncmydescription = trim(strlen($this->getDescription()) < 25 ? $this->getDescription() :
            substr($this->getdescription(), 0, 24) . '...');
        $this->_stack->push(__FUNCTION__, 'error', array('description' => $truncdescription,
            'self' => $truncmydescription),
            'package.xml 1.0 description "%description%" does not match "%self%"');
    }

    function _missingFile($file)
    {
        $this->_stack->push(__FUNCTION__, 'error', array('file' => $file),
            'package.xml 1.0 file "%file%" is not present in <contents>');
    }

    /**
     * WARNING - do not use this function unless you know what you're doing
     */
    function setRawState($state)
    {
        if (!isset($this->_packageInfo['stability'])) {
            $this->_packageInfo['stability'] = array();
        }
        $this->_packageInfo['stability']['release'] = $state;
    }

    /**
     * WARNING - do not use this function unless you know what you're doing
     */
    function setRawCompatible($compatible)
    {
        $this->_packageInfo['compatible'] = $compatible;
    }

    /**
     * WARNING - do not use this function unless you know what you're doing
     */
    function setRawPackage($package)
    {
        $this->_packageInfo['name'] = $package;
    }

    /**
     * WARNING - do not use this function unless you know what you're doing
     */
    function setRawChannel($channel)
    {
        $this->_packageInfo['channel'] = $channel;
    }

    function setRequestedGroup($group)
    {
        $this->_requestedGroup = $group;
    }

    function getRequestedGroup()
    {
        if (isset($this->_requestedGroup)) {
            return $this->_requestedGroup;
        }
        return false;
    }

    /**
     * For saving in the registry.
     *
     * Set the last version that was installed
     * @param string
     */
    function setLastInstalledVersion($version)
    {
        $this->_packageInfo['_lastversion'] = $version;
    }

    /**
     * @return string|false
     */
    function getLastInstalledVersion()
    {
        if (isset($this->_packageInfo['_lastversion'])) {
            return $this->_packageInfo['_lastversion'];
        }
        return false;
    }

    /**
     * Determines whether this package.xml has post-install scripts or not
     * @return array|false
     */
    function listPostinstallScripts()
    {
        $filelist = $this->getFilelist();
        $contents = $this->getContents();
        $contents = $contents['dir']['file'];
        if (!is_array($contents) || !isset($contents[0])) {
            $contents = array($contents);
        }
        $taskfiles = array();
        foreach ($contents as $file) {
            $atts = $file['attribs'];
            unset($file['attribs']);
            if (count($file)) {
                $taskfiles[$atts['name']] = $file;
            }
        }
        $common = new PEAR_Common;
        $common->debug = $this->_config->get('verbose');
        $this->_scripts = array();
        $ret = array();
        foreach ($taskfiles as $name => $tasks) {
            if (!isset($filelist[$name])) {
                // ignored files will not be in the filelist
                continue;
            }
            $atts = $filelist[$name];
            foreach ($tasks as $tag => $raw) {
                $task = $this->getTask($tag);
                $task = &new $task($this->_config, $common, PEAR_TASK_INSTALL);
                if ($task->isScript()) {
                    $ret[] = $filelist[$name]['installed_as'];
                }
            }
        }
        if (count($ret)) {
            return $ret;
        }
        return false;
    }

    /**
     * Initialize post-install scripts for running
     *
     * This method can be used to detect post-install scripts, as the return value
     * indicates whether any exist
     * @return bool
     */
    function initPostinstallScripts()
    {
        $filelist = $this->getFilelist();
        $contents = $this->getContents();
        $contents = $contents['dir']['file'];
        if (!is_array($contents) || !isset($contents[0])) {
            $contents = array($contents);
        }
        $taskfiles = array();
        foreach ($contents as $file) {
            $atts = $file['attribs'];
            unset($file['attribs']);
            if (count($file)) {
                $taskfiles[$atts['name']] = $file;
            }
        }
        $common = new PEAR_Common;
        $common->debug = $this->_config->get('verbose');
        $this->_scripts = array();
        foreach ($taskfiles as $name => $tasks) {
            if (!isset($filelist[$name])) {
                // file was not installed due to installconditions
                continue;
            }
            $atts = $filelist[$name];
            foreach ($tasks as $tag => $raw) {
                $taskname = $this->getTask($tag);
                $task = &new $taskname($this->_config, $common, PEAR_TASK_INSTALL);
                if (!$task->isScript()) {
                    continue; // scripts are only handled after installation
                }
                $lastversion = isset($this->_packageInfo['_lastversion']) ?
                    $this->_packageInfo['_lastversion'] : null;
                $task->init($raw, $atts, $lastversion);
                $res = $task->startSession($this, $atts['installed_as']);
                if (!$res) {
                    continue; // skip this file
                }
                if (PEAR::isError($res)) {
                    return $res;
                }
                $assign = &$task;
                $this->_scripts[] = &$assign;
            }
        }
        if (count($this->_scripts)) {
            return true;
        }
        return false;
    }

    function runPostinstallScripts()
    {
        if ($this->initPostinstallScripts()) {
            $ui = &PEAR_Frontend::singleton();
            if ($ui) {
                $ui->runPostinstallScripts($this->_scripts, $this);
            }
        }
    }


    /**
     * Convert a recursive set of <dir> and <file> tags into a single <dir> tag with
     * <file> tags.
     */
    function flattenFilelist()
    {
        if (isset($this->_packageInfo['bundle'])) {
            return;
        }
        $filelist = array();
        if (isset($this->_packageInfo['contents']['dir']['dir'])) {
            $this->_getFlattenedFilelist($filelist, $this->_packageInfo['contents']['dir']);
            if (!isset($filelist[1])) {
                $filelist = $filelist[0];
            }
            $this->_packageInfo['contents']['dir']['file'] = $filelist;
            unset($this->_packageInfo['contents']['dir']['dir']);
        } else {
            // else already flattened but check for baseinstalldir propagation
            if (isset($this->_packageInfo['contents']['dir']['attribs']['baseinstalldir'])) {
                if (isset($this->_packageInfo['contents']['dir']['file'][0])) {
                    foreach ($this->_packageInfo['contents']['dir']['file'] as $i => $file) {
                        if (isset($file['attribs']['baseinstalldir'])) {
                            continue;
                        }
                        $this->_packageInfo['contents']['dir']['file'][$i]['attribs']['baseinstalldir']
                            = $this->_packageInfo['contents']['dir']['attribs']['baseinstalldir'];
                    }
                } else {
                    if (!isset($this->_packageInfo['contents']['dir']['file']['attribs']['baseinstalldir'])) {
                       $this->_packageInfo['contents']['dir']['file']['attribs']['baseinstalldir']
                            = $this->_packageInfo['contents']['dir']['attribs']['baseinstalldir'];
                    }
                }
            }
        }
    }

    /**
     * @param array the final flattened file list
     * @param array the current directory being processed
     * @param string|false any recursively inherited baeinstalldir attribute
     * @param string private recursion variable
     * @return array
     * @access protected
     */
    function _getFlattenedFilelist(&$files, $dir, $baseinstall = false, $path = '')
    {
        if (isset($dir['attribs']) && isset($dir['attribs']['baseinstalldir'])) {
            $baseinstall = $dir['attribs']['baseinstalldir'];
        }
        if (isset($dir['dir'])) {
            if (!isset($dir['dir'][0])) {
                $dir['dir'] = array($dir['dir']);
            }
            foreach ($dir['dir'] as $subdir) {
                if (!isset($subdir['attribs']) || !isset($subdir['attribs']['name'])) {
                    $name = '*unknown*';
                } else {
                    $name = $subdir['attribs']['name'];
                }
                $newpath = empty($path) ? $name :
                    $path . '/' . $name;
                $this->_getFlattenedFilelist($files, $subdir,
                    $baseinstall, $newpath);
            }
        }
        if (isset($dir['file'])) {
            if (!isset($dir['file'][0])) {
                $dir['file'] = array($dir['file']);
            }
            foreach ($dir['file'] as $file) {
                $attrs = $file['attribs'];
                $name = $attrs['name'];
                if ($baseinstall && !isset($attrs['baseinstalldir'])) {
                    $attrs['baseinstalldir'] = $baseinstall;
                }
                $attrs['name'] = empty($path) ? $name : $path . '/' . $name;
                $attrs['name'] = preg_replace(array('!\\\\+!', '!/+!'), array('/', '/'),
                    $attrs['name']);
                $file['attribs'] = $attrs;
                $files[] = $file;
            }
        }
    }

    function setConfig(&$config)
    {
        $this->_config = &$config;
        $this->_registry = &$config->getRegistry();
    }

    function setLogger(&$logger)
    {
        if (!is_object($logger) || !method_exists($logger, 'log')) {
            return PEAR::raiseError('Logger must be compatible with PEAR_Common::log');
        }
        $this->_logger = &$logger;
    }

    /**
     * WARNING - do not use this function directly unless you know what you're doing
     */
    function setDeps($deps)
    {
        $this->_packageInfo['dependencies'] = $deps;
    }

    /**
     * WARNING - do not use this function directly unless you know what you're doing
     */
    function setCompatible($compat)
    {
        $this->_packageInfo['compatible'] = $compat;
    }

    function setPackagefile($file, $archive = false)
    {
        $this->_packageFile = $file;
        $this->_archiveFile = $archive ? $archive : $file;
    }

    /**
     * Wrapper to {@link PEAR_ErrorStack::getErrors()}
     * @param boolean determines whether to purge the error stack after retrieving
     * @return array
     */
    function getValidationWarnings($purge = true)
    {
        return $this->_stack->getErrors($purge);
    }

    function getPackageFile()
    {
        return $this->_packageFile;
    }

    function getArchiveFile()
    {
        return $this->_archiveFile;
    }


    /**
     * Directly set the array that defines this packagefile
     *
     * WARNING: no validation.  This should only be performed by internal methods
     * inside PEAR or by inputting an array saved from an existing PEAR_PackageFile_v2
     * @param array
     */
    function fromArray($pinfo)
    {
        unset($pinfo['old']);
        unset($pinfo['xsdversion']);
        // If the changelog isn't an array then it was passed in as an empty tag
        if (isset($pinfo['changelog']) && !is_array($pinfo['changelog'])) {
          unset($pinfo['changelog']);
        }
        $this->_incomplete = false;
        $this->_packageInfo = $pinfo;
    }

    function isIncomplete()
    {
        return $this->_incomplete;
    }

    /**
     * @return array
     */
    function toArray($forreg = false)
    {
        if (!$this->validate(PEAR_VALIDATE_NORMAL)) {
            return false;
        }
        return $this->getArray($forreg);
    }

    function getArray($forReg = false)
    {
        if ($forReg) {
            $arr = $this->_packageInfo;
            $arr['old'] = array();
            $arr['old']['version'] = $this->getVersion();
            $arr['old']['release_date'] = $this->getDate();
            $arr['old']['release_state'] = $this->getState();
            $arr['old']['release_license'] = $this->getLicense();
            $arr['old']['release_notes'] = $this->getNotes();
            $arr['old']['release_deps'] = $this->getDeps();
            $arr['old']['maintainers'] = $this->getMaintainers();
            $arr['xsdversion'] = '2.0';
            return $arr;
        } else {
            $info = $this->_packageInfo;
            unset($info['dirtree']);
            if (isset($info['_lastversion'])) {
                unset($info['_lastversion']);
            }
            if (isset($info['#binarypackage'])) {
                unset($info['#binarypackage']);
            }
            return $info;
        }
    }

    function packageInfo($field)
    {
        $arr = $this->getArray(true);
        if ($field == 'state') {
            return $arr['stability']['release'];
        }
        if ($field == 'api-version') {
            return $arr['version']['api'];
        }
        if ($field == 'api-state') {
            return $arr['stability']['api'];
        }
        if (isset($arr['old'][$field])) {
            if (!is_string($arr['old'][$field])) {
                return null;
            }
            return $arr['old'][$field];
        }
        if (isset($arr[$field])) {
            if (!is_string($arr[$field])) {
                return null;
            }
            return $arr[$field];
        }
        return null;
    }

    function getName()
    {
        return $this->getPackage();
    }

    function getPackage()
    {
        if (isset($this->_packageInfo['name'])) {
            return $this->_packageInfo['name'];
        }
        return false;
    }

    function getChannel()
    {
        if (isset($this->_packageInfo['uri'])) {
            return '__uri';
        }
        if (isset($this->_packageInfo['channel'])) {
            return strtolower($this->_packageInfo['channel']);
        }
        return false;
    }

    function getUri()
    {
        if (isset($this->_packageInfo['uri'])) {
            return $this->_packageInfo['uri'];
        }
        return false;
    }

    function getExtends()
    {
        if (isset($this->_packageInfo['extends'])) {
            return $this->_packageInfo['extends'];
        }
        return false;
    }

    function getSummary()
    {
        if (isset($this->_packageInfo['summary'])) {
            return $this->_packageInfo['summary'];
        }
        return false;
    }

    function getDescription()
    {
        if (isset($this->_packageInfo['description'])) {
            return $this->_packageInfo['description'];
        }
        return false;
    }

    function getMaintainers($raw = false)
    {
        if (!isset($this->_packageInfo['lead'])) {
            return false;
        }
        if ($raw) {
            $ret = array('lead' => $this->_packageInfo['lead']);
            (isset($this->_packageInfo['developer'])) ?
                $ret['developer'] = $this->_packageInfo['developer'] :null;
            (isset($this->_packageInfo['contributor'])) ?
                $ret['contributor'] = $this->_packageInfo['contributor'] :null;
            (isset($this->_packageInfo['helper'])) ?
                $ret['helper'] = $this->_packageInfo['helper'] :null;
            return $ret;
        } else {
            $ret = array();
            $leads = isset($this->_packageInfo['lead'][0]) ? $this->_packageInfo['lead'] :
                array($this->_packageInfo['lead']);
            foreach ($leads as $lead) {
                $s = $lead;
                $s['handle'] = $s['user'];
                unset($s['user']);
                $s['role'] = 'lead';
                $ret[] = $s;
            }
            if (isset($this->_packageInfo['developer'])) {
                $leads = isset($this->_packageInfo['developer'][0]) ?
                    $this->_packageInfo['developer'] :
                    array($this->_packageInfo['developer']);
                foreach ($leads as $maintainer) {
                    $s = $maintainer;
                    $s['handle'] = $s['user'];
                    unset($s['user']);
                    $s['role'] = 'developer';
                    $ret[] = $s;
                }
            }
            if (isset(