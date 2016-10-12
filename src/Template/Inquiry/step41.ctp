<div class="message">
	<?= $email ?> 様<br>
アドレスを確認しました。<br>
下部リンクより問合せ受付を行ってください。
</div>

<div class="text-center">
	<a href="<?= $this->Url->build(['controller'=>'inquiry','action'=>'step5',urlencode( $email ) , $token ])?>" class="my-btn my-btn-primary">問合せ受付</a>
</div>

