<?php

/**
 * Copyright 2023 Christoph M. Becker
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

class Dic
{
    public static function makeInitViewer(): InitViewer
    {
        global $pth, $plugin_cf;

        return new InitViewer(
            "{$pth['folder']['plugins']}webcamviewer/",
            (int) $plugin_cf['webcamviewer']['interval']
        );
    }

    public static function makeShowInfo(): ShowInfo
    {
        global $pth, $plugin_tx;

        return new ShowInfo(
            "{$pth['folder']['plugins']}webcamviewer/",
            new SystemChecker(),
            $plugin_tx['webcamviewer']
        );
    }
}
