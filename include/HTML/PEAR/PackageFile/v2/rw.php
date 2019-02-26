<?php
/**
 * PEAR_PackageFile_v2, package.xml version 2.0, read/write version
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
 * @since      File available since Release 1.4.0a8
 */
/**
 * For base class
 */
require_once 'PEAR/PackageFile/v2.php';
/**
 * @category   pear
 * @package    PEAR
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  1997-2009 The Authors
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @version    Release: 1.9.5
 * @link       http://pear.php.net/package/PEAR
 * @since      Class available since Release 1.4.0a8
 */
class PEAR_PackageFile_v2_rw extends PEAR_PackageFile_v2
{
    /**
     * @param string Extension name
     * @return bool success of operation
     */
    function setProvidesExtension($extension)
    {
        if (in_array($this->getPackageType(),
              array('extsrc', 'extbin', 'zendextsrc', 'zendextbin'))) {
            if (!isset($this->_packageInfo['providesextension'])) {
                // ensure that the channel tag is set up in the right location
                $this->_packageInfo = $this->_insertBefore($this->_packageInfo,
                    array('usesrole', 'usestask', 'srcpackage', 'srcuri', 'phprelease',
                    'extsrcrelease', 'extbinrelease', 'zendextsrcrelease', 'zendextbinrelease',
                    'bundle', 'changelog'),
                    $extension, 'providesextension');
            }
            $this->_packageInfo['providesextension'] = $extension;
            return true;
        }
        return false;
    }

    function setPackage($package)
    {
        $this->_isValid = 0;
        if (!isset($this->_packageInfo['attribs'])) {
            $this->_packageInfo = array_merge(array('attribs' => array(
                                 'version' => '2.0',
                                 'xmlns' => 'http://pear.php.net/dtd/package-2.0',
                                 'xmlns:tasks' => 'http://pear.php.net/dtd/tasks-1.0',
                                 'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                                 'xsi:schemaLocation' => 'http://pear.php.net/dtd/tasks-1.0
    http://pear.php.net/dtd/tasks-1.0.xsd
    http://pear.php.net/dtd/package-2.0
    http://pear.php.net/dtd/package-2.0.xsd',
                             )), $this->_packageInfo);
        }
        if (!isset($this->_packageInfo['name'])) {
            return $this->_packageInfo = array_merge(array('name' => $package),
                $this->_packageInfo);
        }
        $this->_packageInfo['name'] = $package;
    }

    /**
     * set this as a package.xml version 2.1
     * @access private
     */
    function _setPackageVersion2_1()
    {
        $info = array(
                                 'version' => '2.1',
                                 'xmlns' => 'http://pear.php.net/dtd/package-2.1',
                                 'xmlns:tasks' => 'http://pear.php.net/dtd/tasks-1.0',
                                 'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                                 'xsi:schemaLocation' => 'http://pear.php.net/dtd/tasks-1.0
    http://pear.php.net/dtd/tasks-1.0.xsd
    http://pear.php.net/dtd/package-2.1
    http://pear.php.net/dtd/package-2.1.xsd',
                             );
        if (!isset($this->_packageInfo['attribs'])) {
            $this->_packageInfo = array_merge(array('attribs' => $info), $this->_packageInfo);
        } else {
            $this->_packageInfo['attribs'] = $info;
        }
    }

    function setUri($uri)
    {
        unset($this->_packageInfo['channel']);
        $this->_isValid = 0;
        if (!isset($this->_packageInfo['uri'])) {
            // ensure that the uri tag is set up in the right location
            $this->_packageInfo = $this->_insertBefore($this->_packageInfo,
                array('extends', 'summary', 'description', 'lead',
                'developer', 'contributor', 'helper', 'date', 'time', 'version',
                'stability', 'license', 'notes', 'contents', 'compatible',
                'dependencies', 'providesextension', 'usesrole', 'usestask', 'srcpackage', 'srcuri',
                'phprelease', 'extsrcrelease', 'zendextsrcrelease', 'zendextbinrelease',
                'extbinrelease', 'bundle', 'changelog'), $uri, 'uri');
        }
        $this->_packageInfo['uri'] = $uri;
    }

