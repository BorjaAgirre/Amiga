<?php
/**
 * PEAR_Installer
 *
 * PHP versions 4 and 5
 *
 * @category   pear
 * @package    PEAR
 * @author     Stig Bakken <ssb@php.net>
 * @author     Tomas V.V. Cox <cox@idecnet.com>
 * @author     Martin Jansen <mj@php.net>
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  1997-2009 The Authors
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @version    CVS: $Id$
 * @link       http://pear.php.net/package/PEAR
 * @since      File available since Release 0.1
 */

/**
 * Used for installation groups in package.xml 2.0 and platform exceptions
 */
require_once 'OS/Guess.php';
require_once 'PEAR/Downloader.php';

define('PEAR_INSTALLER_NOBINARY', -240);
/**
 * Administration class used to install PEAR packages and maintain the
 * installed package database.
 *
 * @category   pear
 * @package    PEAR
 * @author     Stig Bakken <ssb@php.net>
 * @author     Tomas V.V. Cox <cox@idecnet.com>
 * @author     Martin Jansen <mj@php.net>
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  1997-2009 The Authors
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @version    Release: 1.9.5
 * @link       http://pear.php.net/package/PEAR
 * @since      Class available since Release 0.1
 */
class PEAR_Installer extends PEAR_Downloader
{
    // {{{ properties

    /** name of the package directory, for example Foo-1.0
     * @var string
     */
    var $pkgdir;

    /** directory where PHP code files go
     * @var string
     */
    var $phpdir;

    /** directory where PHP extension files go
     * @var string
     */
    var $extdir;

    /** directory where documentation goes
     * @var string
     */
    var $docdir;

    /** installation root directory (ala PHP's INSTALL_ROOT or
     * automake's DESTDIR
     * @var string
     */
    var $installroot = '';

    /** debug level
     * @var int
     */
    var $debug = 1;

    /** temporary directory
     * @var string
     */
    var $tmpdir;

    /**
     * PEAR_Registry object used by the installer
     * @var PEAR_Registry
     */
    var $registry;

    /**
     * array of PEAR_Downloader_Packages
     * @var array
     */
    var $_downloadedPackages;

    /** List of file transactions queued for an install/upgrade/uninstall.
     *
     *  Format:
     *    array(
     *      0 => array("rename => array("from-file", "to-file")),
     *      1 => array("delete" => array("file-to-delete")),
     *      ...
     *    )
     *
     * @var array
     */
    var $file_operations = array();

    // }}}

    // {{{ constructor

    /**
     * PEAR_Installer constructor.
     *
     * @param object $ui user interface object (instance of PEAR_Frontend_*)
     *
     * @access public
     */
    function PEAR_Installer(&$ui)
    {
        parent::PEAR_Common();
        $this->setFrontendObject($ui);
        $this->debug = $this->config->get('verbose');
    }

    function setOptions($options)
    {
        $this->_options = $options;
    }

    function setConfig(&$config)
    {
        $this->config    = &$config;
        $this->_registry = &$config->getRegistry();
    }

    // }}}

    function _removeBackups($files)
    {
        foreach ($files as $path) {
            $this->addFileOperation('removebackup', array($path));
        }
    }

    // {{{ _deletePackageFiles()

