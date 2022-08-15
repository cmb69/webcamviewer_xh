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
        global $pth, $admin, $plugin_tx, $o;

        $o .= print_plugin_admin('off');
        switch ($admin) {
            case '':
                $view = new View("{$pth['folder']['plugins']}webcamviewer/views/", $plugin_tx['webcamviewer']);
                $o .= (new ShowInfo("{$pth['folder']['plugins']}webcamviewer/", new SystemChecker(), $view))();
                break;
            default:
                $o .= plugin_admin_common();
        }
    }
}
