<?php

/**
 * Copyright 2012-2023 Christoph M. Becker
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

    /** @var SystemChecker */
    private $systemChecker;

    /** @var array<string> */
    private $lang;

    /** @var View */
    private $view;

    /**
     * @param array<string> $lang
     */
    public function __construct(string $pluginFolder, SystemChecker $systemChecker, array $lang)
    {
        $this->pluginFolder = $pluginFolder;
        $this->systemChecker = $systemChecker;
        $this->lang = $lang;
        $this->view = new View("{$this->pluginFolder}views/", $this->lang);
    }

    public function __invoke(): Response
    {
        $output = $this->view->render('info', [
            "checks" => $this->getSystemChecks(),
            "version" => WEBCAMVIEWER_VERSION,
        ]);
        return new Response($output);
    }

    /**
     * @return array<array{label:string,stateLabel:string,class:string}>
     */
    private function getSystemChecks(): array
    {
        $phpVersion = "7.0.0";
        $xhVersion = "1.7.0";
        $checks = array();
        $state = $this->systemChecker->checkVersion(PHP_VERSION, $phpVersion) ? "success" : "fail";
        $checks[] = [
            "label" => sprintf($this->lang['syscheck_phpversion'], $phpVersion),
            "stateLabel" => $this->lang["syscheck_$state"],
            "class" => "xh_$state",
        ];
        foreach (array('json') as $ext) {
            $state = $this->systemChecker->checkExtension($ext) ? "success" : "fail";
            $checks[] = [
                "label" => sprintf($this->lang['syscheck_extension'], $ext),
                "stateLabel" => $this->lang["syscheck_$state"],
                "class" => "xh_$state",
            ];
        }
        $state = $this->systemChecker->checkVersion(CMSIMPLE_XH_VERSION, "CMSimple_XH $xhVersion") ? "success" : "fail";
        $checks[] = [
            "label" => sprintf($this->lang['syscheck_xhversion'], $xhVersion),
            "stateLabel" => $this->lang["syscheck_$state"],
            "class" => "xh_$state",
        ];
        $folders = array();
        foreach (array('config/', 'languages/') as $folder) {
            $folders[] = "{$this->pluginFolder}{$folder}";
        }
        foreach ($folders as $folder) {
            $state = $this->systemChecker->checkWritability($folder) ? "success" : "warning";
            $checks[] = [
                "label" => sprintf($this->lang['syscheck_writable'], $folder),
                "stateLabel" => $this->lang["syscheck_$state"],
                "class" => "xh_$state",
            ];
        }
        return $checks;
    }
}