    /**
     * Delete a package's installed files, does not remove empty directories.
     *
     * @param string package name
     * @param string channel name
     * @param bool if true, then files are backed up first
     * @return bool TRUE on success, or a PEAR error on failure
     * @access protected
     */
    function _deletePackageFiles($package, $channel = false, $backup = false)
    {
        if (!$channel) {
            $channel = 'pear.php.net';
        }

        if (!strlen($package)) {
            return $this->raiseError("No package to uninstall given");
        }

        if (strtolower($package) == 'pear' && $channel == 'pear.php.net') {
            // to avoid race conditions, include all possible needed files
            require_once 'PEAR/Task/Common.php';
            require_once 'PEAR/Task/Replace.php';
            require_once 'PEAR/Task/Unixeol.php';
            require_once 'PEAR/Task/Windowseol.php';
            require_once 'PEAR/PackageFile/v1.php';
            require_once 'PEAR/PackageFile/v2.php';
            require_once 'PEAR/PackageFile/Generator/v1.php';
            require_once 'PEAR/PackageFile/Generator/v2.php';
        }

        $filelist = $this->_registry->packageInfo($package, 'filelist', $channel);
        if ($filelist == null) {
            return $this->raiseError("$channel/$package not installed");
        }

        $ret = array();
        foreach ($filelist as $file => $props) {
            if (empty($props['installed_as'])) {
                continue;
            }

            $path = $props['installed_as'];
            if ($backup) {
                $this->addFileOperation('backup', array($path));
                $ret[] = $path;
            }

            $this->addFileOperation('delete', array($path));
        }

        if ($backup) {
            return $ret;
        }

        return true;
    }

    // }}}
    // {{{ _installFile()

