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
        global $pth, $plugin_cf, $hjs;

        $config = array(
            'interval' => 1000 * $plugin_cf['webcamviewer']['interval']
        );
        $json = json_encode($config, JSON_HEX_APOS | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $jsfile = "{$pth['folder']['plugins']}webcamviewer/webcamviewer.min.js";
        $hjs .= "<meta name=\"webcamviewer_config\" content='$json'>"
            . "<script type=\"module\" src=\"$jsfile\"></script>";
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

        $view = new View();
        $ptx = $plugin_tx['webcamviewer'];
        $labels = array(
            'syscheck' => $ptx['syscheck_title']
        );
        $checks = self::getSystemChecks();
        $version = self::VERSION;
        $bag = compact('labels', 'checks', 'version');
        return $view->render('info', $bag);
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
            = version_compare(PHP_VERSION, $phpVersion) >= 0 ? 'xh_success' : 'xh_fail';
        foreach (array('json') as $ext) {
            $checks[sprintf($ptx['syscheck_extension'], $ext)]
                = extension_loaded($ext) ? 'xh_success' : 'xh_fail';
        }
        $checks[sprintf($ptx['syscheck_xhversion'], $xhVersion)]
            // @phpstan-ignore-next-line
            = version_compare(CMSIMPLE_XH_VERSION, "CMSimple_XH $xhVersion") >= 0 ? "xh_success" : "xh_fail";
        $folders = array();
        foreach (array('config/', 'languages/') as $folder) {
            $folders[] = $pth['folder']['plugins'] . 'webcamviewer/' . $folder;
        }
        foreach ($folders as $folder) {
            $checks[sprintf($ptx['syscheck_writable'], $folder)]
                = is_writable($folder) ? 'xh_success' : 'xh_warning';
        }
        return $checks;
    }
}
