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


/**
 * Activates the webcamviewer.
 *
 * @access public
 * @global string $hjs
 * @return void
 */
function webcamviewer() {
    global $pth, $hjs, $plugin_cf;

    include_once $pth['folder']['plugins'].'jquery/jquery.inc.php';
    include_jquery();
    $hjs .= <<<SCRIPT
<script type="text/javascript" src="{$pth['folder']['plugins']}webcamviewer/webcamviewer.js"></script>
<script type="text/javascript">Webcamviewer.INTERVAL = {$plugin_cf['webcamviewer']['interval']}</script>

SCRIPT;
}


/**
 * Handle autoloading.
 */
if ($plugin_cf['webcamviewer']['autoload']) {
    webcamviewer();
}

?>
