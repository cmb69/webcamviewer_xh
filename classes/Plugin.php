<?php

/**
 * Copyright 2012-2022 Christoph M. Becker
 *
 * This file is part of Webcamviewer_XH.
 *
 * Webcamviewer_XH is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Webcamviewer_XH is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Webcamviewer_XH.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Webcamviewer;

class Plugin
{
    const VERSION = "1.1-dev";

    /**
     * @return void
     */
    public static function dispatch()
    {
        self::init();
        if (defined("XH_ADM") && XH_ADM) {
            XH_registerStandardPluginMenuItems(false);
            if (self::isAdministrationRequested()) {
                self::handleAdministration();
            }
        }
    }

    /**
     * @return void
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

    protected static function isAdministrationRequested(): bool
    {
        return XH_wantsPluginAdministration('webcamviewer');
    }

    /**
     * @return void
     */
    protected static function handleAdministration()
    {
        global $admin, $o;

        $o .= print_plugin_admin('off');
        switch ($admin) {
            case '':
                $o .= self::renderInfo();
                break;
            default:
                $o .= plugin_admin_common();
        }
    }

    protected static function renderInfo(): string
    {
        global $pth, $plugin_tx;

        $ptx = $plugin_tx['webcamviewer'];
        $labels = array(
            'syscheck' => $ptx['syscheck_title']
        );
        foreach (array('ok', 'warn', 'fail') as $state) {
            $images[$state] = $pth['folder']['plugins']
                . 'webcamviewer/images/' . $state . '.png';
        }
        $checks = self::getSystemChecks();
        $version = self::VERSION;
        $bag = compact('labels', 'images', 'checks', 'version');
        return self::render('info', $bag);
    }

    /**
     * @return array<string,string>
     */
    protected static function getSystemChecks(): array
    {
        global $pth, $plugin_tx;

        $ptx = $plugin_tx['webcamviewer'];
        $phpVersion = "7.0.0";
        $xhVersion = "1.7.0";
        $checks = array();
        $checks[sprintf($ptx['syscheck_phpversion'], $phpVersion)]
            = version_compare(PHP_VERSION, $phpVersion) >= 0 ? 'ok' : 'fail';
        foreach (array('json') as $ext) {
            $checks[sprintf($ptx['syscheck_extension'], $ext)]
                = extension_loaded($ext) ? 'ok' : 'fail';
        }
        $checks[sprintf($ptx['syscheck_xhversion'], $xhVersion)]
            // @phpstan-ignore-next-line
            = version_compare(CMSIMPLE_XH_VERSION, "CMSimple_XH $xhVersion") >= 0 ? "ok" : "fail";
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
     * @param array<string,mixed> $_bag
     */
    protected static function render(string $_template, array $_bag): string
    {
        global $pth, $cf;

        $_template = $pth['folder']['plugins'] . 'webcamviewer/views/'
            . $_template . '.php';
        unset($pth, $cf);
        extract($_bag);
        ob_start();
        include $_template;
        $o = (string) ob_get_clean();
        return $o;
    }
}
