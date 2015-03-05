<?php

/**
 * The plugin entry point.
 *
 * PHP version 5
 *
 * @category  CMSimple_XH
 * @package   Webcamviewer
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2012-2015 Christoph M. Becker <http://3-magi.net/>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link      http://3-magi.net/?CMSimple_XH/Webcamviewer_XH
 */

/*
 * Prevent direct access and usage from unsupported CMSimple_XH versions.
 */
if (!defined('CMSIMPLE_XH_VERSION')
    || strpos(CMSIMPLE_XH_VERSION, 'CMSimple_XH') !== 0
    || version_compare(CMSIMPLE_XH_VERSION, 'CMSimple_XH 1.6', 'lt')
) {
    header('HTTP/1.1 403 Forbidden');
    header('Content-Type: text/plain; charset=UTF-8');
    die(<<<EOT
Webcamviewer_XH detected an unsupported CMSimple_XH version.
Uninstall Webcamviewer_XH or upgrade to a supported CMSimple_XH version!
EOT
    );
}

/**
 * The plugin version.
 */
define('WEBCAMVIEWER_VERSION', '@WEBCAMVIEWER_VERSION@');

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
