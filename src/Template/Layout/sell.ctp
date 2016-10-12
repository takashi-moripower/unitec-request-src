<?php

use App\Defines\Defines;

$match;

if (preg_match('/step([0-9])/', $this->getAction(), $match)) {
	$step = $match[1];
} else {
	$step = NULL;
}

switch ($this->getController()) {
	case 'repair':
		$progress = Defines::REPAIR_PROGRESS;
		break;

	case 'inquiry':
		$progress = Defines::INQUIRY_PROGRESS;
		break;

	case 'sell':
		$progress = Defines::SELL_PROGRESS;
		break;
}


$this->start('title');
echo $progress[$step]['label'];
$this->end();
$this->append('script');
?>
<script>
	$(function () {
		$(function () {
			height = $('#wrap').height();
			if ($('.container').height() < height) {
				$('.container').height(height);
			}
			if ($('.left-nav').outerHeight() < height) {
				$('.left-nav').outerHeight(height);
			}
			if ($('.right-main').outerHeight() < height) {
				$('.right-main').outerHeight(height);
			}
		});
	});
</script>
<?php
$this->end();
$this->start('content');
?>
<div class="container">
	<div class="row">
		<div class="hidden-xs hidden-sm col-md-3 left-nav">
			<?= $this->Element('nav/progress', ['step' => $step, 'progress' => $progress]) ?>
		</div>
		<div class="col-xs-12  col-md-9 right-main">
			<div class="hidden-md hidden-lg">
				<?= $this->Element('repair/navProgressMobile', ['step' => $step]) ?>
			</div>
			<h1 class="title"><i class="fa fa-fw fa-<?= $progress[$step]['icon']; ?>"></i><?= $this->fetch('title') ?></h1><br>

			<?= $this->fetch('content') ?>
		</div>
	</div>
</div>
<?php
$this->end();

echo $this->Element('../Layout/default');
