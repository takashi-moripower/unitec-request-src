<div class="message">
	<?= $email ?> 様<br>
アドレスを確認しました。<br>
下部リンクより修理受付を行ってください。
</div>

<div class="text-center">
	<a href="<?= $this->Url->build(['controller'=>'repair','action'=>'step5',urlencode( $email ) , $token ])?>" class="my-btn my-btn-primary">修理受付</a>
</div>