    function setChannel($channel)
    {
        unset($this->_packageInfo['uri']);
        $this->_isValid = 0;
        if (!isset($this->_packageInfo['channel'])) {
            // ensure that the channel tag is set up in the right location
            $this->_packageInfo = $this->_insertBefore($this->_packageInfo,
                array('extends', 'summary', 'description', 'lead',
                'developer', 'contributor', 'helper', 'date', 'time', 'version',
                'stability', 'license', 'notes', 'contents', 'compatible',
                'dependencies', 'providesextension', 'usesrole', 'usestask', 'srcpackage', 'srcuri',
                'phprelease', 'extsrcrelease', 'zendextsrcrelease', 'zendextbinrelease',
                'extbinrelease', 'bundle', 'changelog'), $channel, 'channel');
        }
        $this->_packageInfo['channel'] = $channel;
    }

    function setExtends($extends)
    {
        $this->_isValid = 0;
        if (!isset($this->_packageInfo['extends'])) {
            // ensure that the extends tag is set up in the right location
            $this->_packageInfo = $this->_insertBefore($this->_packageInfo,
                array('summary', 'description', 'lead',
                'developer', 'contributor', 'helper', 'date', 'time', 'version',
                'stability', 'license', 'notes', 'contents', 'compatible',
                'dependencies', 'providesextension', 'usesrole', 'usestask', 'srcpackage', 'srcuri',
                'phprelease', 'extsrcrelease', 'zendextsrcrelease', 'zendextbinrelease',
                'extbinrelease', 'bundle', 'changelog'), $extends, 'extends');
        }
        $this->_packageInfo['extends'] = $extends;
    }

    function setSummary($summary)
    {
        $this->_isValid = 0;
        if (!isset($this->_packageInfo['summary'])) {
            // ensure that the summary tag is set up in the right location
            $this->_packageInfo = $this->_insertBefore($this->_packageInfo,
                array('description', 'lead',
                'developer', 'contributor', 'helper', 'date', 'time', 'version',
                'stability', 'license', 'notes', 'contents', 'compatible',
                'dependencies', 'providesextension', 'usesrole', 'usestask', 'srcpackage', 'srcuri',
                'phprelease', 'extsrcrelease', 'zendextsrcrelease', 'zendextbinrelease',
                'extbinrelease', 'bundle', 'changelog'), $summary, 'summary');
        }
        $this->_packageInfo['summary'] = $summary;
    }

    function setDescription($desc)
    {
        $this->_isValid = 0;
        if (!isset($this->_packageInfo['description'])) {
            // ensure that the description tag is set up in the right location
            $this->_packageInfo = $this->_insertBefore($this->_packageInfo,
                array('lead',
                'developer', 'contributor', 'helper', 'date', 'time', 'version',
                'stability', 'license', 'notes', 'contents', 'compatible',
                'dependencies', 'providesextension', 'usesrole', 'usestask', 'srcpackage', 'srcuri',
                'phprelease', 'extsrcrelease', 'zendextsrcrelease', 'zendextbinrelease',
                'extbinrelease', 'bundle', 'changelog'), $desc, 'description');
        }
        $this->_packageInfo['description'] = $desc;
    }

    /**
     * Adds a new maintainer - no checking of duplicates is performed, use
     * updatemaintainer for that purpose.
     */
    function addMaintainer($role, $handle, $name, $email, $active = 'yes')
    {
        if (!in_array($role, array('lead', 'developer', 'contributor', 'helper'))) {
            return false;
        }
        if (isset($this->_packageInfo[$role])) {
            if (!isset($this->_packageInfo[$role][0])) {
                $this->_packageInfo[$role] = array($this->_packageInfo[$role]);
            }
            $this->_packageInfo[$role][] =
                array(
                    'name' => $name,
                    'user' => $handle,
                    'email' => $email,
                    'active' => $active,
                );
        } else {
            $testarr = array('lead',
                    'developer', 'contributor', 'helper', 'date', 'time', 'version',
                    'stability', 'license', 'notes', 'contents', 'compatible',
                    'dependencies', 'providesextension', 'usesrole', 'usestask',
                    'srcpackage', 'srcuri', 'phprelease', 'extsrcrelease',
                    'extbinrelease', 'zendextsrcrelease', 'zendextbinrelease', 'bundle', 'changelog');
            foreach (array('lead', 'developer', 'contributor', 'helper') as $testrole) {
                array_shift($testarr);
                if ($role == $testrole) {
                    break;
                }
            }
            if (!isset($this->_packageInfo[$role])) {
                // ensure that the extends tag is set up in the right location
                $this->_packageInfo = $this->_insertBefore($this->_packageInfo, $testarr,
                    array(), $role);
            }
            $this->_packageInfo[$role] =
                array(
                    'name' => $name,
                    'user' => $handle,
                    'email' => $email,
                    'active' => $active,
                );
        }
        $this->_isValid = 0;
    }

