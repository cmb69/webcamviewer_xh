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


function Webcamviewer_render($_template, $_bag)
{
    global $pth;

    $_template = $pth['folder']['plugins'] . 'webcamviewer/views/' . $_template . '.htm';
    unset($pth);
    extract($_bag);
    ob_start();
    include $_template;
    return ob_get_clean();
}


/**
 * Activates the webcamviewer.
 *
 * @access public
 * @global string $hjs
 * @return void
 */
function webcamviewer() {
    global $hjs, $onload, $plugin_cf;

    $bag = array('interval' => $plugin_cf['webcamviewer']['interval']);
    $hjs .= Webcamviewer_render('script', $bag);
    $onload .= "webcamviewer.init();";
}


/**
 * Handle autoloading.
 */
if ($plugin_cf['webcamviewer']['autoload']) {
    webcamviewer();
}

?>
