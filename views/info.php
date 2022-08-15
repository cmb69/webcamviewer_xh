<?php

namespace Webcamviewer;

use stdClass;

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
