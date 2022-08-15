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

final class ShowInfo
{
    /** @var string */
    private $pluginFolder;

    /** @var View */
    private $view;

    public function __construct(string $pluginFolder, View $view)
    {
        $this->pluginFolder = $pluginFolder;
        $this->view = $view;
    }

    public function __invoke(): string
    {
        $labels = array(
            'syscheck' => $this->view->text('syscheck_title')
        );
        $checks = $this->getSystemChecks();
        $version = Plugin::VERSION;
        $bag = compact('labels', 'checks', 'version');
        return $this->view->render('info', $bag);
    }

    /**
     * @return array<string,string>
     */
    private function getSystemChecks(): array
    {
        $phpVersion = "7.0.0";
        $xhVersion = "1.7.0";
        $checks = array();
        $checks[sprintf($this->view->text('syscheck_phpversion'), $phpVersion)]
            = version_compare(PHP_VERSION, $phpVersion) >= 0 ? 'xh_success' : 'xh_fail';
        foreach (array('json') as $ext) {
            $checks[sprintf($this->view->text('syscheck_extension'), $ext)]
                = extension_loaded($ext) ? 'xh_success' : 'xh_fail';
        }
        $checks[sprintf($this->view->text('syscheck_xhversion'), $xhVersion)]
            // @phpstan-ignore-next-line
            = version_compare(CMSIMPLE_XH_VERSION, "CMSimple_XH $xhVersion") >= 0 ? "xh_success" : "xh_fail";
        $folders = array();
        foreach (array('config/', 'languages/') as $folder) {
            $folders[] = "{$this->pluginFolder}{$folder}";
        }
        foreach ($folders as $folder) {
            $checks[sprintf($this->view->text('syscheck_writable'), $folder)]
                = is_writable($folder) ? 'xh_success' : 'xh_warning';
        }
        return $checks;
    }
}