<?php

/**
 * The controller.
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
 * The controller.
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
     * Dispatches on plugin related requests.
     *
     * @return void
     */
    public static function dispatch()
    {
        self::init();
        if (XH_ADM) {
            if (function_exists('XH_registerStandardPluginMenuItems')) {
                XH_registerStandardPluginMenuItems(false);
            }
            if (self::isAdministrationRequested()) {
                self::handleAdministration();
            }
        }
    }

    /**
     * Activates the webcam viewers.
     *
     * @return void
     *
     * @global string The paths of system files and folders.
     * @global array  The configuration of the plugins.
     * @global string (X)HTML to be inserted at the bottom of the body element.
     */
    protected static function init()
    {
        global $pth, $plugin_cf, $bjs;

        $config = array(
            'interval' => 1000 * $plugin_cf['webcamviewer']['interval']
        );
        $bjs .= '<script type="text/javascript">/* <![CDATA[ */'
            . 'var WEBCAMVIEWER = ' . json_encode($config) . ';'
            . '/* ]]> */</script>'
            . '<script type="text/javascript" src="'
            . $pth['folder']['plugins'] . 'webcamviewer/webcamviewer.js">'
            . '</script>';
    }

    /**
     * Returns whether the plugin administration is requested.
     *
     * @return bool
     *
     * @global string Whether the plugin administration is requested.
     */
    protected static function isAdministrationRequested()
    {
        global $webcamviewer;

        return function_exists('XH_wantsPluginAdministration')
            && XH_wantsPluginAdministration('webcamviewer')
            || isset($webcamviewer) && $webcamviewer == 'true';
    }

    /**
     * Handles plugin administration requests.
     *
     * @return void
     *
     * @global string The value of the <var>admin</var> GP parameter.
     * @global string The value of the <var>action</var> GP parameter.
     * @global string The (X)HTML to be placed in the contents area.
     */
    protected static function handleAdministration()
    {
        global $admin, $action, $o;

        $o .= print_plugin_admin('off');
        switch ($admin) {
            case '':
                $o .= self::renderInfo();
                break;
            default:
                $o .= plugin_admin_common($action, $admin, 'webcamviewer');
        }
    }

    /**
     * Returns the plugin information view.
     *
     * @return string (X)HTML.
     *
     * @global array The paths of system files and folders.
     * @global array The localization of the plugins.
     */
    protected static function renderInfo()
    {
        global $pth, $plugin_tx;

        $ptx = $plugin_tx['webcamviewer'];
        $labels = array(
            'info' => $ptx['menu_info'],
            'syscheck' => $ptx['syscheck_title']
        );
        foreach (array('ok', 'warn', 'fail') as $state) {
            $images[$state] = $pth['folder']['plugins']
                . 'webcamviewer/images/' . $state . '.png';
        }
        $checks = self::getSystemChecks();
        $icon = $pth['folder']['plugins'] . 'webcamviewer/webcamviewer.png';
        $alt = $ptx['alt_logo'];
        $version = WEBCAMVIEWER_VERSION;
        $bag = compact('labels', 'images', 'checks', 'icon', 'alt', 'version');
        return self::render('info', $bag);
    }

    /**
     * Returns the system checks.
     *
     * @return array
     *
     * @global array The paths of system files and folders.
     * @global array The localization of the plugins.
     */
    protected static function getSystemChecks()
    {
        global $pth, $plugin_tx;

        $ptx = $plugin_tx['webcamviewer'];
        $phpVersion = '5.2.0';
        $checks = array();
        $checks[sprintf($ptx['syscheck_phpversion'], $phpVersion)]
            = version_compare(PHP_VERSION, $phpVersion) >= 0 ? 'ok' : 'fail';
        foreach (array('json', 'spl') as $ext) {
            $checks[sprintf($ptx['syscheck_extension'], $ext)]
                = extension_loaded($ext) ? 'ok' : 'fail';
        }
        $checks[$ptx['syscheck_magic_quotes']]
            = !get_magic_quotes_runtime() ? 'ok' : 'fail';
        $folders = array();
        foreach (array('config/', 'css/', 'languages/') as $folder) {
            $folders[] = $pth['folder']['plugins'] . 'webcamviewer/' . $folder;
        }
        foreach ($folders as $folder) {
            $checks[sprintf($ptx['syscheck_writable'], $folder)]
                = is_writable($folder) ? 'ok' : 'warn';
        }
        return $checks;
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
    protected static function render($_template, $_bag)
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
}
