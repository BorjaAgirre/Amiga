<?php
/**
 * PEAR_Downloader, the PEAR Installer's download utility class
 *
 * PHP versions 4 and 5
 *
 * @category   pear
 * @package    PEAR
 * @author     Greg Beaver <cellog@php.net>
 * @author     Stig Bakken <ssb@php.net>
 * @author     Tomas V. V. Cox <cox@idecnet.com>
 * @author     Martin Jansen <mj@php.net>
 * @copyright  1997-2009 The Authors
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @version    CVS: $Id$
 * @link       http://pear.php.net/package/PEAR
 * @since      File available since Release 1.3.0
 */

/**
 * Needed for constants, extending
 */
require_once 'PEAR/Common.php';

define('PEAR_INSTALLER_OK',       1);
define('PEAR_INSTALLER_FAILED',   0);
define('PEAR_INSTALLER_SKIPPED', -1);
define('PEAR_INSTALLER_ERROR_NO_PREF_STATE', 2);

/**
 * Administration class used to download anything from the internet (PEAR Packages,
 * static URLs, xml files)
 *
 * @category   pear
 * @package    PEAR
 * @author     Greg Beaver <cellog@php.net>
 * @author     Stig Bakken <ssb@php.net>
 * @author     Tomas V. V. Cox <cox@idecnet.com>
 * @author     Martin Jansen <mj@php.net>
 * @copyright  1997-2009 The Authors
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @version    Release: 1.9.5
 * @link       http://pear.php.net/package/PEAR
 * @since      Class available since Release 1.3.0
 */
class PEAR_Downloader extends PEAR_Common
{
    /**
     * @var PEAR_Registry
     * @access private
     */
    var $_registry;

    /**
     * Preferred Installation State (snapshot, devel, alpha, beta, stable)
     * @var string|null
     * @access private
     */
    var $_preferredState;

    /**
     * Options from command-line passed to Install.
     *
     * Recognized options:<br />
     *  - onlyreqdeps   : install all required dependencies as well
     *  - alldeps       : install all dependencies, including optional
     *  - installroot   : base relative path to install files in
     *  - force         : force a download even if warnings would prevent it
     *  - nocompress    : download uncompressed tarballs
     * @see PEAR_Command_Install
     * @access private
     * @var array
     */
    var $_options;

    /**
     * Downloaded Packages after a call to download().
     *
     * Format of each entry:
     *
     * <code>
     * array('pkg' => 'package_name', 'file' => '/path/to/local/file',
     *    'info' => array() // parsed package.xml
     * );
     * </code>
     * @access private
     * @var array
     */
    var $_downloadedPackages = array();

    /**
     * Packages slated for download.
     *
     * This is used to prevent downloading a package more than once should it be a dependency
     * for two packages to be installed.
     * Format of each entry:
     *
     * <pre>
     * array('package_name1' => parsed package.xml, 'package_name2' => parsed package.xml,
     * );
     * </pre>
     * @access private
     * @var array
     */
    var $_toDownload = array();

    /**
     * Array of every package installed, with names lower-cased.
     *
     * Format:
     * <code>
     * array('package1' => 0, 'package2' => 1, );
     * </code>
     * @var array
     */
    var $_installed = array();

    /**
     * @var array
     * @access private
     */
    var $_errorStack = array();

    /**
     * @var boolean
     * @access private
     */
    var $_internalDownload = false;

    /**
     * Temporary variable used in sorting packages by dependency in {@link sortPkgDeps()}
     * @var array
     * @access private
     */
    var $_packageSortTree;

    /**
     * Temporary directory, or configuration value where downloads will occur
     * @var string
     */
    var $_downloadDir;

    /**
     * @param PEAR_Frontend_*
     * @param array
     * @param PEAR_Config
     */
    function PEAR_Downloader(&$ui, $options, &$config)
    {
        parent::PEAR_Common();
        $this->_options = $options;
        $this->config = &$config;
        $this->_preferredState = $this->config->get('preferred_state');
        $this->ui = &$ui;
        if (!$this->_preferredState) {
            // don't inadvertantly use a non-set preferred_state
            $this->_preferredState = null;
        }

        if (isset($this->_options['installroot'])) {
            $this->config->setInstallRoot($this->_options['installroot']);
        }
        $this->_registry = &$config->getRegistry();

        if (isset($this->_options['alldeps']) || isset($this->_options['onlyreqdeps'])) {
            $this->_installed = $this->_registry->listAllPackages();
            foreach ($this->_installed as $key => $unused) {
                if (!count($unused)) {
                    continue;
                }
                $strtolower = create_function('$a','return strtolower($a);');
                array_walk($this->_installed[$key], $strtolower);
            }
        }
    }

