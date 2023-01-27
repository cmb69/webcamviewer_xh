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

use function XH_includeVar;
use PHPUnit\Framework\TestCase;
use ApprovalTests\Approvals;

class ShowInfoTest extends TestCase
{
    public function testRendersPluginInfo(): void
    {
        $systemCheckerStub = $this->createStub(SystemChecker::class);
        $systemCheckerStub->method('checkVersion')->willReturn(true);
        $systemCheckerStub->method('checkExtension')->willReturn(true);
        $systemCheckerStub->method('checkWritability')->willReturn(true);
        $subject = new ShowInfo(
            "./",
            $systemCheckerStub,
            XH_includeVar("./languages/en.php", "plugin_tx")['webcamviewer']
        );

        $response = $subject();

        Approvals::verifyString($response);
    }
}
