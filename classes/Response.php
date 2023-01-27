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

class Response
{
    /** @var string */
    private $output;

    /** @var string */
    private $hjs;

    /**
     * @param string $output
     * @param string $hjs
     */
    public function __construct($output, $hjs = "")
    {
        $this->output = $output;
        $this->hjs = $hjs;
    }

    /** @return string */
    public function process()
    {
        global $hjs;

        $hjs .= $this->hjs;
        return $this->output;
    }

    /** @return string */
    public function representation()
    {
        return print_r($this, true);
    }
}
