<?php
/**
 * @var string $version
 * @var array<string,string> $labels
 * @var array<string,string> $checks
 * @var array<string,string> $images
 */
?>

<h1>Webcamviewer <?=$version?></h1>
<h2><?=$labels['syscheck']?></h2>
<ul style="list-style: none">
<?php foreach ($checks as $check => $state):?>
  <li>
    <img src="<?=$images[$state]?>" alt="<?=$images[$state]?>" style="margin: 0; height: 1em; padding-right: 1em">
    <span><?=$check?></span>
  </li>
<?php endforeach?>
</ul>
