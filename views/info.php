<?php

use Webcamviewer\View;

if (!defined("CMSIMPLE_XH_VERSION")) {
    header("HTTP/1.1 403 Forbidden");
    exit;
}

/**
 * @var View $this
 * @var string $version
 * @var array<stdClass> $checks
 */
?>

<h1>Webcamviewer <?=$version?></h1>
<h2><?=$this->text('syscheck_title')?></h2>
<?php foreach ($checks as $check):?>
<p class="<?=$check->class?>"><?=$check->label?></p>
<?php endforeach?>
