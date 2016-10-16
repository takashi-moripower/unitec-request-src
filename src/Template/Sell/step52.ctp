<ul class="my-list1 my-list1-narrow">
<?php

for($i=1;$i<10;$i++){
	echo '<li>';
	echo $this->Html->link( sprintf('商品%02d',$i) , ['action'=>'step53']);
	echo '</li>';
}
?>
</ul>