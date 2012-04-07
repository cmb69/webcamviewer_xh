<?php

/**
 * Image server of Webcamviewer_XH.
 *
 * Copyright (c) 2012 Christoph M. Becker (see license.txt)
 */


/**
 * Delivers error messages as image and exits script.
 *
 * @param string $msg  The error message.
 * @param string $path  The according path.
 * @return void
 */
function error($msg, $path) {
    $img = imagecreate(400, 200);
    imagecolorallocate($img, 0, 0, 0);
    $col = imagecolorallocate($img, 192, 0, 0);
    $font = 5;
    imagestring($img, $font, 5, 5, $msg, $col);
    imagestring($img, $font, 5, 2 * imagefontheight($font) + 5, $path, $col);
    header('Content-type: image/jpeg');
    imagejpeg($img);
    exit;
}


include './config/config.php';


/**
 * Check for errors.
 */
$url = '../../'.$_GET['url'];
if (!is_readable($url)) {
    error('Can\'t read:', $_GET['url']);
}
if (($rpfile = dirname(realpath($url))) === FALSE) {
    error('Can\t open folder:', dirname($_GET['url']));
}
if (($rpdir = rtrim(realpath('../../'.$plugin_cf['webcamviewer']['folder_images']), '/')) === FALSE) {
    error('Can\'t open folder:', $plugin_cf['webcamviewer']['folder_images']);
}
if ($rpfile != $rpdir) {
    error('Access forbidden:', $_GET['url']);
}
if (($info = getimagesize($url)) === FALSE) {
    error('No image:', $_GET['url']);
}


/**
 * Deliver the image.
 */
header('Content-type: '.$info['mime']);
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
readfile($url);

?>
