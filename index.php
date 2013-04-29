<?php

/**
 * Index of Webcamviewer_XH.
 *
 * @package    Webcamviewer
 * @copyright  Copyright (c) 2012-2013 Christoph M. Becker <http://3-magi.net/>
 * @license    http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @version    $Id$
 * @link       http://3-magi.net/?CMSimple_XH/Webcamviewer_XH
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
 * @global object  The webcamviewer controller.
 * @return string  The (X)HTML.
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
