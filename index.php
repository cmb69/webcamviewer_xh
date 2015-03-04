<?php

/**
 * The plugin entry point.
 *
 * PHP versions 4 and 5
 *
 * @category  CMSimple_XH
 * @package   Webcamviewer
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2012-2015 Christoph M. Becker <http://3-magi.net/>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link      http://3-magi.net/?CMSimple_XH/Webcamviewer_XH
 */

/*
 * Prevent direct access.
 */
if (!defined('CMSIMPLE_XH_VERSION')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

/**
 * The webcamviewer controller class.
 */
require $pth['folder']['plugin_classes'] . 'controller.php';

/**
 * The plugin version.
 */
define('WEBCAMVIEWER_VERSION', '1beta2');

/**
 * Initializes the webcamviewer.
 *
 * @return string (X)HTML.
 *
 * @global Webcamviewer_Controller The controller.
 */
function webcamviewer()
{
    global $_Webcamviewer;

    return $_Webcamviewer->init();
}

/**
 * Create the webcamviewer controller.
 */
$_Webcamviewer = new Webcamviewer_Controller();

?>