    function updateMaintainer($newrole, $handle, $name, $email, $active = 'yes')
    {
        $found = false;
        foreach (array('lead', 'developer', 'contributor', 'helper') as $role) {
            if (!isset($this->_packageInfo[$role])) {
                continue;
            }
            $info = $this->_packageInfo[$role];
            if (!isset($info[0])) {
                if ($info['user'] == $handle) {
                    $found = true;
                    break;
                }
            }
            foreach ($info as $i => $maintainer) {
                if ($maintainer['user'] == $handle) {
                    $found = $i;
                    break 2;
                }
            }
        }
        if ($found === false) {
            return $this->addMaintainer($newrole, $handle, $name, $email, $active);
        }
        if ($found !== false) {
            if ($found === true) {
                unset($this->_packageInfo[$role]);
            } else {
                unset($this->_packageInfo[$role][$found]);
                $this->_packageInfo[$role] = array_values($this->_packageInfo[$role]);
            }
        }
        $this->addMaintainer($newrole, $handle, $name, $email, $active);
        $this->_isValid = 0;
    }

    function deleteMaintainer($handle)
    {
        $found = false;
        foreach (array('lead', 'developer', 'contributor', 'helper') as $role) {
            if (!isset($this->_packageInfo[$role])) {
                continue;
            }
            if (!isset($this->_packageInfo[$role][0])) {
                $this->_packageInfo[$role] = array($this->_packageInfo[$role]);
            }
            foreach ($this->_packageInfo[$role] as $i => $maintainer) {
                if ($maintainer['user'] == $handle) {
                    $found = $i;
                    break;
                }
            }
            if ($found !== false) {
                unset($this->_packageInfo[$role][$found]);
                if (!count($this->_packageInfo[$role]) && $role == 'lead') {
                    $this->_isValid = 0;
                }
                if (!count($this->_packageInfo[$role])) {
                    unset($this->_packageInfo[$role]);
                    return true;
                }
                $this->_packageInfo[$role] =
                    array_values($this->_packageInfo[$role]);
                if (count($this->_packageInfo[$role]) == 1) {
                    $this->_packageInfo[$role] = $this->_packageInfo[$role][0];
                }
                return true;
            }
            if (count($this->_packageInfo[$role]) == 1) {
                $this->_packageInfo[$role] = $this->_packageInfo[$role][0];
            }
        }
        return false;
    }

    function setReleaseVersion($version)
    {
        if (isset($this->_packageInfo['version']) &&
              isset($this->_packageInfo['version']['release'])) {
            unset($this->_packageInfo['version']['release']);
        }
        $this->_packageInfo = $this->_mergeTag($this->_packageInfo, $version, array(
            'version' => array('stability', 'license', 'notes', 'contents', 'compatible',
                'dependencies', 'providesextension', 'usesrole', 'usestask', 'srcpackage', 'srcuri',
                'phprelease', 'extsrcrelease', 'zendextsrcrelease', 'zendextbinrelease',
                'extbinrelease', 'bundle', 'changelog'),
            'release' => array('api')));
        $this->_isValid = 0;
    }

    function setAPIVersion($version)
    {
        if (isset($this->_packageInfo['version']) &&
              isset($this->_packageInfo['version']['api'])) {
            unset($this->_packageInfo['version']['api']);
        }
        $this->_packageInfo = $this->_mergeTag($this->_packageInfo, $version, array(
            'version' => array('stability', 'license', 'notes', 'contents', 'compatible',
                'dependencies', 'providesextension', 'usesrole', 'usestask', 'srcpackage', 'srcuri',
                'phprelease', 'extsrcrelease', 'zendextsrcrelease', 'zendextbinrelease',
                'extbinrelease', 'bundle', 'changelog'),
            'api' => array()));
        $this->_isValid = 0;
    }

