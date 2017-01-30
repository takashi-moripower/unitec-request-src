<h2><?= $category_name ?></h2>

<ul class="my-list1 my-list1-narrow">
	<?php foreach( $products as $product_name => $product_page ){
		echo "<li>";
		echo $this->Html->link($product_name , ['action'=>'step1',$product_page]);
		echo "</li>";
	}?>
</ul>
