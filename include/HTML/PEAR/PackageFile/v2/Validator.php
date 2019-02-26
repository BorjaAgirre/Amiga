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
 * Private validation class used by PEAR_PackageFile_v2 - do not use directly, its
 * sole purpose is to split up the PEAR/PackageFile/v2.php file to make it smaller
 * @category   pear
 * @package    PEAR
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  1997-2009 The Authors
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @version    Release: 1.9.5
 * @link       http://pear.php.net/package/PEAR
 * @since      Class available since Release 1.4.0a8
 * @access private
 */
class PEAR_PackageFile_v2_Validator
{
    /**
     * @var array
     */
    var $_packageInfo;
    /**
     * @var PEAR_PackageFile_v2
     */
    var $_pf;
    /**
     * @var PEAR_ErrorStack
     */
    var $_stack;
    /**
     * @var int
     */
    var $_isValid = 0;
    /**
     * @var int
     */
    var $_filesValid = 0;
    /**
     * @var int
     */
    var $_curState = 0;
    /**
     * @param PEAR_PackageFile_v2
     * @param int
     */
    function validate(&$pf, $state = PEAR_VALIDATE_NORMAL)
    {
        $this->_pf = &$pf;
        $this->_curState = $state;
        $this->_packageInfo = $this->_pf->getArray();
        $this->_isValid = $this->_pf->_isValid;
        $this->_filesValid = $this->_pf->_filesValid;
        $this->_stack = &$pf->_stack;
        $this->_stack->getErrors(true);
        if (($this->_isValid & $state) == $state) {
            return true;
        }
        if (!isset($this->_packageInfo) || !is_array($this->_packageInfo)) {
            return false;
        }
        if (!isset($this->_packageInfo['attribs']['version']) ||
              ($this->_packageInfo['attribs']['version'] != '2.0' &&
               $this->_packageInfo['attribs']['version'] != '2.1')
        ) {
            $this->_noPackageVersion();
        }
        $structure =
        array(
            'name',
            'channel|uri',
            '*extends', // can't be multiple, but this works fine
            'summary',
            'description',
            '+lead', // these all need content checks
            '*developer',
            '*contributor',
            '*helper',
            'date',
            '*time',
            'version',
            'stability',
            'license->?uri->?filesource',
            'notes',
            'contents', //special validation needed
            '*compatible',
            'dependencies', //special validation needed
            '*usesrole',
            '*usestask', // reserve these for 1.4.0a1 to implement
                         // this will allow a package.xml to gracefully say it
                         // needs a certain package installed in order to implement a role or task
            '*providesextension',
            '*srcpackage|*srcuri',
            '+phprelease|+extsrcrelease|+extbinrelease|' .
                '+zendextsrcrelease|+zendextbinrelease|bundle', //special validation needed
            '*changelog',
        );
        $test = $this->_packageInfo;
        if (isset($test['dependencies']) &&
              isset($test['dependencies']['required']) &&
              isset($test['dependencies']['required']['pearinstaller']) &&
              isset($test['dependencies']['required']['pearinstaller']['min']) &&
              version_compare('1.9.5',
                $test['dependencies']['required']['pearinstaller']['min'], '<')
        ) {
            $this->_pearVersionTooLow($test['dependencies']['required']['pearinstaller']['min']);
            return false;
        }
        // ignore post-installation array fields
        if (array_key_exists('filelist', $test)) {
            unset($test['filelist']);
        }
        if (array_key_exists('_lastmodified', $test)) {
            unset($test['_lastmodified']);
        }
        if (array_key_exists('#binarypackage', $test)) {
            unset($test['#binarypackage']);
        }
        if (array_key_exists('old', $test)) {
            unset($test['old']);
        }
        if (array_key_exists('_lastversion', $test)) {
            unset($test['_lastversion']);
        }
        if (!$this->_stupidSchemaValidate($structure, $test, '<package>')) {
            return false;
        }
        if (empty($this->_packageInfo['name'])) {
            $this->_tagCannotBeEmpty('name');
        }
        $test = isset($this->_packageInfo['uri']) ? 'uri' :'channel';
        if (empty($this->_packageInfo[$test])) {
            $this->_tagCannotBeEmpty($test);
        }
        if (is_array($this->_packageInfo['license']) &&
              (!isset($this->_packageInfo['license']['_content']) ||
              empty($this->_packageInfo['license']['_content']))) {
            $this->_tagCannotBeEmpty('license');
        } elseif (empty($this->_packageInfo['license'])) {
            $this->_tagCannotBeEmpty('license');
        }
        if (empty($this->_packageInfo['summary'])) {
            $this->_tagCannotBeEmpty('summary');
        }
        if (empty($this->_packageInfo['description'])) {
            $this->_tagCannotBeEmpty('description');
        }
        if (empty($this->_packageInfo['date'])) {
            $this->_tagCannotBeEmpty('date');
        }
        if (empty($this->_packageInfo['notes'])) {
            $this->_tagCannotBeEmpty('notes');
        }
        if (isset($this->_packageInfo['time']) && empty($this->_packageInfo['time'])) {
            $this->_tagCannotBeEmpty('time');
        }
        if (isset($this->_packageInfo['dependencies'])) {
            $this->_validateDependencies();
        }
        if (isset($this->_packageInfo['compatible'])) {
            $this->_validateCompatible();
        }
        if (!isset($this->_packageInfo['bundle'])) {
            if (empty($this->_packageInfo['contents'])) {
                $this->_tagCannotBeEmpty('contents');
            }
            if (!isset($this->_packageInfo['contents']['dir'])) {
                $this->_filelistMustContainDir('contents');
                return false;
            }
            if (isset($this->_packageInfo['contents']['file'])) {
                $this->_filelistCannotContainFile('contents');
                return false;
            }
        }
        $this->_validateMaintainers();
        $this->_validateStabilityVersion();
        $fail = false;
        if (array_key_exists('usesrole', $this->_packageInfo)) {
            $roles = $this->_packageInfo['usesrole'];
            if (!is_array($roles) || !isset($roles[0])) {
                $roles = array($roles);
            }
            foreach ($roles as $role) {
                if (!isset($role['role'])) {
                    $this->_usesroletaskMustHaveRoleTask('usesrole', 'role');
                    $fail = true;
                } else {
                    if (!isset($role['channel'])) {
                        if (!isset($role['uri'])) {
                            $this->_usesroletaskMustHaveChannelOrUri($role['role'], 'usesrole');
                            $fail = true;
                        }
                    } elseif (!isset($role['package'])) {
                        $this->_usesroletaskMustHavePackage($role['role'], 'usesrole');
                        $fail = true;
                    }
                }
            }
        }
        if (array_key_exists('usestask', $this->_packageInfo)) {
            $roles = $this->_packageInfo['usestask'];
            if (!is_array($roles) || !isset($roles[0])) {
                $roles = array($roles);
            }
            foreach ($roles as $role) {
                if (!isset($role['task'])) {
                    $this->_usesroletaskMustHaveRoleTask('usestask', 'task');
                    $fail = true;
                } else {
                    if (!isset($role['channel'])) {
                        if (!isset($role['uri'])) {
                            $this->_usesroletaskMustHaveChannelOrUri($role['task'], 'usestask');
                            $fail = true;
                        }
                    } elseif (!isset($role['package'])) {
                        $this->_usesroletaskMustHavePackage($role['task'], 'usestask');
                        $fail = true;
                    }
                }
            }
        }

        if ($fail) {
            return false;
        }

        $list = $this->_packageInfo['contents'];
        if (isset($list['dir']) && is_array($list['dir']) && isset($list['dir'][0])) {
            $this->_multipleToplevelDirNotAllowed();
            return $this->_isValid = 0;
        }

        $this->_validateFilelist();
        $this->_validateRelease();
        if (!$this->_stack->hasErrors()) {
            $chan = $this->_pf->_registry->getChannel($this->_pf->getChannel(), true);
            if (PEAR::isError($chan)) {
                $this->_unknownChannel($this->_pf->getChannel());
            } else {
                $valpack = $chan->getValidationPackage();
                // for channel validator packages, always use the default PEAR validator.
                // otherwise, they can't be installed or packaged
                $validator = $chan->getValidationObject($this->_pf->getPackage());
                if (!$validator) {
                    $this->_stack->push(__FUNCTION__, 'error',
                        array('channel' => $chan->getName(),
                              'package' => $this->_pf->getPackage(),
                              'name'    => $valpack['_content'],
                              'version' => $valpack['attribs']['version']),
                        'package "%channel%/%package%" cannot be properly validated without ' .
                        'validation package "%channel%/%name%-%version%"');
                    return $this->_isValid = 0;
                }
                $validator->setPackageFile($this->_pf);
                $validator->validate($state);
                $failures = $validator->getFailures();
                foreach ($failures['errors'] as $error) {
                    $this->_stack->push(__FUNCTION__, 'error', $error,
                        'Channel validator error: field "%field%" - %reason%');
                }
                foreach ($failures['warnings'] as $warning) {
                    $this->_stack->push(__FUNCTION__, 'warning', $warning,
                        'Channel validator warning: field "%field%" - %reason%');
                }
            }
        }

        $this->_pf->_isValid = $this->_isValid = !$this->_stack->hasErrors('error');
        if ($this->_isValid && $state == PEAR_VALIDATE_PACKAGING && !$this->_filesValid) {
            if ($this->_pf->getPackageType() == 'bundle') {
                if ($this->_analyzeBundledPackages()) {
                    $this->_filesValid = $this->_pf->_filesValid = true;
                } else {
                    $this->_pf->_isValid = $this->_isValid = 0;
                }
            } else {
                if (!$this->_analyzePhpFiles()) {
                    $this->_pf->_isValid = $this->_isValid = 0;
                } else {
                    $this->_filesValid = $this->_pf->_filesValid = true;
                }
            }
        }

        if ($this->_isValid) {
            return $this->_pf->_isValid = $this->_isValid = $state;
        }

        return $this->_pf->_isValid = $this->_isValid = 0;
    }