    /**
     * Attempt to discover a channel's remote capabilities from
     * its server name
     * @param string
     * @return boolean
     */
    function discover($channel)
    {
        $this->log(1, 'Attempting to discover channel "' . $channel . '"...');
        PEAR::pushErrorHandling(PEAR_ERROR_RETURN);
        $callback = $this->ui ? array(&$this, '_downloadCallback') : null;
        if (!class_exists('System')) {
            require_once 'System.php';
        }

        $tmpdir = $this->config->get('temp_dir');
        $tmp = System::mktemp('-d -t "' . $tmpdir . '"');
        $a   = $this->downloadHttp('http://' . $channel . '/channel.xml', $this->ui, $tmp, $callback, false);
        PEAR::popErrorHandling();
        if (PEAR::isError($a)) {
            // Attempt to fallback to https automatically.
            PEAR::pushErrorHandling(PEAR_ERROR_RETURN);
            $this->log(1, 'Attempting fallback to https instead of http on channel "' . $channel . '"...');
            $a = $this->downloadHttp('https://' . $channel . '/channel.xml', $this->ui, $tmp, $callback, false);
            PEAR::popErrorHandling();
            if (PEAR::isError($a)) {
                return false;
            }
        }

        list($a, $lastmodified) = $a;
        if (!class_exists('PEAR_ChannelFile')) {
            require_once 'PEAR/ChannelFile.php';
        }

        $b = new PEAR_ChannelFile;
        if ($b->fromXmlFile($a)) {
            unlink($a);
            if ($this->config->get('auto_discover')) {
                $this->_registry->addChannel($b, $lastmodified);
                $alias = $b->getName();
                if ($b->getName() == $this->_registry->channelName($b->getAlias())) {
                    $alias = $b->getAlias();
                }

                $this->log(1, 'Auto-discovered channel "' . $channel .
                    '", alias "' . $alias . '", adding to registry');
            }

            return true;
        }

        unlink($a);
        return false;
    }

    /**
     * For simpler unit-testing
     * @param PEAR_Downloader
     * @return PEAR_Downloader_Package
     */
    function &newDownloaderPackage(&$t)
    {
        if (!class_exists('PEAR_Downloader_Package')) {
            require_once 'PEAR/Downloader/Package.php';
        }
        $a = &new PEAR_Downloader_Package($t);
        return $a;
    }

    /**
     * For simpler unit-testing
     * @param PEAR_Config
     * @param array
     * @param array
     * @param int
     */
    function &getDependency2Object(&$c, $i, $p, $s)
    {
        if (!class_exists('PEAR_Dependency2')) {
            require_once 'PEAR/Dependency2.php';
        }
        $z = &new PEAR_Dependency2($c, $i, $p, $s);
        return $z;
    }