    /**
     * snapshot|devel|alpha|beta|stable
     */
    function setReleaseStability($state)
    {
        if (isset($this->_packageInfo['stability']) &&
              isset($this->_packageInfo['stability']['release'])) {
            unset($this->_packageInfo['stability']['release']);
        }
        $this->_packageInfo = $this->_mergeTag($this->_packageInfo, $state, array(
            'stability' => array('license', 'notes', 'contents', 'compatible',
                'dependencies', 'providesextension', 'usesrole', 'usestask', 'srcpackage', 'srcuri',
                'phprelease', 'extsrcrelease', 'zendextsrcrelease', 'zendextbinrelease',
                'extbinrelease', 'bundle', 'changelog'),
            'release' => array('api')));
        $this->_isValid = 0;
    }

    /**
     * @param devel|alpha|beta|stable
     */
    function setAPIStability($state)
    {
        if (isset($this->_packageInfo['stability']) &&
              isset($this->_packageInfo['stability']['api'])) {
            unset($this->_packageInfo['stability']['api']);
        }
        $this->_packageInfo = $this->_mergeTag($this->_packageInfo, $state, array(
            'stability' => array('license', 'notes', 'contents', 'compatible',
                'dependencies', 'providesextension', 'usesrole', 'usestask', 'srcpackage', 'srcuri',
                'phprelease', 'extsrcrelease', 'zendextsrcrelease', 'zendextbinrelease',
                'extbinrelease', 'bundle', 'changelog'),
            'api' => array()));
        $this->_isValid = 0;
    }

    function setLicense($license, $uri = false, $filesource = false)
    {
        if (!isset($this->_packageInfo['license'])) {
            // ensure that the license tag is set up in the right location
            $this->_packageInfo = $this->_insertBefore($this->_packageInfo,
                array('notes', 'contents', 'compatible',
                'dependencies', 'providesextension', 'usesrole', 'usestask', 'srcpackage', 'srcuri',
                'phprelease', 'extsrcrelease', 'zendextsrcrelease', 'zendextbinrelease',
                'extbinrelease', 'bundle', 'changelog'), 0, 'license');
        }
        if ($uri || $filesource) {
            $attribs = array();
            if ($uri) {
                $attribs['uri'] = $uri;
            }
            $uri = true; // for test below
            if ($filesource) {
                $attribs['filesource'] = $filesource;
            }
        }
        $license = $uri ? array('attribs' => $attribs, '_content' => $license) : $license;
        $this->_packageInfo['license'] = $license;
        $this->_isValid = 0;
    }

    function setNotes($notes)
    {
        $this->_isValid = 0;
        if (!isset($this->_packageInfo['notes'])) {
            // ensure that the notes tag is set up in the right location
            $this->_packageInfo = $this->_insertBefore($this->_packageInfo,
                array('contents', 'compatible',
                'dependencies', 'providesextension', 'usesrole', 'usestask', 'srcpackage', 'srcuri',
                'phprelease', 'extsrcrelease', 'zendextsrcrelease', 'zendextbinrelease',
                'extbinrelease', 'bundle', 'changelog'), $notes, 'notes');
        }
        $this->_packageInfo['notes'] = $notes;
    }

    /**
     * This is only used at install-time, after all serialization
     * is over.
     * @param string file name
     * @param string installed path
     */
    function setInstalledAs($file, $path)
    {
        if ($path) {
            return $this->_packageInfo['filelist'][$file]['installed_as'] = $path;
        }
        unset($this->_packageInfo['filelist'][$file]['installed_as']);
    }

    /**
     * This is only used at install-time, after all serialization
     * is over.
     */
    function installedFile($file, $atts)
    {
        if (isset($this->_packageInfo['filelist'][$file])) {
            $this->_packageInfo['filelist'][$file] =
                array_merge($this->_packageInfo['filelist'][$file], $atts['attribs']);
        } else {
            $this->_packageInfo['filelist'][$file] = $atts['attribs'];
        }
    }

