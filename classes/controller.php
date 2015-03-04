<?php

/**
 * The controllers.
 *
 * PHP version 5
 *
 * @category  CMSimple_XH
 * @package   Webcamviewer
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2012-2015 Christoph M. Becker <http://3-magi.net/>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link      http://3-magi.net/?CMSimple_XH/Webcamviewer_XH
 */

/**
 * The controllers.
 *
 * @category CMSimple_XH
 * @package  Webcamviewer
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Webcamviewer_XH
 */
class Webcamviewer_Controller
{
    /**
     * Initializes a new instance.
     *
     * @return void
     *
     * @global array The configuration of the plugins.
     */
    public function __construct()
    {
        global $plugin_cf;

        if ($plugin_cf['webcamviewer']['autoload']) {
            $this->init();
        }
        $this->_dispatch();
    }

    /**
     * Renders a template.
     *
     * @param string $_template A template name.
     * @param array  $_bag      An array of values available in the template.
     *
     * @return string
     *
     * @global array The paths of system files and folders.
     * @global array The configuration of the core.
     */
    private function _render($_template, $_bag)
    {
        global $pth, $cf;

        $_template = $pth['folder']['plugins'] . 'webcamviewer/views/'
            . $_template . '.htm';
        $_xhtml = $cf['xhtml']['endtags'];
        unset($pth, $cf);
        extract($_bag);
        ob_start();
        include $_template;
        $o = ob_get_clean();
        if (!$_xhtml) {
            $o = str_replace('/>', '>', $o);
        }
        return $o;
    }

    /**
     * Returns the system checks.
     *
     * @return array
     *
     * @global array The paths of system files and folders.
     * @global array The localization of the core.
     * @global array The localization of the plugins.
     */
    private function _systemChecks()
    {
        global $pth, $tx, $plugin_tx;

        $ptx = $plugin_tx['webcamviewer'];
        $phpVersion = '4.3.0';
        $checks = array();
        $checks[sprintf($ptx['syscheck_phpversion'], $phpVersion)]
            = version_compare(PHP_VERSION, $phpVersion) >= 0 ? 'ok' : 'fail';
        foreach (array() as $ext) {
            $checks[sprintf($ptx['syscheck_extension'], $ext)]
                = extension_loaded($ext) ? 'ok' : 'fail';
        }
        $checks[$ptx['syscheck_magic_quotes']]
            = !get_magic_quotes_runtime() ? 'ok' : 'fail';
        $checks[$ptx['syscheck_encoding']]
            = strtoupper($tx['meta']['codepage']) == 'UTF-8' ? 'ok' : 'warn';
        $folders = array();
        foreach (array('config/', 'languages/') as $folder) {
            $folders[] = $pth['folder']['plugins'] . 'webcamviewer/' . $folder;
        }
        foreach ($folders as $folder) {
            $checks[sprintf($ptx['syscheck_writable'], $folder)]
                = is_writable($folder) ? 'ok' : 'warn';
        }
        return $checks;
    }

    /**
     * Returns the plugin information view.
     *
     * @return string (X)HTML.
     *
     * @global array The paths of system files and folders.
     * @global array The localization of the plugins.
     */
    private function _info()
    {
        global $pth, $plugin_tx;

        $ptx = $plugin_tx['webcamviewer'];
        $labels = array(
            'syscheck' => $ptx['syscheck_title'],
            'about' => $ptx['about']
        );
        foreach (array('ok', 'warn', 'fail') as $state) {
            $images[$state] = $pth['folder']['plugins']
                . 'webcamviewer/images/' . $state . '.png';
        }
        $checks = $this->_systemChecks();
        $icon = $pth['folder']['plugins'] . 'webcamviewer/webcamviewer.png';
        $version = WEBCAMVIEWER_VERSION;
        $bag = compact('labels', 'images', 'checks', 'icon', 'version');
        return $this->_render('info', $bag);
    }

    /**
     * Dispatches on plugin related requests.
     *
     * @return void
     *
     * @global bool   Whether the user is logged in as admin.
     * @global string The value of the "admin" GET or POST parameter.
     * @global string The value of the "action" GET or POST parameter.
     * @global string The name of the plugin.
     * @global string The (X)HTML to be placed in the contents area.
     * @global string Whether the plugin administration is requested.
     */
    private function _dispatch()
    {
        global $adm, $admin, $action, $plugin, $o, $webcamviewer;

        if ($adm && isset($webcamviewer) && $webcamviewer == 'true') {
            $o .= print_plugin_admin('off');
            switch ($admin) {
            case '':
                $o .= $this->_info();
                break;
            default:
                $o .= plugin_admin_common($action, $admin, $plugin);
            }
        }
    }

    /**
     * Activates the webcamviewer.
     *
     * @return void
     *
     * @global string (X)HTML to be inserted to the "head" element.
     * @global string (X)HTML to be inserted to the "onload" attribute
     *                of the "body" element.
     * @global array  The configuration of the plugins.
     *
     * @staticvar bool $again Whether the function has been called before.
     */
    public function init()
    {
        global $hjs, $onload, $plugin_cf;
        static $again = false;

        if (!$again) {
            $again = true;
            $interval = 1000 * $plugin_cf['webcamviewer']['interval'];
            $bag = compact('interval');
            $hjs .= $this->_render('script', $bag);
            $onload .= "webcamviewer.init();";
        }
    }
}

?>
