<?php
use App\Defines\Defines;

echo $this->Element('repair/personalInfo');

?>
<div class="text-center">
	<a href="<?= $this->Url->build(['action' => 'step5']) ?>" class="my-btn my-btn-primary">
		<i class="fa fa-caret-right"></i> 合意する
	</a>	
</div>