    /**
     * Reset the listing of package contents
     * @param string base installation dir for the whole package, if any
     */
    function clearContents($baseinstall = false)
    {
        $this->_filesValid = false;
        $this->_isValid = 0;
        if (!isset($this->_packageInfo['contents'])) {
            $this->_packageInfo = $this->_insertBefore($this->_packageInfo,
                array('compatible',
                    'dependencies', 'providesextension', 'usesrole', 'usestask',
                    'srcpackage', 'srcuri', 'phprelease', 'extsrcrelease',
                    'extbinrelease', 'zendextsrcrelease', 'zendextbinrelease',
                    'bundle', 'changelog'), array(), 'contents');
        }
        if ($this->getPackageType() != 'bundle') {
            $this->_packageInfo['contents'] =
                array('dir' => array('attribs' => array('name' => '/')));
            if ($baseinstall) {
                $this->_packageInfo['contents']['dir']['attribs']['baseinstalldir'] = $baseinstall;
            }
        } else {
            $this->_packageInfo['contents'] = array('bundledpackage' => array());
        }
    }

    /**
     * @param string relative path of the bundled package.
     */
    function addBundledPackage($path)
    {
        if ($this->getPackageType() != 'bundle') {
            return false;
        }
        $this->_filesValid = false;
        $this->_isValid = 0;
        $this->_packageInfo = $this->_mergeTag($this->_packageInfo, $path, array(
                'contents' => array('compatible', 'dependencies', 'providesextension',
                'usesrole', 'usestask', 'srcpackage', 'srcuri', 'phprelease',
                'extsrcrelease', 'extbinrelease', 'zendextsrcrelease', 'zendextbinrelease',
                'bundle', 'changelog'),
                'bundledpackage' => array()));
    }

