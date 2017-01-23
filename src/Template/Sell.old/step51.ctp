<?php

use App\Defines\Defines;


for ($j = 0; $j < 4; $j ++) {
	$junle_name = "ジャンル".($j+1);
	echo "<div class='row'>";
	echo "<h2>{$junle_name}</h2>";
	for ($c = 0; $c < 10; $c++) {
		$url = $this->Url->build(['action'=>'step52']);
		$cat_name = "カテゴリ".($j * 10 + $c+1);
		echo "<a class='btn btn-default col-xs-3' href='{$url}'>{$cat_name}</a>";
	}
	echo "</div>";
}
return;
foreach ($categories as $category):
	if ($junle != $category[Defines::CATEGORY_JUNLE]) {
		if ($junle != NULL) {
			echo "</div>";
		}
		$junle = $category[Defines::CATEGORY_JUNLE];
		echo "<h2>{$junle}</h2>";
		echo "<div class='row'>";
	}
	$url = $this->Url->build(['action' => 'step52']);
	echo "<a class='btn btn-default col-xs-3' href='{$url}'>{$category[Defines::CATEGORY_NAME]}</a>";
endforeach;
