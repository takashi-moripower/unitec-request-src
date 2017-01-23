<ul class="my-list1 my-list1-narrow">
<?php

for($i=1;$i<10;$i++){
	echo '<li>';
	echo $this->Html->link( sprintf('商品%02d',$i) , ['action'=>'step1']);
	echo '</li>';
}
?>
</ul>

<div class="text-center">
	<a href="<?= $this->Url->build(['action' => 'step51']) ?>" class="my-btn">戻る</a>
</div>
