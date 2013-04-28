<?php

/**
 * Front-End of Webcamviewer_XH.
 *
 * Copyright (c) 2012 Christoph M. Becker (see license.txt)
 */


if (!defined('CMSIMPLE_XH_VERSION')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}


define('WEBCAMVIEWER_VERSION', '1beta1');


function webcamviewer()
{
    global $_Webcamviewer;

    return $_Webcamviewer->init();
}


require $pth['folder']['plugin_classes'] . 'controller.php';

$_Webcamviewer = new Webcamviewer_Controller();

?>
