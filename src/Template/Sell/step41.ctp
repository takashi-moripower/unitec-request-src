<div class="message">
	<?= $email ?> 様<br>
アドレスを確認しました。<br>
下部リンクより物品購入受付を行ってください。
</div>

<div class="text-center">
	<a href="<?= $this->Url->build(['controller'=>'sell','action'=>'step5',urlencode( $email ) , $token ])?>" class="my-btn my-btn-primary">物品購入受付</a>
</div>

