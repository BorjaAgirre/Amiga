<?php
/**
 * PEAR_Registry
 *
 * PHP versions 4 and 5
 *
 * @category   pear
 * @package    PEAR
 * @author     Stig Bakken <ssb@php.net>
 * @author     Tomas V. V. Cox <cox@idecnet.com>
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  1997-2009 The Authors
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @version    CVS: $Id$
 * @link       http://pear.php.net/package/PEAR
 * @since      File available since Release 0.1
 */

/**
 * for PEAR_Error
 */
require_once 'PEAR.php';
require_once 'PEAR/DependencyDB.php';

define('PEAR_REGISTRY_ERROR_LOCK',         -2);
define('PEAR_REGISTRY_ERROR_FORMAT',       -3);
define('PEAR_REGISTRY_ERROR_FILE',         -4);
define('PEAR_REGISTRY_ERROR_CONFLICT',     -5);
define('PEAR_REGISTRY_ERROR_CHANNEL_FILE', -6);

/**
 * Administration class used to maintain the installed package database.
 * @category   pear
 * @package    PEAR
 * @author     Stig Bakken <ssb@php.net>
 * @author     Tomas V. V. Cox <cox@idecnet.com>
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  1997-2009 The Authors
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @version    Release: 1.9.5
 * @link       http://pear.php.net/package/PEAR
 * @since      Class available since Release 1.4.0a1
 */
class PEAR_Registry extends PEAR
{
    /**
     * File containing all channel information.
     * @var string
     */
    var $channels = '';

    /** Directory where registry files are stored.
     * @var string
     */
    var $statedir = '';

    /** File where the file map is stored
     * @var string
     */
    var $filemap = '';

    /** Directory where registry files for channels are stored.
     * @var string
     */
    var $channelsdir = '';

    /** Name of file used for locking the registry
     * @var string
     */
    var $lockfile = '';

    /** File descriptor used during locking
     * @var resource
     */
    var $lock_fp = null;

    /** Mode used during locking
     * @var int
     */
    var $lock_mode = 0; // XXX UNUSED

    /** Cache of package information.  Structure:
     * array(
     *   'package' => array('id' => ... ),
     *   ... )
     * @var array
     */
    var $pkginfo_cache = array();

    /** Cache of file map.  Structure:
     * array( '/path/to/file' => 'package', ... )
     * @var array
     */
    var $filemap_cache = array();

    /**
     * @var false|PEAR_ChannelFile
     */
    var $_pearChannel;

    /**
     * @var false|PEAR_ChannelFile
     */
    var $_peclChannel;

    /**
     * @var false|PEAR_ChannelFile
     */
    var $_docChannel;

    /**
     * @var PEAR_DependencyDB
     */
    var $_dependencyDB;

    /**
     * @var PEAR_Config
     */
    var $_config;

    /**
     * PEAR_Registry constructor.
     *
     * @param string (optional) PEAR install directory (for .php files)
     * @param PEAR_ChannelFile PEAR_ChannelFile object representing the PEAR channel, if
     *        default values are not desired.  Only used the very first time a PEAR
     *        repository is initialized
     * @param PEAR_ChannelFile PEAR_ChannelFile object representing the PECL channel, if
     *        default values are not desired.  Only used the very first time a PEAR
     *        repository is initialized
     *
     * @access public
     */
    function PEAR_Registry($pear_install_dir = PEAR_INSTALL_DIR, $pear_channel = false,
                           $pecl_channel = false)
    {
        parent::PEAR();
        $this->setInstallDir($pear_install_dir);
        $this->_pearChannel = $pear_channel;
        $this->_peclChannel = $pecl_channel;
        $this->_config      = false;
    }