    function _stupidSchemaValidate($structure, $xml, $root)
    {
        if (!is_array($xml)) {
            $xml = array();
        }
        $keys = array_keys($xml);
        reset($keys);
        $key = current($keys);
        while ($key == 'attribs' || $key == '_contents') {
            $key = next($keys);
        }
        $unfoundtags = $optionaltags = array();
        $ret = true;
        $mismatch = false;
        foreach ($structure as $struc) {
            if ($key) {
                $tag = $xml[$key];
            }
            $test = $this->_processStructure($struc);
            if (isset($test['choices'])) {
                $loose = true;
                foreach ($test['choices'] as $choice) {
                    if ($key == $choice['tag']) {
                        $key = next($keys);
                        while ($key == 'attribs' || $key == '_contents') {
                            $key = next($keys);
                        }
                        $unfoundtags = $optionaltags = array();
                        $mismatch = false;
                        if ($key && $key != $choice['tag'] && isset($choice['multiple'])) {
                            $unfoundtags[] = $choice['tag'];
                            $optionaltags[] = $choice['tag'];
                            if ($key) {
                                $mismatch = true;
                            }
                        }
                        $ret &= $this->_processAttribs($choice, $tag, $root);
                        continue 2;
                    } else {
                        $unfoundtags[] = $choice['tag'];
                        $mismatch = true;
                    }
                    if (!isset($choice['multiple']) || $choice['multiple'] != '*') {
                        $loose = false;
                    } else {
                        $optionaltags[] = $choice['tag'];
                    }
                }
                if (!$loose) {
                    $this->_invalidTagOrder($unfoundtags, $key, $root);
                    return false;
                }
            } else {
                if ($key != $test['tag']) {
                    if (isset($test['multiple']) && $test['multiple'] != '*') {
                        $unfoundtags[] = $test['tag'];
                        $this->_invalidTagOrder($unfoundtags, $key, $root);
                        return false;
                    } else {
                        if ($key) {
                            $mismatch = true;
                        }
                        $unfoundtags[] = $test['tag'];
                        $optionaltags[] = $test['tag'];
                    }
                    if (!isset($test['multiple'])) {
                        $this->_invalidTagOrder($unfoundtags, $key, $root);
                        return false;
                    }
                    continue;
                } else {
                    $unfoundtags = $optionaltags = array();
                    $mismatch = false;
                }
                $key = next($keys);
                while ($key == 'attribs' || $key == '_contents') {
                    $key = next($keys);
                }
                if ($key && $key != $test['tag'] && isset($test['multiple'])) {
                    $unfoundtags[] = $test['tag'];
                    $optionaltags[] = $test['tag'];
                    $mismatch = true;
                }
                $ret &= $this->_processAttribs($test, $tag, $root);
                continue;
            }
        }
        if (!$mismatch && count($optionaltags)) {
            // don't error out on any optional tags
            $unfoundtags = array_diff($unfoundtags, $optionaltags);
        }
        if (count($unfoundtags)) {
            $this->_invalidTagOrder($unfoundtags, $key, $root);
        } elseif ($key) {
            // unknown tags
            $this->_invalidTagOrder('*no tags allowed here*', $key, $root);
            while ($key = next($keys)) {
                $this->_invalidTagOrder('*no tags allowed here*', $key, $root);
            }
        }
        return $ret;
    }