    /**
     * @param string filename
     * @param array attributes from <file> tag in package.xml
     * @param string path to install the file in
     * @param array options from command-line
     * @access private
     */
    function _installFile($file, $atts, $tmp_path, $options)
    {
        // {{{ return if this file is meant for another platform
        static $os;
        if (!isset($this->_registry)) {
            $this->_registry = &$this->config->getRegistry();
        }

        if (isset($atts['platform'])) {
            if (empty($os)) {
                $os = new OS_Guess();
            }

            if (strlen($atts['platform']) && $atts['platform']{0} == '!') {
                $negate   = true;
                $platform = substr($atts['platform'], 1);
            } else {
                $negate    = false;
                $platform = $atts['platform'];
            }

            if ((bool) $os->matchSignature($platform) === $negate) {
                $this->log(3, "skipped $file (meant for $atts[platform], we are ".$os->getSignature().")");
                return PEAR_INSTALLER_SKIPPED;
            }
        }
        // }}}

        $channel = $this->pkginfo->getChannel();
        // {{{ assemble the destination paths
        switch ($atts['role']) {
            case 'src':
            case 'extsrc':
                $this->source_files++;
                return;
            case 'doc':
            case 'data':
            case 'test':
                $dest_dir = $this->config->get($atts['role'] . '_dir', null, $channel) .
                            DIRECTORY_SEPARATOR . $this->pkginfo->getPackage();
                unset($atts['baseinstalldir']);
                break;
            case 'ext':
            case 'php':
                $dest_dir = $this->config->get($atts['role'] . '_dir', null, $channel);
                break;
            case 'script':
                $dest_dir = $this->config->get('bin_dir', null, $channel);
                break;
            default:
                return $this->raiseError("Invalid role `$atts[role]' for file $file");
        }

        $save_destdir = $dest_dir;
        if (!empty($atts['baseinstalldir'])) {
            $dest_dir .= DIRECTORY_SEPARATOR . $atts['baseinstalldir'];
        }

        if (dirname($file) != '.' && empty($atts['install-as'])) {
            $dest_dir .= DIRECTORY_SEPARATOR . dirname($file);
        }

        if (empty($atts['install-as'])) {
            $dest_file = $dest_dir . DIRECTORY_SEPARATOR . basename($file);
        } else {
            $dest_file = $dest_dir . DIRECTORY_SEPARATOR . $atts['install-as'];
        }
        $orig_file = $tmp_path . DIRECTORY_SEPARATOR . $file;

        // Clean up the DIRECTORY_SEPARATOR mess
        $ds2 = DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR;
        list($dest_file, $orig_file) = preg_replace(array('!\\\\+!', '!/!', "!$ds2+!"),
                                                    array(DIRECTORY_SEPARATOR,
                                                          DIRECTORY_SEPARATOR,
                                                          DIRECTORY_SEPARATOR),
                                                    array($dest_file, $orig_file));
        $final_dest_file = $installed_as = $dest_file;
        if (isset($this->_options['packagingroot'])) {
            $installedas_dest_dir  = dirname($final_dest_file);
            $installedas_dest_file = $dest_dir . DIRECTORY_SEPARATOR . '.tmp' . basename($final_dest_file);
            $final_dest_file = $this->_prependPath($final_dest_file, $this->_options['packagingroot']);
        } else {
            $installedas_dest_dir  = dirname($final_dest_file);
            $installedas_dest_file = $installedas_dest_dir . DIRECTORY_SEPARATOR . '.tmp' . basename($final_dest_file);
        }

        $dest_dir  = dirname($final_dest_file);
        $dest_file = $dest_dir . DIRECTORY_SEPARATOR . '.tmp' . basename($final_dest_file);
        if (preg_match('~/\.\.(/|\\z)|^\.\./~', str_replace('\\', '/', $dest_file))) {
            return $this->raiseError("SECURITY ERROR: file $file (installed to $dest_file) contains parent directory reference ..", PEAR_INSTALLER_FAILED);
        }
        // }}}

        if (empty($this->_options['register-only']) &&
              (!file_exists($dest_dir) || !is_dir($dest_dir))) {
            if (!$this->mkDirHier($dest_dir)) {
                return $this->raiseError("failed to mkdir $dest_dir",
                                         PEAR_INSTALLER_FAILED);
            }
            $this->log(3, "+ mkdir $dest_dir");
        }

        // pretty much nothing happens if we are only registering the install
        if (empty($this->_options['register-only'])) {
            if (empty($atts['replacements'])) {
                if (!file_exists($orig_file)) {
                    return $this->raiseError("file $orig_file does not exist",
                                             PEAR_INSTALLER_FAILED);
                }

                if (!@copy($orig_file, $dest_file)) {
                    return $this->raiseError("failed to write $dest_file: $php_errormsg",
                                             PEAR_INSTALLER_FAILED);
                }

                $this->log(3, "+ cp $orig_file $dest_file");
                if (isset($atts['md5sum'])) {
                    $md5sum = md5_file($dest_file);
                }
            } else {
                // {{{ file with replacements
                if (!file_exists($orig_file)) {
                    return $this->raiseError("file does not exist",
                                             PEAR_INSTALLER_FAILED);
                }

                $contents = file_get_contents($orig_file);
                if ($contents === false) {
                    $contents = '';
                }

                if (isset($atts['md5sum'])) {
                    $md5sum = md5($contents);
                }

                $subst_from = $subst_to = array();
                foreach ($atts['replacements'] as $a) {
                    $to = '';
                    if ($a['type'] == 'php-const') {
                        if (preg_match('/^[a-z0-9_]+\\z/i', $a['to'])) {
                            eval("\$to = $a[to];");
                        } else {
                            if (!isset($options['soft'])) {
                                $this->log(0, "invalid php-const replacement: $a[to]");
                            }
                            continue;
                        }
                    } elseif ($a['type'] == 'pear-config') {
                        if ($a['to'] == 'master_server') {
                            $chan = $this->_registry->getChannel($channel);
                            if (!PEAR::isError($chan)) {
                                $to = $chan->getServer();
                            } else {
                                $to = $this->config->get($a['to'], null, $channel);
                            }
                        } else {
                            $to = $this->config->get($a['to'], null, $channel);
                        }
                        if (is_null($to)) {
                            if (!isset($options['soft'])) {
                                $this->log(0, "invalid pear-config replacement: $a[to]");
                            }
                            continue;
                        }
                    } elseif ($a['type'] == 'package-info') {
                        if ($t = $this->pkginfo->packageInfo($a['to'])) {
                            $to = $t;
                        } else {
                            if (!isset($options['soft'])) {
                                $this->log(0, "invalid package-info replacement: $a[to]");
                            }
                            continue;
                        }
                    }
                    if (!is_null($to)) {
                        $subst_from[] = $a['from'];
                        $subst_to[] = $to;
                    }
                }

                $this->log(3, "doing ".sizeof($subst_from)." substitution(s) for $final_dest_file");
                if (sizeof($subst_from)) {
                    $contents = str_replace($subst_from, $subst_to, $contents);
                }

                $wp = @fopen($dest_file, "wb");
                if (!is_resource($wp)) {
                    return $this->raiseError("failed to create $dest_file: $php_errormsg",
                                             PEAR_INSTALLER_FAILED);
                }

                if (@fwrite($wp, $contents) === false) {
                    return $this->raiseError("failed writing to $dest_file: $php_errormsg",
                                             PEAR_INSTALLER_FAILED);
                }

                fclose($wp);
                // }}}
            }

            // {{{ check the md5
            if (isset($md5sum)) {
                if (strtolower($md5sum) === strtolower($atts['md5sum'])) {
                    $this->log(2, "md5sum ok: $final_dest_file");
                } else {
                    if (empty($options['force'])) {
                        // delete the file
                        if (file_exists($dest_file)) {
                            unlink($dest_file);
                        }

                        if (!isset($options['ignore-errors'])) {
                            return $this->raiseError("bad md5sum for file $final_dest_file",
                                                 PEAR_INSTALLER_FAILED);
                        }

                        if (!isset($options['soft'])) {
                            $this->log(0, "warning : bad md5sum for file $final_dest_file");
                        }
                    } else {
                        if (!isset($options['soft'])) {
                            $this->log(0, "warning : bad md5sum for file $final_dest_file");
                        }
                    }
                }
            }
            // }}}
            // {{{ set file permissions
            if (!OS_WINDOWS) {
                if ($atts['role'] == 'script') {
                    $mode = 0777 & ~(int)octdec($this->config->get('umask'));
                    $this->log(3, "+ chmod +x $dest_file");
                } else {
                    $mode = 0666 & ~(int)octdec($this->config->get('umask'));
                }

                if ($atts['role'] != 'src') {
                    $this->addFileOperation("chmod", array($mode, $dest_file));
                    if (!@chmod($dest_file, $mode)) {
                        if (!isset($options['soft'])) {
                            $this->log(0, "failed to change mode of $dest_file: $php_errormsg");
                        }
                    }
                }
            }
            // }}}

            if ($atts['role'] == 'src') {
                rename($dest_file, $final_dest_file);
                $this->log(2, "renamed source file $dest_file to $final_dest_file");
            } else {
                $this->addFileOperation("rename", array($dest_file, $final_dest_file,
                    $atts['role'] == 'ext'));
            }
        }

        // Store the full path where the file was installed for easy unistall
        if ($atts['role'] != 'script') {
            $loc = $this->config->get($atts['role'] . '_dir');
        } else {
            $loc = $this->config->get('bin_dir');
        }

        if ($atts['role'] != 'src') {
            $this->addFileOperation("installed_as", array($file, $installed_as,
                                    $loc,
                                    dirname(substr($installedas_dest_file, strlen($loc)))));
        }

        //$this->log(2, "installed: $dest_file");
        return PEAR_INSTALLER_OK;
    }

