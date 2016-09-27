<?php
use App\Defines\Defines;

$progress = Defines::REPAIR_PROGRESS;

foreach ($progress as $item_no => $label ):
	$class = ( $step == $item_no ) ? 'panel-primary' : 'panel-default' ;

	?>
	<div class="panel <?= $class ?>">
		<div class="panel-heading text-center">
			<?= $label ?>
		</div>
	</div>
	<?php
	if ($item_no + 1 != count($progress)) {
		echo '<div class="text-center"><i class="fa fa-caret-down"></i></div>';
	}

endforeach;
?>
