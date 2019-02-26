<?php
/**
 * PEAR_PackageFile_v1, package.xml version 1.0
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
 * Error code if parsing is attempted with no xml extension
 */
define('PEAR_PACKAGEFILE_ERROR_NO_XML_EXT', 3);

/**
 * Error code if creating the xml parser resource fails
 */
define('PEAR_PACKAGEFILE_ERROR_CANT_MAKE_PARSER', 4);

/**
 * Error code used for all sax xml parsing errors
 */
define('PEAR_PACKAGEFILE_ERROR_PARSER_ERROR', 5);

/**
 * Error code used when there is no name
 */
define('PEAR_PACKAGEFILE_ERROR_NO_NAME', 6);

/**
 * Error code when a package name is not valid
 */
define('PEAR_PACKAGEFILE_ERROR_INVALID_NAME', 7);

/**
 * Error code used when no summary is parsed
 */
define('PEAR_PACKAGEFILE_ERROR_NO_SUMMARY', 8);

/**
 * Error code for summaries that are more than 1 line
 */
define('PEAR_PACKAGEFILE_ERROR_MULTILINE_SUMMARY', 9);

/**
 * Error code used when no description is present
 */
define('PEAR_PACKAGEFILE_ERROR_NO_DESCRIPTION', 10);

/**
 * Error code used when no license is present
 */
define('PEAR_PACKAGEFILE_ERROR_NO_LICENSE', 11);

/**
 * Error code used when a <version> version number is not present
 */
define('PEAR_PACKAGEFILE_ERROR_NO_VERSION', 12);

/**
 * Error code used when a <version> version number is invalid
 */
define('PEAR_PACKAGEFILE_ERROR_INVALID_VERSION', 13);

/**
 * Error code when release state is missing
 */
define('PEAR_PACKAGEFILE_ERROR_NO_STATE', 14);

/**
 * Error code when release state is invalid
 */
define('PEAR_PACKAGEFILE_ERROR_INVALID_STATE', 15);

/**
 * Error code when release state is missing
 */
define('PEAR_PACKAGEFILE_ERROR_NO_DATE', 16);

/**
 * Error code when release state is invalid
 */
define('PEAR_PACKAGEFILE_ERROR_INVALID_DATE', 17);

/**
 * Error code when no release notes are found
 */
define('PEAR_PACKAGEFILE_ERROR_NO_NOTES', 18);

/**
 * Error code when no maintainers are found
 */
define('PEAR_PACKAGEFILE_ERROR_NO_MAINTAINERS', 19);

/**
 * Error code when a maintainer has no handle
 */
define('PEAR_PACKAGEFILE_ERROR_NO_MAINTHANDLE', 20);

/**
 * Error code when a maintainer has no handle
 */
define('PEAR_PACKAGEFILE_ERROR_NO_MAINTROLE', 21);

/**
 * Error code when a maintainer has no name
 */
define('PEAR_PACKAGEFILE_ERROR_NO_MAINTNAME', 22);

/**
 * Error code when a maintainer has no email
 */
define('PEAR_PACKAGEFILE_ERROR_NO_MAINTEMAIL', 23);

/**
 * Error code when a maintainer has no handle
 */
define('PEAR_PACKAGEFILE_ERROR_INVALID_MAINTROLE', 24);

/**
 * Error code when a dependency is not a PHP dependency, but has no name
 */
define('PEAR_PACKAGEFILE_ERROR_NO_DEPNAME', 25);

/**
 * Error code when a dependency has no type (pkg, php, etc.)
 */
define('PEAR_PACKAGEFILE_ERROR_NO_DEPTYPE', 26);

/**
 * Error code when a dependency has no relation (lt, ge, has, etc.)
 */
define('PEAR_PACKAGEFILE_ERROR_NO_DEPREL', 27);

/**
 * Error code when a dependency is not a 'has' relation, but has no version
 */