    // }}}
    // {{{ _installFile2()

    /**
     * @param PEAR_PackageFile_v1|PEAR_PackageFile_v2
     * @param string filename
     * @param array attributes from <file> tag in package.xml
     * @param string path to install the file in
     * @param array options from command-line
     * @access private
     */
    function _installFile2(&$pkg, $file, &$real_atts, $tmp_path, $options)
    {
        $atts = $real_atts;
        if (!isset($this->_registry)) {
            $this->_registry = &$this->config->getRegistry();
        }

        $channel = $pkg->getChannel();
        // {{{ assemble the destination paths
        if (!in_array($atts['attribs']['role'],
              PEAR_Installer_Role::getValidRoles($pkg->getPackageType()))) {
            return $this->raiseError('Invalid role `' . $atts['attribs']['role'] .
                    "' for file $file");
        }

        $role = &PEAR_Installer_Role::factory($pkg, $atts['attribs']['role'], $this->config);
        $err  = $role->setup($this, $pkg, $atts['attribs'], $file);
        if (PEAR::isError($err)) {
            return $err;
        }

        if (!$role->isInstallable()) {
            return;
        }

        $info = $role->processInstallation($pkg, $atts['attribs'], $file, $tmp_path);
        if (PEAR::isError($info)) {
            return $info;
        }

        list($save_destdir, $dest_dir, $dest_file, $orig_file) = $info;
        if (preg_match('~/\.\.(/|\\z)|^\.\./~', str_replace('\\', '/', $dest_file))) {
            return $this->raiseError("SECURITY ERROR: file $file (installed to $dest_file) contains parent directory reference ..", PEAR_INSTALLER_FAILED);
        }

        $final_dest_file = $installed_as = $dest_file;
        if (isset($this->_options['packagingroot'])) {
            $final_dest_file = $this->_prependPath($final_dest_file,
                $this->_options['packagingroot']);
        }

        $dest_dir  = dirname($final_dest_file);
        $dest_file = $dest_dir . DIRECTORY_SEPARATOR . '.tmp' . basename($final_dest_file);
        // }}}

        if (empty($this->_options['register-only'])) {
            if (!file_exists($dest_dir) || !is_dir($dest_dir)) {
                if (!$this->mkDirHier($dest_dir)) {
                    return $this->raiseError("failed to mkdir $dest_dir",
                                             PEAR_INSTALLER_FAILED);
                }
                $this->log(3, "+ mkdir $dest_dir");
            }
        }

        $attribs = $atts['attribs'];
        unset($atts['attribs']);
        // pretty much nothing happens if we are only registering the install
        if (empty($this->_options['register-only'])) {
            if (!count($atts)) { // no tasks
                if (!file_exists($orig_file)) {
                    return $this->raiseError("file $orig_file does not exist",
                                             PEAR_INSTALLER_FAILED);
                }

                if (!@copy($orig_file, $dest_file)) {
                    return $this->raiseError("failed to write $dest_file: $php_errormsg",
                                             PEAR_INSTALLER_FAILED);
                }

                $this->log(3, "+ cp $orig_file $dest_file");
                if (isset($attribs['md5sum'])) {
                    $md5sum = md5_file($dest_file);
                }
            } else { // file with tasks
                if (!file_exists($orig_file)) {
                    return $this->raiseError("file $orig_file does not exist",
                                             PEAR_INSTALLER_FAILED);
                }

                $contents = file_get_contents($orig_file);
                if ($contents === false) {
                    $contents = '';
                }

                if (isset($attribs['md5sum'])) {
                    $md5sum = md5($contents);
                }

                foreach ($atts as $tag => $raw) {
                    $tag = str_replace(array($pkg->getTasksNs() . ':', '-'), array('', '_'), $tag);
                    $task = "PEAR_Task_$tag";
                    $task = &new $task($this->config, $this, PEAR_TASK_INSTALL);
                    if (!$task->isScript()) { // scripts are only handled after installation
                        $task->init($raw, $attribs, $pkg->getLastInstalledVersion());
                        $res = $task->startSession($pkg, $contents, $final_dest_file);
                        if ($res === false) {
                            continue; // skip this file
                        }

                        if (PEAR::isError($res)) {
                            return $res;
                        }

                        $contents = $res; // save changes
                    }

                    $wp = @fopen($dest_file, "wb");
                    if (!is_resource($wp)) {
                        return $this->raiseError("failed to create $dest_file: $php_errormsg",
                                                 PEAR_INSTALLER_FAILED);
                    }

                    if (fwrite($wp, $contents) === false) {
                        return $this->raiseError("failed writing to $dest_file: $php_errormsg",
                                                 PEAR_INSTALLER_FAILED);
                    }

                    fclose($wp);
                }
            }

            // {{{ check the md5
            if (isset($md5sum)) {
                // Make sure the original md5 sum matches with expected
                if (strtolower($md5sum) === strtolower($attribs['md5sum'])) {
                    $this->log(2, "md5sum ok: $final_dest_file");

                    if (isset($contents)) {
                        // set md5 sum based on $content in case any tasks were run.
                        $real_atts['attribs']['md5sum'] = md5($contents);
                    }
                } else {
                    if (empty($options['force'])) {
                        // delete the file
                        if (file_exists($dest_file)) {
                            unlink($dest_file);
                        }

                        if (!isset($options['ignore-errors'])) {
                            return $this->raiseError("bad md5sum for file $final_dest_file",
                                                     PEAR_INSTALLER_FAILED);
                        }

                        if (!isset($options['soft'])) {
                            $this->log(0, "warning : bad md5sum for file $final_dest_file");
                        }
                    } else {
                        if (!isset($options['soft'])) {
                            $this->log(0, "warning : bad md5sum for file $final_dest_file");
                        }
                    }
                }
            } else {
                $real_atts['attribs']['md5sum'] = md5_file($dest_file);
            }

            // }}}
            // {{{ set file permissions
            if (!OS_WINDOWS) {
                if ($role->isExecutable()) {
                    $mode = 0777 & ~(int)octdec($this->config->get('umask'));
                    $this->log(3, "+ chmod +x $dest_file");
                } else {
                    $mode = 0666 & ~(int)octdec($this->config->get('umask'));
                }

                if ($attribs['role'] != 'src') {
                    $this->addFileOperation("chmod", array($mode, $dest_file));
                    if (!@chmod($dest_file, $mode)) {
                        if (!isset($options['soft'])) {
                            $this->log(0, "failed to change mode of $dest_file: $php_errormsg");
                        }
                    }
                }
            }
            // }}}

            if ($attribs['role'] == 'src') {
                rename($dest_file, $final_dest_file);
                $this->log(2, "renamed source file $dest_file to $final_dest_file");
            } else {
                $this->addFileOperation("rename", array($dest_file, $final_dest_file, $role->isExtension()));
            }
        }

        // Store the full path where the file was installed for easy uninstall
        if ($attribs['role'] != 'src') {
            $loc = $this->config->get($role->getLocationConfig(), null, $channel);
            $this->addFileOperation('installed_as', array($file, $installed_as,
                                $loc,
                                dirname(substr($installed_as, strlen($loc)))));
        }

        //$this->log(2, "installed: $dest_file");
        return PEAR_INSTALLER_OK;
    }

