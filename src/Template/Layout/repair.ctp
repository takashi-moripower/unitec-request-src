<?php

use App\Defines\Defines;

$match;

if (preg_match('/step([0-9])/', $this->getAction(), $match)) {
	$step = $match[1];
} else {
	$step = NULL;
}

$progress = Defines::REPAIR_PROGRESS;


$this->start('title');
echo $progress[$step];
$this->end();
$this->start('content');
?>
<div class="container">
	<div class="row">
		<div class="col-xs-3">
			<?= $this->Element('repair/navProgress',['step'=>$step]) ?>
		</div>
		<div class="col-xs-9">
			<h1><?= $this->fetch('title') ?></h1>
			<?= $this->fetch('content') ?>
		</div>
	</div>
</div>
<?php
$this->end();

echo $this->Element('../Layout/default');
