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

final class View
{
    /** @var string */
    private $viewFolder;

    /** @var array<string,string> */
    private $lang;

    /**
     * @param array<string,string> $lang
     */
    public function __construct(string $viewFolder, array $lang)
    {
        $this->viewFolder = $viewFolder;
        $this->lang = $lang;
    }

    public function text(string $key): string
    {
        return $this->lang[$key];
    }

    /**
     * @param array<string,mixed> $_bag
     */
    public function render(string $_template, array $_bag): string
    {
        extract($_bag);
        ob_start();
        include "{$this->viewFolder}{$_template}.php";
        $o = (string) ob_get_clean();
        return $o;
    }
}