    function &download($params)
    {
        if (!count($params)) {
            $a = array();
            return $a;
        }

        if (!isset($this->_registry)) {
            $this->_registry = &$this->config->getRegistry();
        }

        $channelschecked = array();
        // convert all parameters into PEAR_Downloader_Package objects
        foreach ($params as $i => $param) {
            $params[$i] = &$this->newDownloaderPackage($this);
            PEAR::staticPushErrorHandling(PEAR_ERROR_RETURN);
            $err = $params[$i]->initialize($param);
            PEAR::staticPopErrorHandling();
            if (!$err) {
                // skip parameters that were missed by preferred_state
                continue;
            }

            if (PEAR::isError($err)) {
                if (!isset($this->_options['soft']) && $err->getMessage() !== '') {
                    $this->log(0, $err->getMessage());
                }

                $params[$i] = false;
                if (is_object($param)) {
                    $param = $param->getChannel() . '/' . $param->getPackage();
                }

                if (!isset($this->_options['soft'])) {
                    $this->log(2, 'Package "' . $param . '" is not valid');
                }

                // Message logged above in a specific verbose mode, passing null to not show up on CLI
                $this->pushError(null, PEAR_INSTALLER_SKIPPED);
            } else {
                do {
                    if ($params[$i] && $params[$i]->getType() == 'local') {
                        // bug #7090 skip channel.xml check for local packages
                        break;
                    }

                    if ($params[$i] && !isset($channelschecked[$params[$i]->getChannel()]) &&
                          !isset($this->_options['offline'])
                    ) {
                        $channelschecked[$params[$i]->getChannel()] = true;
                        PEAR::staticPushErrorHandling(PEAR_ERROR_RETURN);
                        if (!class_exists('System')) {
                            require_once 'System.php';
                        }

                        $curchannel = &$this->_registry->getChannel($params[$i]->getChannel());
                        if (PEAR::isError($curchannel)) {
                            PEAR::staticPopErrorHandling();
                            return $this->raiseError($curchannel);
                        }

                        if (PEAR::isError($dir = $this->getDownloadDir())) {
                            PEAR::staticPopErrorHandling();
                            break;
                        }

                        $mirror = $this->config->get('preferred_mirror', null, $params[$i]->getChannel());
                        $url    = 'http://' . $mirror . '/channel.xml';
                        $a = $this->downloadHttp($url, $this->ui, $dir, null, $curchannel->lastModified());

                        PEAR::staticPopErrorHandling();
                        if (PEAR::isError($a) || !$a) {
                            // Attempt fallback to https automatically
                            PEAR::pushErrorHandling(PEAR_ERROR_RETURN);
                            $a = $this->downloadHttp('https://' . $mirror .
                                '/channel.xml', $this->ui, $dir, null, $curchannel->lastModified());

                            PEAR::staticPopErrorHandling();
                            if (PEAR::isError($a) || !$a) {
                                break;
                            }
                        }
                        $this->log(0, 'WARNING: channel "' . $params[$i]->getChannel() . '" has ' .
                            'updated its protocols, use "' . PEAR_RUNTYPE . ' channel-update ' . $params[$i]->getChannel() .
                            '" to update');
                    }
                } while (false);

                if ($params[$i] && !isset($this->_options['downloadonly'])) {
                    if (isset($this->_options['packagingroot'])) {
                        $checkdir = $this->_prependPath(
                            $this->config->get('php_dir', null, $params[$i]->getChannel()),
                            $this->_options['packagingroot']);
                    } else {
                        $checkdir = $this->config->get('php_dir',
                            null, $params[$i]->getChannel());
                    }

                    while ($checkdir && $checkdir != '/' && !file_exists($checkdir)) {
                        $checkdir = dirname($checkdir);
                    }

                    if ($checkdir == '.') {
                        $checkdir = '/';
                    }

                    if (!is_writeable($checkdir)) {
                        return PEAR::raiseError('Cannot install, php_dir for channel "' .
                            $params[$i]->getChannel() . '" is not writeable by the current user');
                    }
                }
            }
        }

        unset($channelschecked);
        PEAR_Downloader_Package::removeDuplicates($params);
        if (!count($params)) {
            $a = array();
            return $a;
        }

        if (!isset($this->_options['nodeps']) && !isset($this->_options['offline'])) {
            $reverify = true;
            while ($reverify) {
                $reverify = false;
                foreach ($params as $i => $param) {
                    //PHP Bug 40768 / PEAR Bug #10944
                    //Nested foreaches fail in PHP 5.2.1
                    key($params);
                    $ret = $params[$i]->detectDependencies($params);
                    if (PEAR::isError($ret)) {
                        $reverify = true;
                        $params[$i] = false;
                        PEAR_Downloader_Package::removeDuplicates($params);
                        if (!isset($this->_options['soft'])) {
                            $this->log(0, $ret->getMessage());
                        }
                        continue 2;
                    }
                }
            }
        }

        if (isset($this->_options['offline'])) {
            $this->log(3, 'Skipping dependency download check, --offline specified');
        }

        if (!count($params)) {
            $a = array();
            return $a;
        }

        while (PEAR_Downloader_Package::mergeDependencies($params));
        PEAR_Downloader_Package::removeDuplicates($params, true);
        $errorparams = array();
        if (PEAR_Downloader_Package::detectStupidDuplicates($params, $errorparams)) {
            if (count($errorparams)) {
                foreach ($errorparams as $param) {
                    $name = $this->_registry->parsedPackageNameToString($param->getParsedPackage());
                    $this->pushError('Duplicate package ' . $name . ' found', PEAR_INSTALLER_FAILED);
                }
                $a = array();
                return $a;
            }
        }

        PEAR_Downloader_Package::removeInstalled($params);
        if (!count($params)) {
            $this->pushError('No valid packages found', PEAR_INSTALLER_FAILED);
            $a = array();
            return $a;
        }

        PEAR::pushErrorHandling(PEAR_ERROR_RETURN);
        $err = $this->analyzeDependencies($params);
        PEAR::popErrorHandling();
        if (!count($params)) {
            $this->pushError('No valid packages found', PEAR_INSTALLER_FAILED);
            $a = array();
            return $a;
        }

        $ret = array();
        $newparams = array();
        if (isset($this->_options['pretend'])) {
            return $params;
        }

        $somefailed = false;
        foreach ($params as $i => $package) {
            PEAR::staticPushErrorHandling(PEAR_ERROR_RETURN);
            $pf = &$params[$i]->download();
            PEAR::staticPopErrorHandling();
            if (PEAR::isError($pf)) {
                if (!isset($this->_options['soft'])) {
                    $this->log(1, $pf->getMessage());
                    $this->log(0, 'Error: cannot download "' .
                        $this->_registry->parsedPackageNameToString($package->getParsedPackage(),
                            true) .
                        '"');
                }
                $somefailed = true;
                continue;
            }

            $newparams[] = &$params[$i];
            $ret[] = array(
                'file' => $pf->getArchiveFile(),
                'info' => &$pf,
                'pkg'  => $pf->getPackage()
            );
        }

        if ($somefailed) {
            // remove params that did not download successfully
            PEAR::pushErrorHandling(PEAR_ERROR_RETURN);
            $err = $this->analyzeDependencies($newparams, true);
            PEAR::popErrorHandling();
            if (!count($newparams)) {
                $this->pushError('Download failed', PEAR_INSTALLER_FAILED);
                $a = array();
                return $a;
            }
        }

        $this->_downloadedPackages = $ret;
        return $newparams;
    }