    function _processAttribs($choice, $tag, $context)
    {
        if (isset($choice['attribs'])) {
            if (!is_array($tag)) {
                $tag = array($tag);
            }
            $tags = $tag;
            if (!isset($tags[0])) {
                $tags = array($tags);
            }
            $ret = true;
            foreach ($tags as $i => $tag) {
                if (!is_array($tag) || !isset($tag['attribs'])) {
                    foreach ($choice['attribs'] as $attrib) {
                        if ($attrib{0} != '?') {
                            $ret &= $this->_tagHasNoAttribs($choice['tag'],
                                $context);
                            continue 2;
                        }
                    }
                }
                foreach ($choice['attribs'] as $attrib) {
                    if ($attrib{0} != '?') {
                        if (!isset($tag['attribs'][$attrib])) {
                            $ret &= $this->_tagMissingAttribute($choice['tag'],
                                $attrib, $context);
                        }
                    }
                }
            }
            return $ret;
        }
        return true;
    }

    function _processStructure($key)
    {
        $ret = array();
        if (count($pieces = explode('|', $key)) > 1) {
            $ret['choices'] = array();
            foreach ($pieces as $piece) {
                $ret['choices'][] = $this->_processStructure($piece);
            }
            return $ret;
        }
        $multi = $key{0};
        if ($multi == '+' || $multi == '*') {
            $ret['multiple'] = $key{0};
            $key = substr($key, 1);
        }
        if (count($attrs = explode('->', $key)) > 1) {
            $ret['tag'] = array_shift($attrs);
            $ret['attribs'] = $attrs;
        } else {
            $ret['tag'] = $key;
        }
        return $ret;
    }

