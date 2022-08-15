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

use stdClass;

final class ShowInfo
{
    /** @var string */
    private $pluginFolder;

    /** @var SystemChecker */
    private $systemChecker;

    /** @var View */
    private $view;

    public function __construct(string $pluginFolder, SystemChecker $systemChecker, View $view)
    {
        $this->pluginFolder = $pluginFolder;
        $this->systemChecker = $systemChecker;
        $this->view = $view;
    }

    public function __invoke(): string
    {
        return $this->view->render('info', [
            "checks" => $this->getSystemChecks(),
            "version" => Plugin::VERSION,
        ]);
    }

    /**
     * @return array<stdClass>
     */
    private function getSystemChecks(): array
    {
        $phpVersion = "7.0.0";
        $xhVersion = "1.7.0";
        $checks = array();
        $checks[] = (object) [
            "label" => sprintf($this->view->text('syscheck_phpversion'), $phpVersion),
            "class" => $this->systemChecker->checkVersion(PHP_VERSION, $phpVersion) ? 'xh_success' : 'xh_fail',
        ];
        foreach (array('json') as $ext) {
            $checks[] = (object) [
                "label" => sprintf($this->view->text('syscheck_extension'), $ext),
                "class" => $this->systemChecker->checkExtension($ext) ? 'xh_success' : 'xh_fail',
            ];
        }
        $checks[] = (object) [
            "label" => sprintf($this->view->text('syscheck_xhversion'), $xhVersion),
            "class" => $this->systemChecker->checkVersion(CMSIMPLE_XH_VERSION, "CMSimple_XH $xhVersion")
                ? "xh_success"
                : "xh_fail",
        ];
        $folders = array();
        foreach (array('config/', 'languages/') as $folder) {
            $folders[] = "{$this->pluginFolder}{$folder}";
        }
        foreach ($folders as $folder) {
            $checks[] = (object) [
                "label" => sprintf($this->view->text('syscheck_writable'), $folder),
                "class" => $this->systemChecker->checkWritability($folder) ? 'xh_success' : 'xh_warning',
            ];
        }
        return $checks;
    }
}
