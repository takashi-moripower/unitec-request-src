<?php
use App\Defines\Defines;

$junle = NULL;
foreach( $categories as $category ):
	if( $junle != $category[ Defines::CATEGORY_JUNLE ]){
		if( $junle != NULL ){
			echo "</div>";
		}
		$junle = $category[ Defines::CATEGORY_JUNLE];
		echo "<h2>{$junle}</h2>";
		echo "<div class='row'>";
	}
	$url = $this->Url->build(['action'=>'step52']);
	echo "<a class='btn btn-default col-xs-3' href='{$url}'>{$category[Defines::CATEGORY_NAME]}</a>";
endforeach;
