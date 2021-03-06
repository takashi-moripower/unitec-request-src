<?php
use App\Defines\Defines;

$RP = Defines::REPAIR_PROGRESS;
$title = $RP[$step]['label'];
?>
<?php $this->append('script') ?>
<script>
	$(function(){
		$(window).on('load resize', setTableHeight );
	});
	
	function setTableHeight(){
		td = $('.nav-progress-mobile .icons td');
		w = td.first().width();
		if( td.first().height() < w ){
			td.first().height( w );
		}
	}
</script>
<?php $this->end() ?>
<div class="nav-progress-mobile">
	<div class="head">STEP.<?= $step ?> <div class="title"><?= $title ?></div></div>
	<table class="icons">
		<tbody>
			<tr>
				<?php
				foreach ($RP as $item_id => $item):
					$class = ( $item_id == $step ) ? 'active' : '';

					echo "<td class='icon {$class}'><i class='fa fa-{$item['icon']} fa-fw'></i></td>";
					if ($item_id + 1 != count($RP)) {
						echo '<td class="arrow"><i class="fa fa-caret-right"></i></td>';
					}

				endforeach;
				?>
			</tr>
		</tbody>
	</table>
</div>