    // }}}
    // {{{ addFileOperation()

    /**
     * Add a file operation to the current file transaction.
     *
     * @see startFileTransaction()
     * @param string $type This can be one of:
     *    - rename:  rename a file ($data has 3 values)
     *    - backup:  backup an existing file ($data has 1 value)
     *    - removebackup:  clean up backups created during install ($data has 1 value)
     *    - chmod:   change permissions on a file ($data has 2 values)
     *    - delete:  delete a file ($data has 1 value)
     *    - rmdir:   delete a directory if empty ($data has 1 value)
     *    - installed_as: mark a file as installed ($data has 4 values).
     * @param array $data For all file operations, this array must contain the
     *    full path to the file or directory that is being operated on.  For
     *    the rename command, the first parameter must be the file to rename,
     *    the second its new name, the third whether this is a PHP extension.
     *
     *    The installed_as operation contains 4 elements in this order:
     *    1. Filename as listed in the filelist element from package.xml
     *    2. Full path to the installed file
     *    3. Full path from the php_dir configuration variable used in this
     *       installation
     *    4. Relative path from the php_dir that this file is installed in
     */
    function addFileOperation($type, $data)
    {
        if (!is_array($data)) {
            return $this->raiseError('Internal Error: $data in addFileOperation'
                . ' must be an array, was ' . gettype($data));
        }

        if ($type == 'chmod') {
            $octmode = decoct($data[0]);
            $this->log(3, "adding to transaction: $type $octmode $data[1]");
        } else {
            $this->log(3, "adding to transaction: $type " . implode(" ", $data));
        }
        $this->file_operations[] = array($type, $data);
    }

