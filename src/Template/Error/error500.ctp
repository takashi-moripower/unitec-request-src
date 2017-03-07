<?php
use Cake\Core\Configure;
if( Configure::read('debug')){
	echo $this->Element('../Error/error500.old');
}
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 right-main">
			<h1>500 ERROR - Internal Server Error</h1>

			<p>
				サーバーがエラーを検出したため、実行することができませんでした。<br>
				しばらく時間をおいてからもう一度アクセスして頂くか、管理者にお問い合わせください。<br>
				<br>
				<img src="<?= $this->Url->build('/img/email.png') ?>" class="email-img">
			</p>
		</div>
	</div>
</div>