    /**
     * @param array all packages to be installed
     */
    function analyzeDependencies(&$params, $force = false)
    {
        if (isset($this->_options['downloadonly'])) {
            return;
        }

        PEAR::staticPushErrorHandling(PEAR_ERROR_RETURN);
        $redo  = true;
        $reset = $hasfailed = $failed = false;
        while ($redo) {
            $redo = false;
            foreach ($params as $i => $param) {
                $deps = $param->getDeps();
                if (!$deps) {
                    $depchecker = &$this->getDependency2Object($this->config, $this->getOptions(),
                        $param->getParsedPackage(), PEAR_VALIDATE_DOWNLOADING);
                    $send = $param->getPackageFile();

                    $installcheck = $depchecker->validatePackage($send, $this, $params);
                    if (PEAR::isError($installcheck)) {
                        if (!isset($this->_options['soft'])) {
                            $this->log(0, $installcheck->getMessage());
                        }
                        $hasfailed  = true;
                        $params[$i] = false;
                        $reset      = true;
                        $redo       = true;
                        $failed     = false;
                        PEAR_Downloader_Package::removeDuplicates($params);
                        continue 2;
                    }
                    continue;
                }

                if (!$reset && $param->alreadyValidated() && !$force) {
                    continue;
                }

                if (count($deps)) {
                    $depchecker = &$this->getDependency2Object($this->config, $this->getOptions(),
                        $param->getParsedPackage(), PEAR_VALIDATE_DOWNLOADING);
                    $send = $param->getPackageFile();
                    if ($send === null) {
                        $send = $param->getDownloadURL();
                    }

                    $installcheck = $depchecker->validatePackage($send, $this, $params);
                    if (PEAR::isError($installcheck)) {
                        if (!isset($this->_options['soft'])) {
                            $this->log(0, $installcheck->getMessage());
                        }
                        $hasfailed  = true;
                        $params[$i] = false;
                        $reset      = true;
                        $redo       = true;
                        $failed     = false;
                        PEAR_Downloader_Package::removeDuplicates($params);
                        continue 2;
                    }

                    $failed = false;
                    if (isset($deps['required']) && is_array($deps['required'])) {
                        foreach ($deps['required'] as $type => $dep) {
                            // note: Dependency2 will never return a PEAR_Error if ignore-errors
                            // is specified, so soft is needed to turn off logging
                            if (!isset($dep[0])) {
                                if (PEAR::isError($e = $depchecker->{"validate{$type}Dependency"}($dep,
                                      true, $params))) {
                                    $failed = true;
                                    if (!isset($this->_options['soft'])) {
                                        $this->log(0, $e->getMessage());
                                    }
                                } elseif (is_array($e) && !$param->alreadyValidated()) {
                                    if (!isset($this->_options['soft'])) {
                                        $this->log(0, $e[0]);
                                    }
                                }
                            } else {
                                foreach ($dep as $d) {
                                    if (PEAR::isError($e =
                                          $depchecker->{"validate{$type}Dependency"}($d,
                                          true, $params))) {
                                        $failed = true;
                                        if (!isset($this->_options['soft'])) {
                                            $this->log(0, $e->getMessage());
                                        }
                                    } elseif (is_array($e) && !$param->alreadyValidated()) {
                                        if (!isset($this->_options['soft'])) {
                                            $this->log(0, $e[0]);
                                        }
                                    }
                                }
                            }
                        }

                        if (isset($deps['optional']) && is_array($deps['optional'])) {
                            foreach ($deps['optional'] as $type => $dep) {
                                if (!isset($dep[0])) {
                                    if (PEAR::isError($e =
                                          $depchecker->{"validate{$type}Dependency"}($dep,
                                          false, $params))) {
                                        $failed = true;
                                        if (!isset($this->_options['soft'])) {
                                            $this->log(0, $e->getMessage());
                                        }
                                    } elseif (is_array($e) && !$param->alreadyValidated()) {
                                        if (!isset($this->_options['soft'])) {
                                            $this->log(0, $e[0]);
                                        }
                                    }
                                } else {
                                    foreach ($dep as $d) {
                                        if (PEAR::isError($e =
                                              $depchecker->{"validate{$type}Dependency"}($d,
                                              false, $params))) {
                                            $failed = true;
                                            if (!isset($this->_options['soft'])) {
                                                $this->log(0, $e->getMessage());
                                            }
                                        } elseif (is_array($e) && !$param->alreadyValidated()) {
                                            if (!isset($this->_options['soft'])) {
                                                $this->log(0, $e[0]);
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        $groupname = $param->getGroup();
                        if (isset($deps['group']) && $groupname) {
                            if (!isset($deps['group'][0])) {
                                $deps['group'] = array($deps['group']);
                            }

                            $found = false;
                            foreach ($deps['group'] as $group) {
                                if ($group['attribs']['name'] == $groupname) {
                                    $found = true;
                                    break;
                                }
                            }

                            if ($found) {
                                unset($group['attribs']);
                                foreach ($group as $type => $dep) {
                                    if (!isset($dep[0])) {
                                        if (PEAR::isError($e =
                                              $depchecker->{"validate{$type}Dependency"}($dep,
                                              false, $params))) {
                                            $failed = true;
                                            if (!isset($this->_options['soft'])) {
                                                $this->log(0, $e->getMessage());
                                            }
                                        } elseif (is_array($e) && !$param->alreadyValidated()) {
                                            if (!isset($this->_options['soft'])) {
                                                $this->log(0, $e[0]);
                                            }
                                        }
                                    } else {
                                        foreach ($dep as $d) {
                                            if (PEAR::isError($e =
                                                  $depchecker->{"validate{$type}Dependency"}($d,
                                                  false, $params))) {
                                                $failed = true;
                                                if (!isset($this->_options['soft'])) {
                                                    $this->log(0, $e->getMessage());
                                                }
                                            } elseif (is_array($e) && !$param->alreadyValidated()) {
                                                if (!isset($this->_options['soft'])) {
                                                    $this->log(0, $e[0]);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        foreach ($deps as $dep) {
                            if (PEAR::isError($e = $depchecker->validateDependency1($dep, $params))) {
                                $failed = true;
                                if (!isset($this->_options['soft'])) {
                                    $this->log(0, $e->getMessage());
                                }
                            } elseif (is_array($e) && !$param->alreadyValidated()) {
                                if (!isset($this->_options['soft'])) {
                                    $this->log(0, $e[0]);
                                }
                            }
                        }
                    }
                    $params[$i]->setValidated();
                }

                if ($failed) {
                    $hasfailed  = true;
                    $params[$i] = false;
                    $reset      = true;
                    $redo       = true;
                    $failed     = false;
                    PEAR_Downloader_Package::removeDuplicates($params);
                    continue 2;
                }
            }
        }

        PEAR::staticPopErrorHandling();
        if ($hasfailed && (isset($this->_options['ignore-errors']) ||
              isset($this->_options['nodeps']))) {
            // this is probably not needed, but just in case
            if (!isset($this->_options['soft'])) {
                $this->log(0, 'WARNING: dependencies failed');
            }
        }
    }

    /**
     * Retrieve the directory that downloads will happen in
     * @access private
     * @return string
     */
    function getDownloadDir()
    {
        if (isset($this->_downloadDir)) {
            return $this->_downloadDir;
        }

        $downloaddir = $this->config->get('download_dir');
        if (empty($downloaddir) || (is_dir($downloaddir) && !is_writable($downloaddir))) {
            if  (is_dir($downloaddir) && !is_writable($downloaddir)) {
                $this->log(0, 'WARNING: configuration download directory "' . $downloaddir .
                    '" is not writeable.  Change download_dir config variable to ' .
                    'a writeable dir to avoid this warning');
            }

            if (!class_exists('System')) {
                require_once 'System.php';
            }

            if (PEAR::isError($downloaddir = System::mktemp('-d'))) {
                return $downloaddir;
            }
            $this->log(3, '+ tmp dir created at ' . $downloaddir);
        }

        if (!is_writable($downloaddir)) {
            if (PEAR::isError(System::mkdir(array('-p', $downloaddir))) ||
                  !is_writable($downloaddir)) {
                return PEAR::raiseError('download directory "' . $downloaddir .
                    '" is not writeable.  Change download_dir config variable to ' .
                    'a writeable dir');
            }
        }

        return $this->_downloadDir = $downloaddir;
    }

    function setDownloadDir($dir)
    {
        if (!@is_writable($dir)) {
            if (PEAR::isError(System::mkdir(array('-p', $dir)))) {
                return PEAR::raiseError('download directory "' . $dir .
                    '" is not writeable.  Change download_dir config variable to ' .
                    'a writeable dir');
            }
        }
        $this->_downloadDir = $dir;
    }

    function configSet($key, $value, $layer = 'user', $channel = false)
    {
        $this->config->set($key, $value, $layer, $channel);
        $this->_preferredState = $this->config->get('preferred_state', null, $channel);
        if (!$this->_preferredState) {
            // don't inadvertantly use a non-set preferred_state
            $this->_preferredState = null;
        }
    }

    function setOptions($options)
    {
        $this->_options = $options;
    }

    function getOptions()
    {
        return $this->_options;
    }


    /**
     * @param array output of {@link parsePackageName()}
     * @access private
     */
    function _getPackageDownloadUrl($parr)
    {
        $curchannel = $this->config->get('default_channel');
        $this->configSet('default_channel', $parr['channel']);
        // getDownloadURL returns an array.  On error, it only contains information
        // on the latest release as array(version, info).  On success it contains
        // array(version, info, download url string)
        $state = isset($parr['state']) ? $parr['state'] : $this->config->get('preferred_state');
        if (!$this->_registry->channelExists($parr['channel'])) {
            do {
                if ($this->config->get('auto_discover') && $this->discover($parr['channel'])) {
                    break;
                }

                $this->configSet('default_channel', $curchannel);
                return PEAR::raiseError('Unknown remote channel: ' . $parr['channel']);
            } while (false);
        }

        $chan = &$this->_registry->getChannel($parr['channel']);
        if (PEAR::isError($chan)) {
            return $chan;
        }

        PEAR::staticPushErrorHandling(PEAR_ERROR_RETURN);
        $version   = $this->_registry->packageInfo($parr['package'], 'version', $parr['channel']);
        $stability = $this->_registry->packageInfo($parr['package'], 'stability', $parr['channel']);
        // package is installed - use the installed release stability level
        if (!isset($parr['state']) && $stability !== null) {
            $state = $stability['release'];
        }
        PEAR::staticPopErrorHandling();
        $base2 = false;

        $preferred_mirror = $this->config->get('preferred_mirror');
        if (!$chan->supportsREST($preferred_mirror) ||
              (
               !($base2 = $chan->getBaseURL('REST1.3', $preferred_mirror))
               &&
               !($base = $chan->getBaseURL('REST1.0', $preferred_mirror))
              )
        ) {
            return $this->raiseError($parr['channel'] . ' is using a unsupported protocol - This should never happen.');
        }

        if ($base2) {
            $rest = &$this->config->getREST('1.3', $this->_options);
            $base = $base2;
        } else {
            $rest = &$this->config->getREST('1.0', $this->_options);
        }

     