<?php

/**
 * The autoloader.
 *
 * PHP version 5
 *
 * @category  CMSimple_XH
 * @package   Webcamviewer
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2015 Christoph M. Becker <http://3-magi.net>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link      http://3-magi.net/?CMSimple_XH/Webcamviewer_XH
 */

/**
 * Autoloads the plugin classes.
 *
 * @param string $class A class name.
 *
 * @return void
 *
 * @global array The paths of system files and folders.
 */
function Webcamviewer_autoload($class)
{
    global $pth;

    $parts = explode('_', $class, 2);
    if ($parts[0] == 'Webcamviewer') {
        include_once $pth['folder']['plugins'] . 'webcamviewer/classes/'
            . $parts[1] . '.php';
    }
}

spl_autoload_register('Webcamviewer_autoload');

?>