<div class="left-nav-progress">
	<?php

	use App\Defines\Defines;

$progress = Defines::REPAIR_PROGRESS;

	foreach ($progress as $item_no => $item):
		$class = ( $step == $item_no ) ? 'active' : '';
		?>
		<div class="item <?= $class ?>">
			<i class="fa fa-<?= $item['icon'] ?> fa-fw"></i>
			<?= $item['label'] ?>
		</div>
		<?php
		if ($item_no + 1 != count($progress)) {
			echo '<div class="arrow"><i class="fa fa-caret-down"></i></div>';
		}

	endforeach;
	?>
</div>
