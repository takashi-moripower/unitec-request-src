<?php 
use App\Defines\Defines;
?>
<ol class="step-explain">
	<?php 
	foreach( Defines::SELL_PROGRESS as $item ){
		echo "<li><div class='title'>{$item['label']}</div><div class='explain'>{$item['explain']}</div></li>";
	}
	?>
</ol>


<div class="text-center">
	<a href="<?= $this->Url->build(['action' => 'step1']) ?>" class="my-btn my-btn-primary">
		<i class="fa fa-caret-right"></i> 次に進む
	</a>	
</div>