    /**
     * @param string file name
     * @param PEAR_Task_Common a read/write task
     */
    function addTaskToFile($filename, $task)
    {
        if (!method_exists($task, 'getXml')) {
            return false;
        }
        if (!method_exists($task, 'getName')) {
            return false;
        }
        if (!method_exists($task, 'validate')) {
            return false;
        }
        if (!$task->validate()) {
            return false;
        }
        if (!isset($this->_packageInfo['contents']['dir']['file'])) {
            return false;
        }
        $this->getTasksNs(); // discover the tasks namespace if not done already
        $files = $this->_packageInfo['contents']['dir']['file'];
        if (!isset($files[0])) {
            $files = array($files);
            $ind = false;
        } else {
            $ind = true;
        }
        foreach ($files as $i => $file) {
            if (isset($file['attribs'])) {
                if ($file['attribs']['name'] == $filename) {
                    if ($ind) {
                        $t = isset($this->_packageInfo['contents']['dir']['file'][$i]
                              ['attribs'][$this->_tasksNs .
                              ':' . $task->getName()]) ?
                              $this->_packageInfo['contents']['dir']['file'][$i]
                              ['attribs'][$this->_tasksNs .
                              ':' . $task->getName()] : false;
                        if ($t && !isset($t[0])) {
                            $this->_packageInfo['contents']['dir']['file'][$i]
                                [$this->_tasksNs . ':' . $task->getName()] = array($t);
                        }
                        $this->_packageInfo['contents']['dir']['file'][$i][$this->_tasksNs .
                            ':' . $task->getName()][] = $task->getXml();
                    } else {
                        $t = isset($this->_packageInfo['contents']['dir']['file']
                              ['attribs'][$this->_tasksNs .
                              ':' . $task->getName()]) ? $this->_packageInfo['contents']['dir']['file']
                              ['attribs'][$this->_tasksNs .
                              ':' . $task->getName()] : false;
                        if ($t && !isset($t[0])) {
                            $this->_packageInfo['contents']['dir']['file']
                                [$this->_tasksNs . ':' . $task->getName()] = array($t);
                        }
                        $this->_packageInfo['contents']['dir']['file'][$this->_tasksNs .
                            ':' . $task->getName()][] = $task->getXml();
                    }
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param string path to the file
     * @param string filename
     * @param array extra attributes
     */
    function addFile($dir, $file, $attrs)
    {
        if ($this->getPackageType() == 'bundle') {
            return false;
        }
        $this->_filesValid = false;
        $this->_isValid = 0;
        $dir = preg_replace(array('!\\\\+!', '!/+!'), array('/', '/'), $dir);
        if ($dir == '/' || $dir == '') {
            $dir = '';
        } else {
            $dir .= '/';
        }
        $attrs['name'] = $dir . $file;
        if (!isset($this->_packageInfo['contents'])) {
            // ensure that the contents tag is set up
            $this->_packageInfo = $this->_insertBefore($this->_packageInfo,
                array('compatible', 'dependencies', 'providesextension', 'usesrole', 'usestask',
                'srcpackage', 'srcuri', 'phprelease', 'extsrcrelease',
                'extbinrelease', 'zendextsrcrelease', 'zendextbinrelease',
                'bundle', 'changelog'), array(), 'contents');
        }
        if (isset($this->_packageInfo['contents']['dir']['file'])) {
            if (!isset($this->_packageInfo['contents']['dir']['file'][0])) {
                $this->_packageInfo['contents']['dir']['file'] =
                    array($this->_packageInfo['contents']['dir']['file']);
            }
            $this->_packageInfo['contents']['dir']['file'][]['attribs'] = $attrs;
        } else {
            $this->_packageInfo['contents']['dir']['file']['attribs'] = $attrs;
        }
    }

    /**
     * @param string Dependent package name
     * @param string Dependent package's channel name
     * @param string minimum version of specified package that this release is guaranteed to be
     *               compatible with
     * @param string maximum version of specified package that this release is guaranteed to be
     *               compatible with
     * @param string versions of specified package that this release is not compatible with
     */
    function addCompatiblePackage($name, $channel, $min, $max, $exclude = false)
    {
        $this->_isValid = 0;
        $set = array(
            'name' => $name,
            'channel' => $channel,
            'min' => $min,
            'max' => $max,
        );
        if ($exclude) {
            $set['exclude'] = $exclude;
        }
        $this->_isValid = 0;
        $this->_packageInfo = $this->_mergeTag($this->_packageInfo, $set, array(
                'compatible' => array('dependencies', 'providesextension', 'usesrole', 'usestask',
                    'srcpackage', 'srcuri', 'phprelease', 'extsrcrelease', 'extbinrelease',
                    'zendextsrcrelease', 'zendextbinrelease', 'bundle', 'changelog')
            ));
    }

    /**
     * Removes the <usesrole> tag entirely
     */
    function resetUsesrole()
    {
        if (isset($this->_packageInfo['usesrole'])) {
            unset($this->_packageInfo['usesrole']);
        }
    }

    /**
     * @param string
     * @param string package name or uri
     * @param string channel name if non-uri
     */
    function addUsesrole($role, $packageOrUri, $channel = false) {
        $set = array('role' => $role);
        if ($channel) {
            $set['package'] = $packageOrUri;
            $set['channel'] = $channel;
        } else {
            $set['uri'] = $packageOrUri;
        }
        $this->_isValid = 0;
        $this->_packageInfo = $this->_mergeTag($this->_packageInfo, $set, array(
                'usesrole' => array('usestask', 'srcpackage', 'srcuri',
                    'phprelease', 'extsrcrelease', 'extbinrelease',
                    'zendextsrcrelease', 'zendextbinrelease', 'bundle', 'changelog')
            ));
    }

    /**
     * Removes the <usestask> tag entirely
     */
    function resetUsestask()
    {
        if (isset($this->_packageInfo['usestask'])) {
            unset($this->_packageInfo['usestask']);
        }
    }


    /**
     * @param string
     * @param string package name or uri
     * @param string channel name if non-uri
     */
    function addUsestask($task, $packageOrUri, $channel = false) {
        $set = array('task' => $task);
        if ($channel) {
            $set['package'] = $packageOrUri;
            $set['channel'] = $channel;
        } else {
            $set['uri'] = $packageOrUri;
        }
        $this->_isValid = 0;
        $this->_packageInfo = $this->_mergeTag($this->_packageInfo, $set, array(
                'usestask' => array('srcpackage', 'srcuri',
                    'phprelease', 'extsrcrelease', 'extbinrelease',
                    'zendextsrcrelease', 'zendextbinrelease', 'bundle', 'changelog')
            ));
    }

    /**
     * Remove all compatible tags
     */
    function clearCompatible()
    {
        unset($this->_packageInfo['compatible']);
    }

    /**
     * Reset dependencies prior to adding new ones
     */
    function clearDeps()
    {
        if (!isset($this->_packageInfo['dependencies'])) {
            $this->_packageInfo = $this->_mergeTag($this->_packageInfo, array(),
                array(
                    'dependencies' => array('providesextension', 'usesrole', 'usestask',
                        'srcpackage', 'srcuri', 'phprelease', 'extsrcrelease', 'extbinrelease',
                        'zendextsrcrelease', 'zendextbinrelease', 'bundle', 'changelog')));
        }
        $this->_packageInfo['dependencies'] = array();
    }

    /**
     * @param string minimum PHP version allowed
     * @param string maximum PHP version allowed
     * @param array $exclude incompatible PHP versions
     */
    function setPhpDep($min, $max = false, $exclude = false)
    {
        $this->_isValid = 0;
        $dep =
            array(
                'min' => $min,
            );
        if ($max) {
            $dep['max'] = $max;
        }
        if ($exclude) {
            if (count($exclude) == 1) {
                $exclude = $exclude[0];
            }
            $dep['exclude'] = $exclude;
        }
        if (isset($this->_packageInfo['dependencies']['required']['php'])) {
            $this->_stack->push(__FUNCTION__, 'warning', array('dep' =>
            $this->_packageInfo['dependencies']['required']['php']),
                'warning: PHP dependency already exists, overwriting');
            unset($this->_packageInfo['dependencies']['required']['php']);
        }
        $this->_packageInfo = $this->_mergeTag($this->_packageInfo, $dep,
            array(
                'dependencies' => array('providesextension', 'usesrole', 'usestask',
                    'srcpackage', 'srcuri', 'phprelease', 'extsrcrelease', 'extbinrelease',
                    'zendextsrcrelease', 'zendextbinrelease', 'bundle', 'changelog'),
                'required' => array('optional', 'group'),
                'php' => array('pearinstaller', 'package', 'subpackage', 'extension', 'os', 'arch')
            ));
        return true;
    }

    /**
     * @param string minimum allowed PEAR installer version
     * @param string maximum allowed PEAR installer version
     * @param string recommended PEAR installer version
     * @param array incompatible version of the PEAR installer
     */
    function setPearinstallerDep($min, $max = false, $recommended = false, $exclude = false)
    {
        $this->_isValid = 0;
        $dep =
            array(
                'min' => $min,
            );
        if ($max) {
            $dep['max'] = $max;
        }
        if ($recommended) {
            $dep['recommended'] = $recommended;
        }
        if ($exclude) {
            if (count($exclude) == 1) {
                $exclude = $exclude[0];
            }
            $dep['exclude'] = $exclude;
        }
        if (isset($this->_packageInfo['dependencies']['required']['pearinstaller'])) {
            $this->_stack->push(__FUNCTION__, 'warning', array('dep' =>
            $this->_packageInfo['dependencies']['required']['pearinstaller']),
                'warning: PEAR Installer dependency already exists, overwriting');
            unset($this->_packageInfo['dependencies']['required']['pearinstaller']);
        }
        $this->_packageInfo = $this->_mergeTag($this->_packageInfo, $dep,
            array(
                'dependencies' => array('providesextension', 'usesrole', 'usestask',
                    'srcpackage', 'srcuri', 'phprelease', 'extsrcrelease', 'extbinrelease',
                    'zendextsrcrelease', 'zendextbinrelease', 'bundle', 'changelog'),
                'required' => array('optional', 'group'),
                'pearinstaller' => array('package', 'subpackage', 'extension', 'os', 'arch')
            ));
    }

    /**
     * Mark a package as conflicting with this package
     * @param string package name
     * @param string package channel
     * @param string extension this package provides, if any
     * @param string|false minimum version required
     * @param string|false maximum version allowed
     * @param array|false versions to exclude from installation
     */
    function addConflictingPackageDepWithChannel($name, $channel,
                $providesextension = false, $min = false, $max = false, $exclude = false)
    {
        $this->_isValid = 0;
        $dep = $this->_constructDep($name, $channel, false, $min, $max, false,
            $exclude, $providesextension, false, true);
        $this->_packageInfo = $this->_mergeTag($this->_packageInfo, $dep,
            array(
                'dependencies' => array('providesextension', 'usesrole', 'usestask',
                    'srcpackage', 'srcuri', 'phprelease', 'extsrcrelease', 'extbinrelease',
                    'zendextsrcrelease', 'zendextbinrelease', 'bundle'