define('PEAR_PACKAGEFILE_ERROR_NO_DEPVERSION', 28);

/**
 * Error code when a dependency has an invalid relation
 */
define('PEAR_PACKAGEFILE_ERROR_INVALID_DEPREL', 29);

/**
 * Error code when a dependency has an invalid type
 */
define('PEAR_PACKAGEFILE_ERROR_INVALID_DEPTYPE', 30);

/**
 * Error code when a dependency has an invalid optional option
 */
define('PEAR_PACKAGEFILE_ERROR_INVALID_DEPOPTIONAL', 31);

/**
 * Error code when a dependency is a pkg dependency, and has an invalid package name
 */
define('PEAR_PACKAGEFILE_ERROR_INVALID_DEPNAME', 32);

/**
 * Error code when a dependency has a channel="foo" attribute, and foo is not a registered channel
 */
define('PEAR_PACKAGEFILE_ERROR_UNKNOWN_DEPCHANNEL', 33);

/**
 * Error code when rel="has" and version attribute is present.
 */
define('PEAR_PACKAGEFILE_ERROR_DEPVERSION_IGNORED', 34);

/**
 * Error code when type="php" and dependency name is present
 */
define('PEAR_PACKAGEFILE_ERROR_DEPNAME_IGNORED', 35);

/**
 * Error code when a configure option has no name
 */
define('PEAR_PACKAGEFILE_ERROR_NO_CONFNAME', 36);

/**
 * Error code when a configure option has no name
 */
define('PEAR_PACKAGEFILE_ERROR_NO_CONFPROMPT', 37);

/**
 * Error code when a file in the filelist has an invalid role
 */
define('PEAR_PACKAGEFILE_ERROR_INVALID_FILEROLE', 38);

/**
 * Error code when a file in the filelist has no role
 */
define('PEAR_PACKAGEFILE_ERROR_NO_FILEROLE', 39);

/**
 * Error code when analyzing a php source file that has parse errors
 */
define('PEAR_PACKAGEFILE_ERROR_INVALID_PHPFILE', 40);

/**
 * Error code when analyzing a php source file reveals a source element
 * without a package name prefix
 */
define('PEAR_PACKAGEFILE_ERROR_NO_PNAME_PREFIX', 41);

/**
 * Error code when an unknown channel is specified
 */
define('PEAR_PACKAGEFILE_ERROR_UNKNOWN_CHANNEL', 42);

/**
 * Error code when no files are found in the filelist
 */
define('PEAR_PACKAGEFILE_ERROR_NO_FILES', 43);

/**
 * Error code when a file is not valid php according to _analyzeSourceCode()
 */
define('PEAR_PACKAGEFILE_ERROR_INVALID_FILE', 44);

/**
 * Error code when the channel validator returns an error or warning
 */
define('PEAR_PACKAGEFILE_ERROR_CHANNELVAL', 45);

/**
 * Error code when a php5 package is packaged in php4 (analysis doesn't work)
 */
define('PEAR_PACKAGEFILE_ERROR_PHP5', 46);

/**
 * Error code when a file is listed in package.xml but does not exist
 */
define('PEAR_PACKAGEFILE_ERROR_FILE_NOTFOUND', 47);

/**
 * Error code when a <dep type="php" rel="not"... is encountered (use rel="ne")
 */
define('PEAR_PACKAGEFILE_PHP_NO_NOT', 48);

/**
 * Error code when a package.xml contains non-ISO-8859-1 characters
 */
define('PEAR_PACKAGEFILE_ERROR_NON_ISO_CHARS', 49);

/**
 * Error code when a dependency is not a 'has' relation, but has no version
 */
define('PEAR_PACKAGEFILE_ERROR_NO_DEPPHPVERSION', 50);

/**
 * Error code when a package has no lead developer
 */
define('PEAR_PACKAGEFILE_ERROR_NO_LEAD', 51);

/**
 * Error code when a filename begins with "."
 */