    function _validateStabilityVersion()
    {
        $structure = array('release', 'api');
        $a = $this->_stupidSchemaValidate($structure, $this->_packageInfo['version'], '<version>');
        $a &= $this->_stupidSchemaValidate($structure, $this->_packageInfo['stability'], '<stability>');
        if ($a) {
            if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                  $this->_packageInfo['version']['release'])) {
                $this->_invalidVersion('release', $this->_packageInfo['version']['release']);
            }
            if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                  $this->_packageInfo['version']['api'])) {
                $this->_invalidVersion('api', $this->_packageInfo['version']['api']);
            }
            if (!in_array($this->_packageInfo['stability']['release'],
                  array('snapshot', 'devel', 'alpha', 'beta', 'stable'))) {
                $this->_invalidState('release', $this->_packageInfo['stability']['release']);
            }
            if (!in_array($this->_packageInfo['stability']['api'],
                  array('devel', 'alpha', 'beta', 'stable'))) {
                $this->_invalidState('api', $this->_packageInfo['stability']['api']);
            }
        }
    }

    function _validateMaintainers()
    {
        $structure =
            array(
                'name',
                'user',
                'email',
                'active',
            );
        foreach (array('lead', 'developer', 'contributor', 'helper') as $type) {
            if (!isset($this->_packageInfo[$type])) {
                continue;
            }
            if (isset($this->_packageInfo[$type][0])) {
                foreach ($this->_packageInfo[$type] as $lead) {
                    $this->_stupidSchemaValidate($structure, $lead, '<' . $type . '>');
                }
            } else {
                $this->_stupidSchemaValidate($structure, $this->_packageInfo[$type],
                    '<' . $type . '>');
            }
        }
    }

    function _validatePhpDep($dep, $installcondition = false)
    {
        $structure = array(
            'min',
            '*max',
            '*exclude',
        );
        $type = $installcondition ? '<installcondition><php>' : '<dependencies><required><php>';
        $this->_stupidSchemaValidate($structure, $dep, $type);
        if (isset($dep['min'])) {
            if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?(?:-[a-zA-Z0-9]+)?\\z/',
                  $dep['min'])) {
                $this->_invalidVersion($type . '<min>', $dep['min']);
            }
        }
        if (isset($dep['max'])) {
            if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?(?:-[a-zA-Z0-9]+)?\\z/',
                  $dep['max'])) {
                $this->_invalidVersion($type . '<max>', $dep['max']);
            }
        }
        if (isset($dep['exclude'])) {
            if (!is_array($dep['exclude'])) {
                $dep['exclude'] = array($dep['exclude']);
            }
            foreach ($dep['exclude'] as $exclude) {
                if (!preg_match(
                     '/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?(?:-[a-zA-Z0-9]+)?\\z/',
                     $exclude)) {
                    $this->_invalidVersion($type . '<exclude>', $exclude);
                }
            }
        }
    }

    function _validatePearinstallerDep($dep)
    {
        $structure = array(
            'min',
            '*max',
            '*recommended',
            '*exclude',
        );
        $this->_stupidSchemaValidate($structure, $dep, '<dependencies><required><pearinstaller>');
        if (isset($dep['min'])) {
            if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                  $dep['min'])) {
                $this->_invalidVersion('<dependencies><required><pearinstaller><min>',
                    $dep['min']);
            }
        }
        if (isset($dep['max'])) {
            if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                  $dep['max'])) {
                $this->_invalidVersion('<dependencies><required><pearinstaller><max>',
                    $dep['max']);
            }
        }
        if (isset($dep['recommended'])) {
            if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                  $dep['recommended'])) {
                $this->_invalidVersion('<dependencies><required><pearinstaller><recommended>',
                    $dep['recommended']);
            }
        }
        if (isset($dep['exclude'])) {
            if (!is_array($dep['exclude'])) {
                $dep['exclude'] = array($dep['exclude']);
            }
            foreach ($dep['exclude'] as $exclude) {
                if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                      $exclude)) {
                    $this->_invalidVersion('<dependencies><required><pearinstaller><exclude>',
                        $exclude);
                }
            }
        }
    }

    function _validatePackageDep($dep, $group, $type = '<package>')
    {
        if (isset($dep['uri'])) {
            if (isset($dep['conflicts'])) {
                $structure = array(
                    'name',
                    'uri',
                    'conflicts',
                    '*providesextension',
                );
            } else {
                $structure = array(
                    'name',
                    'uri',
                    '*providesextension',
                );
            }
        } else {
            if (isset($dep['conflicts'])) {
                $structure = array(
                    'name',
                    'channel',
                    '*min',
                    '*max',
                    '*exclude',
                    'conflicts',
                    '*providesextension',
                );
            } else {
                $structure = array(
                    'name',
                    'channel',
                    '*min',
                    '*max',
                    '*recommended',
                    '*exclude',
                    '*nodefault',
                    '*providesextension',
                );
            }
        }
        if (isset($dep['name'])) {
            $type .= '<name>' . $dep['name'] . '</name>';
        }
        $this->_stupidSchemaValidate($structure, $dep, '<dependencies>' . $group . $type);
        if (isset($dep['uri']) && (isset($dep['min']) || isset($dep['max']) ||
              isset($dep['recommended']) || isset($dep['exclude']))) {
            $this->_uriDepsCannotHaveVersioning('<dependencies>' . $group . $type);
        }
        if (isset($dep['channel']) && strtolower($dep['channel']) == '__uri') {
            $this->_DepchannelCannotBeUri('<dependencies>' . $group . $type);
        }
        if (isset($dep['min'])) {
            if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                  $dep['min'])) {
                $this->_invalidVersion('<dependencies>' . $group . $type . '<min>', $dep['min']);
            }
        }
        if (isset($dep['max'])) {
            if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                  $dep['max'])) {
                $this->_invalidVersion('<dependencies>' . $group . $type . '<max>', $dep['max']);
            }
        }
        if (isset($dep['recommended'])) {
            if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                  $dep['recommended'])) {
                $this->_invalidVersion('<dependencies>' . $group . $type . '<recommended>',
                    $dep['recommended']);
            }
        }
        if (isset($dep['exclude'])) {
            if (!is_array($dep['exclude'])) {
                $dep['exclude'] = array($dep['exclude']);
            }
            foreach ($dep['exclude'] as $exclude) {
                if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                      $exclude)) {
                    $this->_invalidVersion('<dependencies>' . $group . $type . '<exclude>',
                        $exclude);
                }
            }
        }
    }

    function _validateSubpackageDep($dep, $group)
    {
        $this->_validatePackageDep($dep, $group, '<subpackage>');
        if (isset($dep['providesextension'])) {
            $this->_subpackageCannotProvideExtension(isset($dep['name']) ? $dep['name'] : '');
        }
        if (isset($dep['conflicts'])) {
            $this->_subpackagesCannotConflict(isset($dep['name']) ? $dep['name'] : '');
        }
    }

    function _validateExtensionDep($dep, $group = false, $installcondition = false)
    {
        if (isset($dep['conflicts'])) {
            $structure = array(
                'name',
                '*min',
                '*max',
                '*exclude',
                'conflicts',
            );
        } else {
            $structure = array(
                'name',
                '*min',
                '*max',
                '*recommended',
                '*exclude',
            );
        }
        if ($installcondition) {
            $type = '<installcondition><extension>';
        } else {
            $type = '<dependencies>' . $group . '<extension>';
        }
        if (isset($dep['name'])) {
            $type .= '<name>' . $dep['name'] . '</name>';
        }
        $this->_stupidSchemaValidate($structure, $dep, $type);
        if (isset($dep['min'])) {
            if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                  $dep['min'])) {
                $this->_invalidVersion(substr($type, 1) . '<min', $dep['min']);
            }
        }
        if (isset($dep['max'])) {
            if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                  $dep['max'])) {
                $this->_invalidVersion(substr($type, 1) . '<max', $dep['max']);
            }
        }
        if (isset($dep['recommended'])) {
            if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                  $dep['recommended'])) {
                $this->_invalidVersion(substr($type, 1) . '<recommended', $dep['recommended']);
            }
        }
        if (isset($dep['exclude'])) {
            if (!is_array($dep['exclude'])) {
                $dep['exclude'] = array($dep['exclude']);
            }
            foreach ($dep['exclude'] as $exclude) {
                if (!preg_match('/^\d+(?:\.\d+)*(?:[a-zA-Z]+\d*)?\\z/',
                      $exclude)) {
                    $this->_invalidVersion(substr($type, 1) . '<exclude', $exclude);
                }
            }
        }
    }

    function _validateOsDep($dep, $installcondition = false)
    {
        $structure = array(
            'name',
            '*conflicts',
        );
        $type = $installcondition ? '<installcondition><os>' : '<dependencies><required><os>';
        if ($this->_stupidSchemaValidate($structure, $dep, $type)) {
            if ($dep['name'] == '*') {
                if (array_key_exists('conflicts', $dep)) {
                    $this->_cannotConflictWithAllOs($type);
                }
            }
        }
    }

    function _validateArchDep($dep, $installcondition = false)
    {
        $structure = array(
            'pattern',
            '*conflicts',
        );
        $type = $installcondition ? '<installcondition><arch>' : '<dependencies><required><arch>';
        $this->_stupidSchemaValidate($structure, $dep, $type);
    }

    function _validateInstallConditions($cond, $release)
    {
        $structure = array(
            '*php',
            '*extension',
            '*os',
            '*arch',
        );
        if (!$this->_stupidSchemaValidate($structure,
              $cond, $release)) {
            return false;
        }
        foreach (array('php', 'extension', 'os', 'arch') as $type) {
            if (isset($cond[$type])) {
                $iter = $cond[$type];
                if (!is_array($iter) || !isset($iter[0])) {
                    $iter = array($iter);
                }
                foreach ($iter as $package) {
                    if ($type == 'extension') {
                        $this->{"_validate{$type}Dep"}($package, false, true);
                    } else {
                        $this->{"_validate{$type}Dep"}($package, true);
                    }
                }
            }
        }
    }

    function _validateDependencies()
    {
        $structure = array(
            'required',
            '*optional',
            '*group->name->hint'
        );
        if (!$this->_stupidSchemaValidate($structure,
              $this->_packageInfo['dependencies'], '<dependencies>')) {
            return false;
        }
        foreach (array('required', 'optional') as $simpledep) {
            if (isset($this->_packageInfo['dependencies'][$simpledep])) {
                if ($simpledep == 'optional') {
                    $structure = array(
                        '*package',
                        '*subpackage',
                        '*extension',
                    );
                } else {
                    $structure = array(
                        'php',
                        'pearinstaller',
                        '*package',
                        '*subpackage',
                        '*extension',
                        '*os',
                        '*arch',
                    );
                }
                if ($this->_stupidSchemaValidate($structure,
                      $this->_packageInfo['dependencies'][$simpledep],
                      "<dependencies><$simpledep>")) {
                    foreach (array('package', 'subpackage', 'extension') as $type) {
                        if (isset($this->_packageInfo['dependencies'][$simpledep][$type])) {
                            $iter = $this->_packageInfo['dependencies'][$simpledep][$type];
                            if (!isset($iter[0])) {
                                $iter = array($iter);
                            }
                            foreach ($iter as $package) {
                                if ($type != 'extension') {
                                    if (isset($package['uri'])) {
                                        if (isset($package['channel'])) {
                                            $this->_UrlOrChannel($type,
                                                $package['name']);
                                        }
                                    } else {
                                        if (!isset($package['channel'])) {
                                            $this->_NoChannel($type, $package['name']);
                                        }
                                    }
                                }
                                $this->{"_validate{$type}Dep"}($package, "<$simpledep>");
                            }
                        }
       