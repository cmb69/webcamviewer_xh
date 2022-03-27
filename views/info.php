<?php
/**
 * @var string $version
 * @var array<string,string> $labels
 * @var array<string,string> $checks
 */
?>

<h1>Webcamviewer <?=$version?></h1>
<h2><?=$labels['syscheck']?></h2>
<?php foreach ($checks as $check => $class):?>
<p class="<?=$class?>"><?=$check?></p>
<?php endforeach?>
