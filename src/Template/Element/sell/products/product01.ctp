<?php
$product_name = "1400010 コンパクト高速ドリル";

$parts = [
	[
		'id'=>'0000000001',
		'name'=>'パーツ名01',
		'cost'=>'1000',
		'note'=>'備考'
	],
	[
		'id'=>'0000000002',
		'name'=>'パーツ名02',
		'cost'=>'1200',
		'note'=>'備考2'
	],
	[
		'id'=>'0000000003',
		'name'=>'パーツ名03',
		'cost'=>'1300',
		'note'=>'備考3'
	],
	[
		'id'=>'0000000004',
		'name'=>'パーツ名04',
		'cost'=>'1400',
		'note'=>'備考4'
	],
	[
		'id'=>'0000000005',
		'name'=>'パーツ名05',
		'cost'=>'1500',
		'note'=>'備考5'
	],
];

$category_page = "category01";

$img_base = $this->Url->build("/img");
?>

<h2 class="h2-type1"><?= $product_name ?></h2>

<div class="parts-image">
	<img src="<?= $img_base?>/drill.png">
</div>

<?= $this->Element('sell/step1_table',compact('parts','product_name','category_page'))?>