define('PEAR_PACKAGEFILE_ERROR_INVALID_FILENAME', 52);
/**
 * package.xml encapsulator
 * @category   pear
 * @package    PEAR
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  1997-2009 The Authors
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @version    Release: 1.9.5
 * @link       http://pear.php.net/package/PEAR
 * @since      Class available since Release 1.4.0a1
 */
class PEAR_PackageFile_v1
{
    /**
     * @access private
     * @var PEAR_ErrorStack
     * @access private
     */
    var $_stack;

    /**
     * A registry object, used to access the package name validation regex for non-standard channels
     * @var PEAR_Registry
     * @access private
     */
    var $_registry;

    /**
     * An object that contains a log method that matches PEAR_Common::log's signature
     * @var object
     * @access private
     */
    var $_logger;

    /**
     * Parsed package information
     * @var array
     * @access private
     */
    var $_packageInfo;

    /**
     * path to package.xml
     * @var string
     * @access private
     */
    var $_packageFile;

    /**
     * path to package .tgz or false if this is a local/extracted package.xml
     * @var string
     * @access private
     */
    var $_archiveFile;

    /**
     * @var int
     * @access private
     */
    var $_isValid = 0;

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
     * @param bool determines whether to return a PEAR_Error object, or use the PEAR_ErrorStack
     * @param string Name of Error Stack class to use.
     */
    function PEAR_PackageFile_v1()
    {
        $this->_stack = &new PEAR_ErrorStack('PEAR_PackageFile_v1');
        $this->_stack->setErrorMessageTemplate($this->_getErrorMessage());
        $this->_isValid = 0;
    }

    function installBinary($installer)
    {
        return false;
    }

    function isExtension($name)
    {
        return false;
    }

    function setConfig(&$config)
    {
        $this->_config = &$config;
        $this->_registry = &$config->getRegistry();
    }

