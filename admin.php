<?php

/**
 * Back-End of Webcamviewer_XH.
 *
 * Copyright (c) 2012 Christoph M. Becker (see license.txt)
 */


if (!defined('CMSIMPLE_XH_VERSION')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

function Webcamviewer_systemChecks() // RELEASE-TODO
{
    global $pth, $tx, $plugin_tx;

    $ptx = $plugin_tx['webcamviewer'];
    $phpVersion = '4.0.7';
    $checks = array();
    $checks[sprintf($ptx['syscheck_phpversion'], $phpVersion)] =
	version_compare(PHP_VERSION, $phpVersion) >= 0 ? 'ok' : 'fail';
    foreach (array() as $ext) {
	$checks[sprintf($ptx['syscheck_extension'], $ext)] =
	    extension_loaded($ext) ? 'ok' : 'fail';
    }
    $checks[$ptx['syscheck_magic_quotes']] =
	!get_magic_quotes_runtime() ? 'ok' : 'fail';
    $checks[$ptx['syscheck_encoding']] =
	strtoupper($tx['meta']['codepage']) == 'UTF-8' ? 'ok' : 'warn';
    $folders = array();
    foreach (array('config/', 'languages/') as $folder) {
	$folders[] = $pth['folder']['plugins'] . 'webcamviewer/' . $folder;
    }
    foreach ($folders as $folder) {
	$checks[sprintf($ptx['syscheck_writable'], $folder)] =
	    is_writable($folder) ? 'ok' : 'warn';
    }
    return $checks;
}


function Webcamviewer_info()
{
    global $pth, $plugin_tx;

    $ptx = $plugin_tx['webcamviewer'];
    $labels = array(
	'syscheck' => $ptx['syscheck_title'],
	'about' => $ptx['about']
    );
    foreach (array('ok', 'warn', 'fail') as $state) {
	$images[$state] = $pth['folder']['plugins']
	    . 'webcamviewer/images/' . $state . '.png';
    }
    $checks = Webcamviewer_systemChecks();
    $icon = $pth['folder']['plugins'] . 'webcamviewer/webcamviewer.png';
    $version = WEBCAMVIEWER_VERSION;
    $bag = compact('labels', 'images', 'checks', 'icon', 'version');
    return Webcamviewer_render('info', $bag);
}


/**
 * Handle the plugin administration.
 */
if (!empty($webcamviewer)) {
    $o .= print_plugin_admin('off');
    switch ($admin) {
	case '':
	    $o .= Webcamviewer_info();
	    break;
	default:
	    $o .= plugin_admin_common($action, $admin, $plugin);
    }
}

?>