    function setInstallDir($pear_install_dir = PEAR_INSTALL_DIR)
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->install_dir = $pear_install_dir;
        $this->channelsdir = $pear_install_dir.$ds.'.channels';
        $this->statedir    = $pear_install_dir.$ds.'.registry';
        $this->filemap     = $pear_install_dir.$ds.'.filemap';
        $this->lockfile    = $pear_install_dir.$ds.'.lock';
    }

    function hasWriteAccess()
    {
        if (!file_exists($this->install_dir)) {
            $dir = $this->install_dir;
            while ($dir && $dir != '.') {
                $olddir = $dir;
                $dir    = dirname($dir);
                if ($dir != '.' && file_exists($dir)) {
                    if (is_writeable($dir)) {
                        return true;
                    }

                    return false;
                }

                if ($dir == $olddir) { // this can happen in safe mode
                    return @is_writable($dir);
                }
            }

            return false;
        }

        return is_writeable($this->install_dir);
    }

    function setConfig(&$config, $resetInstallDir = true)
    {
        $this->_config = &$config;
        if ($resetInstallDir) {
            $this->setInstallDir($config->get('php_dir'));
        }
    }

    function _initializeChannelDirs()
    {
        static $running = false;
        if (!$running) {
            $running = true;
            $ds = DIRECTORY_SEPARATOR;
            if (!is_dir($this->channelsdir) ||
                  !file_exists($this->channelsdir . $ds . 'pear.php.net.reg') ||
                  !file_exists($this->channelsdir . $ds . 'pecl.php.net.reg') ||
                  !file_exists($this->channelsdir . $ds . 'doc.php.net.reg') ||
                  !file_exists($this->channelsdir . $ds . '__uri.reg')) {
                if (!file_exists($this->channelsdir . $ds . 'pear.php.net.reg')) {
                    $pear_channel = $this->_pearChannel;
                    if (!is_a($pear_channel, 'PEAR_ChannelFile') || !$pear_channel->validate()) {
                        if (!class_exists('PEAR_ChannelFile')) {
                            require_once 'PEAR/ChannelFile.php';
                        }

                        $pear_channel = new PEAR_ChannelFile;
                        $pear_channel->setAlias('pear');
                        $pear_channel->setServer('pear.php.net');
                        $pear_channel->setSummary('PHP Extension and Application Repository');
                        $pear_channel->setDefaultPEARProtocols();
                        $pear_channel->setBaseURL('REST1.0', 'http://pear.php.net/rest/');
                        $pear_channel->setBaseURL('REST1.1', 'http://pear.php.net/rest/');
                        $pear_channel->setBaseURL('REST1.3', 'http://pear.php.net/rest/');
                        //$pear_channel->setBaseURL('REST1.4', 'http://pear.php.net/rest/');
                    } else {
                        $pear_channel->setServer('pear.php.net');
                        $pear_channel->setAlias('pear');
                    }

                    $pear_channel->validate();
                    $this->_addChannel($pear_channel);
                }

                if (!file_exists($this->channelsdir . $ds . 'pecl.php.net.reg')) {
                    $pecl_channel = $this->_peclChannel;
                    if (!is_a($pecl_channel, 'PEAR_ChannelFile') || !$pecl_channel->validate()) {
                        if (!class_exists('PEAR_ChannelFile')) {
                            require_once 'PEAR/ChannelFile.php';
                        }

                        $pecl_channel = new PEAR_ChannelFile;
                        $pecl_channel->setAlias('pecl');
                        $pecl_channel->setServer('pecl.php.net');
                        $pecl_channel->setSummary('PHP Extension Community Library');
                        $pecl_channel->setDefaultPEARProtocols();
                        $pecl_channel->setBaseURL('REST1.0', 'http://pecl.php.net/rest/');
                        $pecl_channel->setBaseURL('REST1.1', 'http://pecl.php.net/rest/');
                        $pecl_channel->setValidationPackage('PEAR_Validator_PECL', '1.0');
                    } else {
                        $pecl_channel->setServer('pecl.php.net');
                        $pecl_channel->setAlias('pecl');
                    }

                    $pecl_channel->validate();
                    $this->_addChannel($pecl_channel);
                }

                if (!file_exists($this->channelsdir . $ds . 'doc.php.net.reg')) {
                    $doc_channel = $this->_docChannel;
                    if (!is_a($doc_channel, 'PEAR_ChannelFile') || !$doc_channel->validate()) {
                        if (!class_exists('PEAR_ChannelFile')) {
                            require_once 'PEAR/ChannelFile.php';
                        }

                        $doc_channel = new PEAR_ChannelFile;
                        $doc_channel->setAlias('phpdocs');
                        $doc_channel->setServer('doc.php.net');
                        $doc_channel->setSummary('PHP Documentation Team');
                        $doc_channel->setDefaultPEARProtocols();
                        $doc_channel->setBaseURL('REST1.0', 'http://doc.php.net/rest/');
                        $doc_channel->setBaseURL('REST1.1', 'http://doc.php.net/rest/');
                        $doc_channel->setBaseURL('REST1.3', 'http://doc.php.net/rest/');
                    } else {
                        $doc_channel->setServer('doc.php.net');
                        $doc_channel->setAlias('doc');
                    }

                    $doc_channel->validate();
                    $this->_addChannel($doc_channel);
                }

                if (!file_exists($this->channelsdir . $ds . '__uri.reg')) {
                    if (!class_exists('PEAR_ChannelFile')) {
                        require_once 'PEAR/ChannelFile.php';
                    }

                    $private = new PEAR_ChannelFile;
                    $private->setName('__uri');
                    $private->setDefaultPEARProtocols();
                    $private->setBaseURL('REST1.0', '****');
                    $private->setSummary('Pseudo-channel for static packages');
                    $this->_addChannel($private);
                }
                $this->_rebuildFileMap();
            }

            $running = false;
        }
    }

    function _initializeDirs()
    {
        $ds = DIRECTORY_SEPARATOR;
        // XXX Compatibility code should be removed in the future
        // rename all registry files if any to lowercase
        if (!OS_WINDOWS && file_exists($this->statedir) && is_dir($this->statedir) &&
              $handle = opendir($this->statedir)) {
            $dest = $this->statedir . $ds;
            while (false !== ($file = readdir($handle))) {
                if (preg_match('/^.*[A-Z].*\.reg\\z/', $file)) {
                    rename($dest . $file, $dest . strtolower($file));
                }
            }
            closedir($handle);
        }

        $this->_initializeChannelDirs();
        if (!file_exists($this->filemap)) {
            $this->_rebuildFileMap();
        }
        $this->_initializeDepDB();
    }

    function _initializeDepDB()
    {
        if (!isset($this->_dependencyDB)) {
            static $initializing = false;
            if (!$initializing) {
                $initializing = true;
                if (!$this->_config) { // never used?
                    $file = OS_WINDOWS ? 'pear.ini' : '.pearrc';
                    $this->_config = &new PEAR_Config($this->statedir . DIRECTORY_SEPARATOR .
                        $file);
                    $this->_config->setRegistry($this);
                    $this->_config->set('php_dir', $this->install_dir);
                }

                $this->_dependencyDB = &PEAR_DependencyDB::singleton($this->_config);
                if (PEAR::isError($this->_dependencyDB)) {
                    // attempt to recover by removing the dep db
                    if (file_exists($this->_config->get('php_dir', null, 'pear.php.net') .
                        DIRECTORY_SEPARATOR . '.depdb')) {
                        @unlink($this->_config->get('php_dir', null, 'pear.php.net') .
                            DIRECTORY_SEPARATOR . '.depdb');
                    }

                    $this->_dependencyDB = &PEAR_DependencyDB::singleton($this->_config);
                    if (PEAR::isError($this->_dependencyDB)) {
                        echo $this->_dependencyDB->getMessage();
                        echo 'Unrecoverable error';
                        exit(1);
                    }
                }

                $initializing = false;
            }
        }
    }

    /**
     * PEAR_Registry destructor.  Makes sure no locks are forgotten.
     *
     * @access private
     */
    function _PEAR_Registry()
    {
        parent::_PEAR();
        if (is_resource($this->lock_fp)) {
            $this->_unlock();
        }
    }

    /**
     * Make sure the directory where we keep registry files exists.
     *
     * @return bool TRUE if directory exists, FALSE if it could not be
     * created
     *
     * @access private
     */
    function _assertStateDir($channel = false)
    {
        if ($channel && $this->_getChannelFromAlias($channel) != 'pear.php.net') {
            return $this->_assertChannelStateDir($channel);
        }

        static $init = false;
        if (!file_exists($this->statedir)) {
            if (!$this->hasWriteAccess()) {
                return false;
            }

            require_once 'System.php';
            if (!System::mkdir(array('-p', $this->statedir))) {
                return $this->raiseError("could not create directory '{$this->statedir}'");
            }
            $init = true;
        } elseif (!is_dir($this->statedir)) {
            return $this->raiseError('Cannot create directory ' . $this->statedir . ', ' .
                'it already exists and is not a directory');
        }

        $ds = DIRECTORY_SEPARATOR;
        if (!file_exists($this->channelsdir)) {
            if (!file_exists($this->channelsdir . $ds . 'pear.php.net.reg') ||
                  !file_exists($this->channelsdir . $ds . 'pecl.php.net.reg') ||
                  !file_exists($this->channelsdir . $ds . 'doc.php.net.reg') ||
                  !file_exists($this->channelsdir . $ds . '__uri.reg')) {
                $init = true;
            }
        } elseif (!is_dir($this->channelsdir)) {
            return $this->raiseError('Cannot create directory ' . $this->channelsdir . ', ' .
                'it already exists and is not a directory');
        }

        if ($init) {
            static $running = false;
            if (!$running) {
                $running = true;
                $this->_initializeDirs();
                $running = false;
                $init = false;
            }
        } else {
            $this->_initializeDepDB();
        }

        return true;
    }

    /**
     * Make sure the directory where we keep registry files exists for a non-standard channel.
     *
     * @param string channel name
     * @return bool TRUE if directory exists, FALSE if it could not be
     * created
     *
     * @access private
     */
    function _assertChannelStateDir($channel)
    {
        $ds = DIRECTORY_SEPARATOR;
        if (!$channel || $this->_getChannelFromAlias($channel) == 'pear.php.net') {
            if (!file_exists($this->channelsdir . $ds . 'pear.php.net.reg')) {
                $this->_initializeChannelDirs();
            }
            return $this->_assertStateDir($channel);
        }

        $channelDir = $this->_channelDirectoryName($channel);
        if (!is_dir($this->channelsdir) ||
              !file_exists($this->channelsdir . $ds . 'pear.php.net.reg')) {
            $this->_initializeChannelDirs();
        }

        if (!file_exists($channelDir)) {
            if (!$this->hasWriteAccess()) {
                return false;
            }

            require_once 'System.php';
            if (!System::mkdir(array('-p', $channelDir))) {
                return $this->raiseError("could not create directory '" . $channelDir .
                    "'");
            }
        } elseif (!is_dir($channelDir)) {
            return $this->raiseError("could not create directory '" . $channelDir .
                "', already exists and is not a directory");
        }

        return true;
    }

    /**
     * Make sure the directory where we keep registry files for channels exists
     *
     * @return bool TRUE if directory exists, FALSE if it could not be
     * created
     *
     * @access private
     */
    function _assertChannelDir()
    {
        if (!file_exists($this->channelsdir)) {
            if (!$this->hasWriteAccess()) {
                return false;
            }

            require_once 'System.php';
            if (!System::mkdir(array('-p', $this->channelsdir))) {
                return $this->raiseError("could not create directory '{$this->channelsdir}'");
            }
        } elseif (!is_dir($this->channelsdir)) {
            return $this->raiseError("could not create directory '{$this->channelsdir}" .
                "', it already exists and is not a directory");
        }

        if (!file_exists($this->channelsdir . DIRECTORY_SEPARATOR . '.alias')) {
            if (!$this->hasWriteAccess()) {
                return false;
            }

            require_once 'System.php';
            if (!System::mkdir(array('-p', $this->channelsdir . DIRECTORY_SEPARATOR . '.alias'))) {
                return $this->raiseError("could not create directory '{$this->channelsdir}/.alias'");
            }
        } elseif (!is_dir($this->channelsdir . DIRECTORY_SEPARATOR . '.alias')) {
            return $this->raiseError("could not create directory '{$this->channelsdir}" .
                "/.alias', it already exists and is not a directory");
        }

        return true;
    }

    /**
     * Get the name of the file where data for a given package is stored.
     *
     * @param string channel name, or false if this is a PEAR package
     * @param string package name
     *
     * @return string registry file name
     *
     * @access public
     */
    function _packageFileName($package, $channel = false)
    {
        if ($channel && $this->_getChannelFromAlias($channel) != 'pear.php.net') {
            return $this->_channelDirectoryName($channel) . DIRECTORY_SEPARATOR .
                strtolower($package) . '.reg';
        }

        return $this->statedir . DIRECTORY_SEPARATOR . strtolower($package) . '.reg';
    }

    /**
     * Get the name of the file where data for a given channel is stored.
     * @param string channel name
     * @return string registry file name
     */
    function _channelFileName($channel, $noaliases = false)
    {
        if (!$noaliases) {
            if (file_exists($this->_getChannelAliasFileName($channel))) {
                $channel = implode('', file($this->_getChannelAliasFileName($channel)));
            }
        }
        return $this->channelsdir . DIRECTORY_SEPARATOR . str_replace('/', '_',
            strtolower($channel)) . '.reg';
    }

    /**
     * @param string
     * @return string
     */
    function _getChannelAliasFileName($alias)
    {
        return $this->channelsdir . DIRECTORY_SEPARATOR . '.alias' .
              DIRECTORY_SEPARATOR . str_replace('/', '_', strtolower($alias)) . '.txt';
    }

    /**
     * Get the name of a channel from its alias
     */
    function _getChannelFromAlias($channel)
    {
        if (!$this->_channelExists($channel)) {
            if ($channel == 'pear.php.net') {
                return 'pear.php.net';
            }

            if ($channel == 'pecl.php.net') {
                return 'pecl.php.net';
            }

            if ($channel == 'doc.php.net') {
                return 'doc.php.net';
            }

            if ($channel == '__uri') {
                return '__uri';
            }

            return false;
        }

        $channel = strtolower($channel);
        if (file_exists($this->_getChannelAliasFileName($channel))) {
            // translate an alias to an actual channel
            return implode('', file($this->_getChannelAliasFileName($channel)));
        }

        return $channel;
    }

    /**
     * Get the alias of a channel from its alias or its name
     */
    function _getAlias($channel)
    {
        if (!$this->_channelExists($channel)) {
            if ($channel == 'pear.php.net') {
                return 'pear';
            }

            if ($channel == 'pecl.php.net') {
                return 'pecl';
            }

            if ($channel == 'doc.php.net') {
                return 'phpdocs';
            }

            return false;
        }

        $channel = $this->_getChannel($channel);
        if (PEAR::isError($channel)) {
            return $channel;
        }

        return $channel->getAlias();
    }

    /**
     * Get the name of the file where data for a given package is stored.
     *
     * @param string channel name, or false if this is a PEAR package
     * @param string package name
     *
     * @return string registry file name
     *
     * @access public
     */
    function _channelDirectoryName($channel)
    {
        if (!$channel || $this->_getChannelFromAlias($channel) == 'pear.php.net') {
            return $this->statedir;
        }

        $ch = $this->_getChannelFromAlias($channel);
        if (!$ch) {
            $ch = $channel;
        }

        return $this->statedir . DIRECTORY_SEPARATOR . strtolower('.channel.' .
            str_replace('/', '_', $ch));
    }

    function _openPackageFile($package, $mode, $channel = false)
    {
        if (!$this->_assertStateDir($channel)) {
            return null;
        }

        if (!in_array($mode, array('r', 'rb')) && !$this->hasWriteAccess()) {
            return null;
        }

        $file = $this->_packageFileName($package, $channel);
        if (!file_exists($file) && $mode == 'r' || $mode == 'rb') {
            return null;
        }

        $fp = @fopen($file, $mode);
        if (!$fp) {
            return null;
        }

        return $fp;
    }

    function _closePackageFile($fp)
    {
        fclose($fp);
    }

    function _openChannelFile($channel, $mode)
    {
        if (!$this->_assertChannelDir()) {
            return null;
        }

        if (!in_array($mode, array('r', 'rb')) && !$this->hasWriteAccess()) {
            return null;
        }

        $file = $this->_channelFileName($channel);
        if (!file_exists($file) && $mode == 'r' || $mode == 'rb') {
            return null;
        }

        $fp = @fopen($file, $mode);
        if (!$fp) {
            return null;
        }

        return $fp;
    }

    function _closeChannelFile($fp)
    {
        fclose($fp);
    }

    function _rebuildFileMap()
    {
        if (!class_exists('PEAR_Installer_Role')) {
            require_once 'PEAR/Installer/Role.php';
        }

        $channels = $this->_listAllPackages();
        $files = array();
        foreach ($channels as $channel => $packages) {
            foreach ($packages as $package) {
                $version = $this->_packageInfo($package, 'version', $channel);
                $filelist = $this->_packageInfo($package, 'filelist', $channel);
                if (!is_array($filelist)) {
                    continue;
                }

                foreach ($filelist as $name => $attrs) {
                    if (isset($attrs['attribs'])) {
                        $attrs = $attrs['attribs'];
                    }

                    // it is possible for conflicting packages in different channels to
                    // conflict with data files/doc files
                    if ($name == 'dirtree') {
                        continue;
                    }

                    if (isset($attrs['role']) && !in_array($attrs['role'],
                          PEAR_Installer_Role::getInstallableRoles())) {
                        // these are not installed
                        continue;
                    }

                    if (isset($attrs['role']) && !in_array($attrs['role'],
                          PEAR_Installer_Role::getBaseinstallRoles())) {
                        $attrs['baseinstalldir'] = $package;
                    }

                    if (isset($attrs['baseinstalldir'])) {
                        $file = $attrs['baseinstalldir'].DIRECTORY_SEPARATOR.$name;
                    } else {
                        $file = $name;
                    }

                    $file = preg_replace(',^/+,', '', $file);
                    if ($channel != 'pear.php.net') {
                        if (!isset($files[$attrs['role']])) {
                            $files[$attrs['role']] = array();
                        }
                        $files[$attrs['role']][$file] = array(strtolower($channel),
                            strtolower($package));
                    } else {
                        if (!isset($files[$attrs['role']])) {
                            $files[$attrs['role']] = array();
                        }
                        $files[$attrs['role']][$file] = strtolower($package);
                    }
                }
            }
        }


        $this->_assertStateDir();
        if (!$this->hasWriteAccess()) {
            return false;
        }

        $fp = @fopen($this->filemap, 'wb');
        if (!$fp) {
            return false;
        }

        $this->filemap_cache = $files;
        fwrite($fp, serialize($files));
        fclose($fp);
        return true;
    }

    function _readFileMap()
    {
        if (!file_exists($this->filemap)) {
            return array();
        }

        $fp = @fopen($this->filemap, 'r');
        if (!$fp) {
            return $this->raiseError('PEAR_Registry: could not open filemap "' . $this->filemap . '"', PEAR_REGISTRY_ERROR_FILE, null, null, $php_errormsg);
        }

        clearstatcache();
        $rt = get_magic_quotes_runtime();
        set_magic_quotes_runtime(0);
        $fsize = filesize($this->filemap);
        fclose($fp);
        $data = file_get_contents($this->filemap);
        set_magic_quotes_runtime($rt);
        $tmp = unserialize($data);
        if (!$tmp && $fsize > 7) {
            return $this->raiseError('PEAR_Registry: invalid filemap data', PEAR_REGISTRY_ERROR_FORMAT, null, null, $data);
        }

        $this->filemap_cache = $tmp;
        return true;
    }

    /**
     * Lock the registry.
     *
     * @param integer lock mode, one of LOCK_EX, LOCK_SH or LOCK_UN.
     *                See flock manual for more information.
     *
     * @return bool TRUE on success, FALSE if locking failed, or a
     *              PEAR error if some other error occurs (such as the
     *              lock file not being writable).
     *
     * @access private
     */
    function _lock($mode = LOCK_EX)
    {
        if (stristr(php_uname(), 'Windows 9')) {
            return true;
        }

        if ($mode != LOCK_UN && is_resource($this->lock_fp)) {
            // XXX does not check type of lock (LOCK_SH/LOCK_EX)
            return true;
        }

        if (!$this->_assertStateDir()) {
            if ($mode == LOCK_EX) {
                return $this->raiseError('Registry directory is not writeable by the current user');
            }

            return true;
        }

        $open_mode = 'w';
        // XXX People reported problems with LOCK_SH and 'w'
        if ($mode === LOCK_SH || $mode === LOCK_UN) {
            if (!file_exists($this->lockfile)) {
                touch($this->lockfile);
            }
            $open_mode = 'r';
        }

        if (!is_resource($this->lock_fp)) {
            $this->lock_fp = @fopen($this->lockfile, $open_mode);
        }

        if (!is_resource($this->lock_fp)) {
            $this->lock_fp = null;
            return $this->raiseError("could not create lock file" .
                                     (isset($php_errormsg) ? ": " . $php_errormsg : ""));
        }

        if (!(int)flock($this->lock_fp, $mode)) {
            switch ($mode) {
                case LOCK_SH: $str = 'shared';    break;
                case LOCK_EX: $str = 'exclusive'; break;
                case LOCK_UN: $str = 'unlock';    break;
                default:      $str = 'unknown';   break;
            }

            //is resource at this point, close it on error.
            fclose($this->lock_fp);
            $this->lock_fp = null;
            return $this->raiseError("could not acquire $str lock ($this->lockfile)",
                                     PEAR_REGISTRY_ERROR_LOCK);
        }

        return true;
    }

    function _unlock()
    {
        $ret = $this->_lock(LOCK_UN);
        if (is_resource($this->lock_fp)) {
            fclose($this->lock_fp);
        }

        $this->lock_fp = null;
        return $ret;
    }

    function _packageExists($package, $channel = false)
    {
        return file_exists($this->_packageFileName($package, $channel));
    }

    /**
     * Determine whether a channel exists in the registry
     *
     * @param string Channel name
     * @param bool if true, then aliases will be ignored
     * @return boolean
     */
    function _channelExists($channel, $noaliases = false)
    {
        $a = file_exists($this->_channelFileName($channel, $noaliases));
        if (!$a && $channel == 'pear.php.net') {
            return true;
        }

        if (!$a && $channel == 'pecl.php.net') {
            return true;
        }

        if (!$a && $channel == 'doc.php.net') {
            return true;
        }

        return $a;
    }

    /**
     * Determine whether a mirror exists within the deafult channel in the registry
     *
     * @param string Channel name
     * @param string Mirror name
     *
     * @return boolean
     */
    function _mirrorExists($channel, $mirror)
    {
        $data = $this->_channelInfo($channel);
        if (!isset($data['servers']['mirror'])) {
            return false;
        }

        foreach ($data['servers']['mirror'] as $m) {
            if ($m['attribs']['host'] == $mirror) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param PEAR_ChannelFile Channel object
     * @param donotuse
     * @param string Last-Modified HTTP tag from remote request
     * @return boolean|PEAR_Error True on creation, false if it already exists
     */
    function _addChannel($channel, $update = false, $lastmodified = false)
    {
        if (!is_a($channel, 'PEAR_ChannelFile')) {
            return false;
        }

        if (!$channel->validate()) {
            return false;
        }

        if (file_exists($this->_channelFileName($channel->getName()))) {
            if (!$update) {
                return false;
            }

            $checker = $this->_getChannel($channel->getName());
            if (PEAR::isError($checker)) {
                return $checker;
            }

            if ($channel->getAlias() != $checker->getAlias()) {
                if (file_exists($this->_getChannelAliasFileName($checker->getAlias()))) {
                    @unlink($this->_getChannelAliasFileName($checker->getAlias()));
                }
            }
        } else {
            if ($update && !in_array($channel->getName(), array('pear.php.net', 'pecl.php.net', 'doc.php.net'))) {
                return false;
            }
        }

        $ret = $this->_assertChannelDir();
        if (PEAR::isError($ret)) {
            return $ret;
        }

        $ret = $this->_assertChannelStateDir($channel->getName());
        if (PEAR::isError($ret)) {
            return $ret;
        }

        if ($channel->getAlias() != $channel->getName()) {
            if (file_exists($this->_getChannelAliasFileName($channel->getAlias())) &&
                  $this->_getChannelFromAlias($channel->getAlias()) != $channel->getName()) {
                $channel->setAlias($channel->getName());
            }

            if (!$this->hasWriteAccess()) {
                return false;
            }

            $fp = @fopen($this->_getChannelAliasFileName($channel->getAlias()), 'w');
            if (!$fp) {
                return false;
            }

            fwrite($fp, $channel->getName());
            fclose($fp);
        }

        if (!$this->hasWriteAccess()) {
            return false;
        }

        $fp = @fopen($this->_channelFileName($channel->getName()), 'wb');
        if (!$fp) {
            return false;
        }

        $info = $channel->toArray();
        if ($lastmodified) {
            $info['_lastmodified'] = $lastmodified;
        } else {
            $info['_lastmodified'] = date('r');
        }

        fwrite($fp, serialize