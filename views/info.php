<?php

use Webcamviewer\View;

if (!defined("CMSIMPLE_XH_VERSION")) {
    header("HTTP/1.1 403 Forbidden");
    exit;
}

/**
 * @var View $this
 * @var string $version
 * @var array<array{label:string,stateLabel:string,class:string}> $checks
 */
?>

<h1>Webcamviewer <?=$this->esc($version)?></h1>
<h2><?=$this->text('syscheck_title')?></h2>
<?php foreach ($checks as $check):?>
<p class="<?=$this->esc($check["class"])?>"><?=$this->esc($check["label"])?> ⇒ <?=$this->esc($check["stateLabel"])?></p>
<?php endforeach?>
