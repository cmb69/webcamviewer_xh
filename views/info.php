<?php

namespace Webcamviewer;

/**
 * @var View $this
 * @var string $version
 * @var array<string,string> $checks
 */
?>

<h1>Webcamviewer <?=$version?></h1>
<h2><?=$this->text('syscheck_title')?></h2>
<?php foreach ($checks as $check => $class):?>
<p class="<?=$class?>"><?=$check?></p>
<?php endforeach?>
