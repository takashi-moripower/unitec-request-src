
<div class="message">
	ご入力のメールアドレス宛に確認メールを送信いたします。
	メールの内容をご確認のうえ、メール本文に記載のお申込みURLをクリックして　お申し込みの続きを進めてください
</div>

<?= $this->Form->create( $form ) ?>
<table class="my-form">
	<tbody>
		<tr>
			<th class="requied">
				E-mail
			</th>
			<td>
				<?= $this->Form->input('email', ['type' => 'email' , 'label'=>false]) ?>
				<?= $this->Form->input('email2', ['type' => 'email' , 'label'=>false , 'placeholder'=>'※確認のため　もう一度コピーせずに入力してください']) ?>
			</td>
		</tr>
	</tbody>
</table>
<br>
<div class="text-center">
	<a href="<?= $this->Url->build('/') ?>" class="my-btn">戻る</a>
	<button class="my-btn my-btn-primary"　type="submit" >送信</button>
</div>
<?= $this->Form->end() ?>
		