    function setRequestedGroup()
    {
        // placeholder
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

    function getInstalledBinary()
    {
        return false;
    }

    function listPostinstallScripts()
    {
        return false;
    }

    function initPostinstallScripts()
    {
        return false;
    }

    function setLogger(&$logger)
    {
        if ($logger && (!is_object($logger) || !method_exists($logger, 'log'))) {
            return PEAR::raiseError('Logger must be compatible with PEAR_Common::log');
        }
        $this->_logger = &$logger;
    }

    function setPackagefile($file, $archive = false)
    {
        $this->_packageFile = $file;
        $this->_archiveFile = $archive ? $archive : $file;
    }

    function getPackageFile()
    {
        return isset($this->_packageFile) ? $this->_packageFile : false;
    }

    function getPackageType()
    {
        return 'php';
    }

    function getArchiveFile()
    {
        return $this->_archiveFile;
    }

    function packageInfo($field)
    {
        if (!is_string($field) || empty($field) ||
            !isset($this->_packageInfo[$field])) {
            return false;
        }
        return $this->_packageInfo[$field];
    }

    function setDirtree($path)
    {
        if (!isset($this->_packageInfo['dirtree'])) {
            $this->_packageInfo['dirtree'] = array();
        }
        $this->_packageInfo['dirtree'][$path] = true;
    }

    function getDirtree()
    {
        if (isset($this->_packageInfo['dirtree']) && count($this->_packageInfo['dirtree'])) {
            return $this->_packageInfo['dirtree'];
        }
        return false;
    }

    function resetDirtree()
    {
        unset($this->_packageInfo['dirtree']);
    }

    function fromArray($pinfo)
    {
        $this->_incomplete = false;
        $this->_packageInfo = $pinfo;
    }

    function isIncomplete()
    {
        return $this->_incomplete;
    }

    function getChannel()
    {
        return 'pear.php.net';
    }

    function getUri()
    {
        return false;
    }

    function getTime()
    {
        return false;
    }

    function getExtends()
    {
        if (isset($this->_packageInfo['extends'])) {
            return $this->_packageInfo['extends'];
        }
        return false;
    }

    /**
     * @return array
     */
    function toArray()
    {
        if (!$this->validate(PEAR_VALIDATE_NORMAL)) {
            return false;
        }
        return $this->getArray();
    }

    function getArray()
    {
        return $this->_packageInfo;
    }

    function getName()
    {
        return $this->getPackage();
    }

    function getPackage()
    {
        if (isset($this->_packageInfo['package'])) {
            return $this->_packageInfo['package'];
        }
        return false;
    }

    /**
     * WARNING - don't use this unless you know what you are doing
     */
    function setRawPackage($package)
    {
        $this->_packageInfo['package'] = $package;
    }

    function setPackage($package)
    {
        $this->_packageInfo['package'] = $package;
        $this->_isValid = false;
    }

    function getVersion()
    {
        if (isset($this->_packageInfo['version'])) {
            return $this->_packageInfo['version'];
        }
        return false;
    }

    function setVersion($version)
    {
        $this->_packageInfo['version'] = $version;
        $this->_isValid = false;
    }

    function clearMaintainers()
    {
        unset($this->_packageInfo['maintainers']);
    }

    function getMaintainers()
    {
        if (isset($this->_packageInfo['maintainers'])) {
            return $this->_packageInfo['maintainers'];
        }
        return false;
    }

    /**
     * Adds a new maintainer - no checking of duplicates is performed, use
     * updatemaintainer for that purpose.
     */
    function addMaintainer($role, $handle, $name, $email)
    {
        $this->_packageInfo['maintainers'][] =
            array('handle' => $handle, 'role' => $role, 'email' => $email, 'name' => $name);
        $this->_isValid = false;
    }

    function updateMaintainer($role, $handle, $name, $email)
    {
        $found = false;
        if (!isset($this->_packageInfo['maintainers']) ||
              !is_array($this->_packageInfo['maintainers'])) {
            return $this->addMaintainer($role, $handle, $name, $email);
        }
        foreach ($this->_packageInfo['maintainers'] as $i => $maintainer) {
            if ($maintainer['handle'] == $handle) {
                $found = $i;
                break;
            }
        }
        if ($found !== false) {
            unset($this->_packageInfo['maintainers'][$found]);
            $this->_packageInfo['maintainers'] =
                array_values($this->_packageInfo['maintainers']);
        }
        $this->addMaintainer($role, $handle, $name, $email);
    }

    function deleteMaintainer($handle)
    {
        $found = false;
        foreach ($this->_packageInfo['maintainers'] as $i => $maintainer) {
            if ($maintainer['handle'] == $handle) {
                $found = $i;
                break;
            }
        }
        if ($found !== false) {
            unset($this->_packageInfo['maintainers'][$found]);
            $this->_packageInfo['maintainers'] =
                array_values($this->_packageInfo['maintainers']);
            return true;
        }
        return false;
    }

    function getState()
    {
        if (isset($this->_packageInfo['release_state'])) {
            return $this->_packageInfo['release_state'];
        }
        return false;
    }

    function setRawState($state)
    {
        $this->_packageInfo['release_state'] = $state;
    }

    function setState($state)
    {
        $this->_packageInfo['release_state'] = $state;
        $this->_isValid = false;
    }

    function getDate()
    {
        if (isset($this->_packageInfo['release_date'])) {
            return $this->_packageInfo['release_date'];
        }
        return false;
    }

    function setDate($date)
    {
        $this->_packageInfo['release_date'] = $date;
        $this->_isValid = false;
    }

    function getLicense()
    {
        if (isset($this->_packageInfo['release_license'])) {
            return $this->_packageInfo['release_license'];
        }
        return false;
    }

    function setLicense($date)
    {
        $this->_packageInfo['release_license'] = $date;
        $this->_isValid = false;
    }

    function getSummary()
    {
        if (isset($this->_packageInfo['summary'])) {
            return $this->_packageInfo['summary'];
        }
        return false;
    }

    function setSummary($summary)
    {
        $this->_packageInfo['summary'] = $summary;
        $this->_isValid = false;
    }

    function getDescription()
    {
        if (isset($this->_packageInfo['description'])) {
            return $this->_packageInfo['description'];
        }
        return false;
    }

    function setDescription($desc)
    {
        $this->_packageInfo['description'] = $desc;
        $this->_isValid = false;
    }

    function getNotes()
    {
        if (isset($this->_packageInfo['release_notes'])) {
            return $this->_packageInfo['release_notes'];
        }
        return false;
    }

    function setNotes($notes)
    {
        $this->_packageInfo['release_notes'] = $notes;
        $this->_isValid = false;
    }

    function getDeps()
    {
        if (isset($this->_packageInfo['release_deps'])) {
            return $this->_packageInfo['release_deps'];
        }
        return false;
    }

    /**
     * Reset dependencies prior to adding new ones
     */
    function clearDeps()
    {
        unset($this->_packageInfo['release_deps']);
    }

    function addPhpDep($version, $rel)
    {
        $this->_isValid = false;
        $this->_packageInfo['release_deps'][] =
            array('type' => 'php',
                  'rel' => $rel,
                  'version' => $version);
    }

    function addPackageDep($name, $version, $rel, $optional = 'no')
    {
        $this->_isValid = false;
        $dep =
            array('type' => 'pkg',
                  'name' => $name,
                  'rel' => $rel,
                  'optional' => $optional);
        if ($rel != 'has' && $rel != 'not') {
            $dep['version'] = $version;
        }
        $this->_packageInfo['release_deps'][] = $dep;
    }

    function addExtensionDep($name, $version, $rel, $optional = 'no')
    {
        $this->_isValid = false;
        $this->_packageInfo['release_deps'][] =
            array('type' => 'ext',
                  'name' => $name,
                  'rel' => $rel,
                  'version' => $version,
                  'optional' => $optional);
    }

    /**
     * WARNING - do not use this function directly unless you know what you're doing
     */
    function setDeps($deps)
    {
        $this->_packageInfo['release_deps'] = $deps;
    }

    function hasDeps()
    {
        return isset($this->_packageInfo['release_deps']) &&
            count($this->_packageInfo['release_deps']);
    }

    function getDependencyGroup($group)
    {
        return false;
    }

    function isCompatible($pf)
    {
        return false;
    }

    function isSubpackageOf($p)
    {
        return $p->isSubpackage($this);
    }

    function isSubpackage($p)
    {
        return false;
    }

    function dependsOn($package, $channel)
    {
        if (strtolower($channel) != 'pear.php.net') {
            return false;
        }
        if (!($deps = $this->getDeps())) {
            return false;
        }
        foreach ($deps as $dep) {
            if ($dep['type'] != 'pkg') {
                continue;
            }
            if (strtolower($dep['name']) == strtolower($package)) {
                return true;
            }
        }
        return false;
    }

    function getConfigureOptions()
    {
        if (isset($this->_packageInfo['configure_options'])) {
            return $this->_packageInfo['configure_options'];
        }
        return false;
    }

    function hasConfigureOptions()
    {
        return isset($this->_packageInfo['configure_options']) &&
            count($this->_packageInfo['configure_options']);
    }

    function addConfigureOption($name, $prompt, $default = false)
    {
        $o = array('name' => $name, 'prompt' => $prompt);
        if ($default !== false) {
            $o['default'] = $default;
        }
        if (!isset($this->_packageInfo['configure_options'])) {
            $this->_packageInfo['configure_options'] = array();
        }
        $this->_packageInfo['configure_options'][] = $o;
    }

    function clearConfigureOptions()
    {
        unset($this->_packageInfo['configure_options']);
    }

    function getProvides()
    {
        if (isset($this->_packageInfo['provides'])) {
            return $this->_packageInfo['provides'];
        }
        return false;
    }

    function getProvidesExtension()
    {
        return false;
    }

    function addFile($dir, $file, $attrs)
    {
        $dir = preg_replace(array('!\\\\+!', '!/+!'), array('/', '/'), $dir);
        if ($dir == '/' || $dir == '') {
            $dir = '';
        } else {
            $dir .= '/';
        }
        $file = $dir . $file;
        $file = preg_replace('![\\/]+!', '/', $file);
        $this->_packageInfo['filelist'][$file] = $attrs;
    }

    function getInstallationFilelist()
    {
        return $this->getFilelist();
    }

    function getFilelist()
    {
        if (isset($this->_packageInfo['filelist'])) {
            return $this->_packageInfo['filelist'];
        }
        return false;
    }

    function setFileAttribute($file, $attr, $value)
    {
        $this->_packageInfo['filelist'][$file][$attr] = $value;
    }

    function resetFilelist()
    {
        $this->_packageInfo['filelist'] = array();
    }

    function setInstalledAs($file, $path)
    {
        if ($path) {
            return $this->_packageInfo['filelist'][$file]['installed_as'] = $path;
        }
        unset($this->_packageInfo['filelist'][$file]['installed_as']);
    }

    function installedFile($file, $atts)
    {
        if (isset($this->_packageInfo['filelist'][$file])) {
            $this->_packageInfo['filelist'][$file] =
                array_merge($this->_packageInfo['filelist'][$file], $atts);
        } else {
            $this->_packageInfo['filelist'][$file] = $atts;
        }
    }

    function getChangelog()
    {
        if (isset($this->_packageInfo['changelog'])) {
            return $this->_packageInfo['changelog'];
        }
        return false;
    }

    function getPackagexmlVersion()
    {
        return '1.0';
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

    // }}}
    /**
     * Validation error.  Also marks the object contents as invalid
     * @param error code
     * @param array error information
     * @access private
     */
    function _validateError($code, $params = array())
    {
        $this->_stack->push($code, 'error', $params, false, false, debug_backtrace());
        $this->_isValid = false;
    }

    /**
     * Validation warning.  Does not mark the object contents invalid.
     * @param error code
     * @param array error information
     * @access private
     */
    function _validateWarning($code, $params = array())
    {
        $this->_stack->push($code, 'warning', $params, false, false, debug_backtrace());
    }

    /**
     * @param integer error code
     * @access protected
     */
    function _getErrorMessage()
    {
        return array(
                PEAR_PACKAGEFILE_ERROR_NO_NAME =>
                    'Missing Package Name',
                PEAR_PACKAGEFILE_ERROR_NO_SUMMARY =>
                    'No summary found',
                PEAR_PACKAGEFILE_ERROR_MULTILINE_SUMMARY =>
                    'Summary should be on one line',
                PEAR_PACKAGEFILE_ERROR_NO_DESCRIPTION =>
                    'Missing description',
                PEAR_PACKAGEFILE_ERROR_NO_LICENSE =>
                    'Missing license',
                PEAR_PACKAGEFILE_ERROR_NO_VERSION =>
                    'No release version found',
                PEAR_PACKAGEFILE_ERROR_NO_STATE =>
                    'No release state found',
                PEAR_PACKAGEFILE_ERROR_NO_DATE =>
                    'No release date found',
                PEAR_PACKAGEFILE_ERROR_NO_NOTES =>
                    'No release notes found',
                PEAR_PACKAGEFILE_ERROR_NO_LEAD =>
                    'Package must have at least one lead maintainer',
                PEAR_PACKAGEFILE_ERROR_NO_MAINTAINERS =>
                    'No maintainers found, at least one must be defined',
                PEAR_PACKAGEFILE_ERROR_NO_MAINTHANDLE =>
                    'Maintainer %index% has no handle (user ID at channel server)',
                PEAR_PACKAGEFILE_ERROR_NO_MAINTROLE =>
                    'Maintainer %index% has no role',
                PEAR_PACKAGEFILE_ERROR_NO_MAINTNAME =>
                    'Maintainer %index% has no name',
                PEAR_PACKAGEFILE_ERROR_NO_MAINTEMAIL =>
                    'Maintainer %index% has no email',
                PEAR_PACKAGEFILE_ERROR_NO_DEPNAME =>
                    'Dependency %index% is not a php dependency, and has no name',
                PEAR_PACKAGEFILE_ERROR_NO_DEPREL =>
                    'Dependency %index% has no relation (rel)',
                PEAR_PACKAGEFILE_ERROR_NO_DEPTYPE =>
                    'Dependency %index% has no type',
                PEAR_PACKAGEFILE_ERROR_DEPNAME_IGNORED =>
                    'PHP Dependency %index% has a name attribute of "%name%" which will be' .
                        ' ignored!',
                PEAR_PACKAGEFILE_ERROR_NO_DEPVERSION =>
                    'Dependency %index% is not a rel="has" or rel="not" dependency, ' .
                        'and has no version',
                PEAR_PACKAGEFILE_ERROR_NO_DEPPHPVERSION =>
                    'Dependency %index% is a type="php" dependency, ' .
                        'and has no version',
                PEAR_PACKAGEFILE_ERROR_DEPVERSION_IGNORED =>
                    'Dependency %index% is a rel="%rel%" dependency, versioning is ignored',
                PEAR_PACKAGEFILE_ERROR_INVALID_DEPOPTIONAL =>
                    'Dependency %index% has invalid optional value "%opt%", should be yes or no',
                PEAR_PACKAGEFILE_PHP_NO_NOT =>
                    'Dependency %index%: php dependencies cannot use "not" rel, use "ne"' .
                        ' to exclude specific versions',
                PEAR_PACKAGEFILE_ERROR_NO_CONFNAME =>
                    'Configure Option %index% has no name',
                PEAR_PACKAGEFILE_ERROR_NO_CONFPROMPT =>
                    'Configure Option %index% has no prompt',
                PEAR_PACKAGEFILE_ERROR_NO_FILES =>
                    'No files in <filelist> section of package.xml',
                PEAR_PACKAGEFILE_ERROR_NO_FILEROLE =>
                    'File "%file%" has no role, expecting one of "%roles%"',
                PEAR_PACKAGEFILE_ERROR_INVALID_FILEROLE =>
                    'File "%file%" has invalid role "%role%", expecting one of "%roles%"',
                PEAR_PACKAGEFILE_ERROR_INVALID_FILENAME =>
                    'File "%file%" cannot start with ".", cannot package or install',
                PEAR_PACKAGEFILE_ERROR_INVALID_PHPFILE =>
                    'Parser error: invalid PHP found in file "%file%"',
                PEAR_PACKAGEFILE_ERROR_NO_PNAME_PREFIX =>
                    'in %file%: %type% "%name%" not prefixed with package name "%package%"',
                PEAR_PACKAGEFILE_ERROR_INVALID_FILE =>
                    'Parser error: invalid PHP file "%file%"',
                PEAR_PACKAGEFILE_ERROR_CHANNELVAL =>
                    'Channel validator error: field "%field%" - %reason%',
                PEAR_PACKAGEFILE_ERROR_PHP5 =>
                    'Error, PHP5 token encountered in %file%, analysis should be in PHP5',
                PEAR_PACKAGEFILE_ERROR_FILE_NOTFOUND =>
                    'File "%file%" in package.xml does not exist',
                PEAR_PACKAGEFILE_ERROR_NON_ISO_CHARS =>
                    'Package.xml contains non-ISO-8859-1 characters, and may not validate',
            );
    }

    /**
     * Validate XML package definition file.
     *
     * @access public
     * @return boolean
     */
    function validate($state = PEAR_VALIDATE_NORMAL, $nofilechecking = false)
    {
        if (($this->_isValid & $state) == $state) {
            return true;
        }
        $this->_isValid = true;
        $info = $this->_packageInfo;
        if (empty($info['package'])) {
            $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_NAME);
            $this->_packageName = $pn = 'unknown';
        } else {
            $this->_packageName = $pn = $info['package'];
        }

        if (empty($info['summary'])) {
            $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_SUMMARY);
        } elseif (strpos(trim($info['summary']), "\n") !== false) {
            $this->_validateWarning(PEAR_PACKAGEFILE_ERROR_MULTILINE_SUMMARY,
                array('summary' => $info['summary']));
        }
        if (empty($info['description'])) {
            $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_DESCRIPTION);
        }
        if (empty($info['release_license'])) {
            $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_LICENSE);
        }
        if (empty($info['version'])) {
            $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_VERSION);
        }
        if (empty($info['release_state'])) {
            $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_STATE);
        }
        if (empty($info['release_date'])) {
            $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_DATE);
        }
        if (empty($info['release_notes'])) {
            $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_NOTES);
        }
        if (empty($info['maintainers'])) {
            $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_MAINTAINERS);
        } else {
            $haslead = false;
            $i = 1;
            foreach ($info['maintainers'] as $m) {
                if (empty($m['handle'])) {
                    $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_MAINTHANDLE,
                        array('index' => $i));
                }
                if (empty($m['role'])) {
                    $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_MAINTROLE,
                        array('index' => $i, 'roles' => PEAR_Common::getUserRoles()));
                } elseif ($m['role'] == 'lead') {
                    $haslead = true;
                }
                if (empty($m['name'])) {
                    $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_MAINTNAME,
                        array('index' => $i));
                }
                if (empty($m['email'])) {
                    $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_MAINTEMAIL,
                        array('index' => $i));
                }
                $i++;
            }
            if (!$haslead) {
                $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_LEAD);
            }
        }
        if (!empty($info['release_deps'])) {
            $i = 1;
            foreach ($info['release_deps'] as $d) {
                if (!isset($d['type']) || empty($d['type'])) {
                    $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_DEPTYPE,
                        array('index' => $i, 'types' => PEAR_Common::getDependencyTypes()));
                    continue;
                }
                if (!isset($d['rel']) || empty($d['rel'])) {
                    $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_DEPREL,
                        array('index' => $i, 'rels' => PEAR_Common::getDependencyRelations()));
                    continue;
                }
                if (!empty($d['optional'])) {
                    if (!in_array($d['optional'], array('yes', 'no'))) {
                        $this->_validateError(PEAR_PACKAGEFILE_ERROR_INVALID_DEPOPTIONAL,
                            array('index' => $i, 'opt' => $d['optional']));
                    }
                }
                if ($d['rel'] != 'has' && $d['rel'] != 'not' && empty($d['version'])) {
                    $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_DEPVERSION,
                        array('index' => $i));
                } elseif (($d['rel'] == 'has' || $d['rel'] == 'not') && !empty($d['version'])) {
                    $this->_validateWarning(PEAR_PACKAGEFILE_ERROR_DEPVERSION_IGNORED,
                        array('index' => $i, 'rel' => $d['rel']));
                }
                if ($d['type'] == 'php' && !empty($d['name'])) {
                    $this->_validateWarning(PEAR_PACKAGEFILE_ERROR_DEPNAME_IGNORED,
                        array('index' => $i, 'name' => $d['name']));
                } elseif ($d['type'] != 'php' && empty($d['name'])) {
                    $this->_validateError(PEAR_PACKAGEFILE_ERROR_NO_DEPNAME,
                        array('index' => $i));
                }
                if ($d['type'] == 'php' && empty($d['version'])) {
                