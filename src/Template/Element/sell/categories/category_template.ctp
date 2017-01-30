<?php
$category_name = "カテゴリ01";
$products = [
	'商品01' => 'product01',
	'商品02' => 'product02',
	'商品03' => 'product03',
	'商品04' => 'product04',
	'商品05' => 'product05',
	'商品06' => 'product06',
	'商品07' => 'product07',
	'商品08' => 'product08',
	'商品09' => 'product09',
	'商品10' => 'product10',
];


echo $this->Element('sell/step01',compact('category_name','products'));
?>


