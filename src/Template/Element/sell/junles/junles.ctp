<?php

$junles = [
/*
	'junle_title' => [
		'category_title' => 'category_page',
		...
	],
 */	
	
	
	'ジャンル名１' => [
		'カテゴリ01' => 'category01',
		'カテゴリ02' => 'category02',
		'カテゴリ03' => 'category03',
		'カテゴリ04' => 'category04',
		'カテゴリ05' => 'category05',
		'カテゴリ06' => 'category06',
		'カテゴリ07' => 'category07',
		'カテゴリ08' => 'category08',
		'カテゴリ09' => 'category09',
	],
	'ジャンル名2' => [
		'カテゴリ11' => 'category11',
		'カテゴリ12' => 'category12',
		'カテゴリ13' => 'category13',
		'カテゴリ14' => 'category14',
		'カテゴリ15' => 'category15',
		'カテゴリ16' => 'category16',
		'カテゴリ17' => 'category17',
		'カテゴリ18' => 'category18',
		'カテゴリ19' => 'category19',
	],
];

?>
	
<?php
foreach( $junles as $junle_title => $junle ){
	echo "<div class='row'>";
	echo "<h2>{$junle_title}</h2>";
	foreach( $junle as $cat_title => $cat_page ){
		echo $this->Html->link( $cat_title , ['controller'=>'sell' , 'action'=>'step01' , $cat_page ] , ['class'=>'btn btn-default col-xs-3']);
	}
	echo "</div>";
}
?>