    // }}}
    // {{{ startFileTransaction()

    function startFileTransaction($rollback_in_case = false)
    {
        if (count($this->file_operations) && $rollback_in_case) {
            $this->rollbackFileTransaction();
        }
        $this->file_operations = array();
    }

    // }}}
    // {{{ commitFileTransaction()

    function commitFileTransaction()
    {
        // {{{ first, check permissions and such manually
        $errors = array();
        foreach ($this->file_operations as $key => $tr) {
            list($type, $data) = $tr;
            switch ($type) {
                case 'rename':
                    if (!file_exists($data[0])) {
                        $errors[] = "cannot rename file $data[0], doesn't exist";
                    }

                    // check that dest dir. is writable
                    if (!is_writable(dirname($data[1]))) {
                        $errors[] = "permission denied ($type): $data[1]";
                    }
                    break;
                case 'chmod':
                    // check that file is writable
                    if (!is_writable($data[1])) {
                        $errors[] = "permission denied ($type): $data[1] " . decoct($data[0]);
                    }
                    break;
                case 'delete':
                    if (!file_exists($data[0])) {
                        $this->log(2, "warning: file $data[0] doesn't exist, can't be deleted");
                    }
                    // check that directory is writable
                    if (file_exists($data[0])) {
                        if (!is_writable(dirname($data[0]))) {
                            $errors[] = "permission denied ($type): $data[0]";
                        } else {
                            // make sure the file to be deleted can be opened for writing
                            $fp = false;
                            if (!is_dir($data[0]) &&
                                  (!is_writable($data[0]) || !($fp = @fopen($data[0], 'a')))) {
                                $errors[] = "permission denied ($type): $data[0]";
                            } elseif ($fp) {
                                fclose($fp);
                            }
                        }

                        /* Verify we are not deleting a file owned by another package
                         * This can happen when a file moves from package A to B in
                         * an upgrade ala http://pear.php.net/17986
                         */
                        $info = array(
                            'package' => strtolower($this->pkginfo->getName()),
                            'channel' => strtolower($this->pkginfo->getChannel()),
                        );
                        $result = $this->_registry->checkFileMap($data[0], $info, '1.1');
                        if (is_array($result)) {
                            $res = array_diff($result, $info);
                            if (!empty($res)) {
                                $new = $this->_registry->getPackage($result[1], $result[0]);
                                $this->file_operations[$key] = false;
                                $pkginfoName = $this->pkginfo->getName();
                                $newChannel  = $new->getChannel();
                                $newPackage  = $new->getName();
                                $this->log(3, "file $data[0] was scheduled for removal from $pkginfoName but is owned by $newChannel/$newPackage, removal has been cancelled.");
                            }
                        }
                    }
                    break;
            }

        }
        // }}}

        $n = count($this->file_operations);
        $this->log(2, "about to commit $n file operations for " . $this->pkginfo->getName());

        $m = count($errors);
        if ($m > 0) {
            foreach ($errors as $error) {
                if (!isset($this->_options['soft'])) {
                    $this->log(1, $error);
                }
            }

            if (!isset($this->_options['ignore-errors'])) {
                return false;
            }
        }

        $this->_dirtree = array();
        // {{{ really commit the transaction
        foreach ($this->file_operations as $i => $tr) {
            if (!$tr) {
                // support removal of non-existing backups
                continue;
            }

            list($type, $data) = $tr;
            switch ($type) {
                case 'backup':
                    if (!file_exists($data[0])) {
                        $this->file_operations[$i] = false;
                        break;
                    }

                    if (!@copy($data[0], $data[0] . '.bak')) {
                        $this->log(1, 'Could not copy ' . $data[0] . ' to ' . $data[0] .
                            '.bak ' . $php_errormsg);
                        return false;
                    }
                    $this->log(3, "+ backup $data[0] to $data[0].bak");
                    break;
                case 'removebackup':
     