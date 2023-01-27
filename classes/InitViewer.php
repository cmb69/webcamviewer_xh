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

class InitViewer
{
    /** @var string */
    private $pluginFolder;

    /** @var int */
    private $interval;

    public function __construct(string $pluginFolder, int $interval)
    {
        $this->pluginFolder = $pluginFolder;
        $this->interval = $interval;
    }

    public function __invoke(): Response
    {
        $config = array(
            'interval' => 1000 * $this->interval
        );
        $json = json_encode($config, JSON_HEX_APOS | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $jsfile = "{$this->pluginFolder}webcamviewer.min.js";
        $hjs = "\n<meta name=\"webcamviewer_config\" content='$json'>"
            . "\n<script type=\"module\" src=\"$jsfile\"></script>";
        return new Response("", $hjs);
    }
}
