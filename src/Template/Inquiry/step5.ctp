<?php
use App\Defines\Defines;
$this->append('script');
echo $this->Html->script('https://yubinbango.github.io/yubinbango/yubinbango.js');
$this->end();

$template_date = '<div>{{year}}　年　{{month}}　月</div>';
$template_radio = '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}><div class="my-radio"></div>';
echo $this->Form->create($form, ['class' => 'h-adr']);
echo $this->Form->hidden('id',['default'=>$id]);


$this->Form->templates([
	'radio'=>$template_radio
]);

?>
<input type="hidden" class="p-country-name" value="Japan">

<table class="my-form">
	<tbody>
		<tr>
			<th class="requied">
				お名前
			</th>
			<td class="my-form-name">
				<?php
				echo $this->Form->input('name1', ['type' => 'text', 'label' => false, 'class' => '']);
				echo $this->Form->input('name2', ['type' => 'text', 'label' => false, 'class' => '']);
				?>
				<span>※ 全角で入力してください。</span>
			</td>
		</tr>
		<tr>
			<th class="requied">
				お名前（カナ）
			</th>
			<td class="my-form-name">
				<?php
				echo $this->Form->input('kana-name1', ['type' => 'text', 'label' => false, 'class' => '']);
				echo $this->Form->input('kana-name2', ['type' => 'text', 'label' => false, 'class' => '']);
				?>
				<span>※ 全角で入力してください。</span>
			</td>
		</tr>
		<tr>
			<th class="requied">
				ご住所
			</th>
			<td class="my-form-address">
				<div class="post-icon">〒</div><?= $this->Form->input('post-code', ['type' => 'text', 'label' => false, 'class' => 'p-postal-code']); ?>
				<span> ※ ハイフンなしの半角数字7桁で入力してください。</span>

				<?= $this->Form->input('address', ['type' => 'text', 'label' => false, 'class' => 'p-region p-locality p-street-address p-extended-address']); ?>
			</td>
		</tr>
		<tr>
			<th>
				連絡手段
			</th>
			<td class="my-form-radio">
				<?php
				$access_error = !empty( $form->errors()['access'] );
				$access_types = [
					1 => 'メール',
					2 => '電話',
					3 => 'FAX'
				]
				?>
				<div class="form-group <?= $access_error ? 'has-error' : '' ?>">
					
					<?php
					echo $this->Form->radio('access', $access_types , ['default'=>1]);
					?>
					<?php if(false) : ?>
					<input type="radio" name="access" id="access-1" value="1" checked="checked" requied="reqied">
					<label for="access-1">メール</label>
					<input type="radio" name="access" id="access-2" value="2" requied="reqied">
					<label for="access-2">電話</label>
					<input type="radio" name="access" id="access-3" value="3" requied="reqied">
					<label for="access-3">FAX</label>
					<?php endif ?>
					<?php
					if ($access_error) {
						foreach ($form->errors()['access'] as $msg) {
							echo "<div class='help-block'>{$msg}</div>";
						}
					}
					?>
					<br>
					　※ 返信をご希望される連絡手段を選択してください。選択した連絡手段の項目は必須になります。
				</div>
			</td>
		</tr>
		<tr>
			<th>
				E-mail
			</th>
			<td>
				<?php
				echo $this->Form->input('email', ['type' => 'email', 'label' => false, 'class' => '' , 'readonly'=>'readonly' , 'value'=>$email]);
				?>				
			</td>
		</tr>
		<tr>
			<th>
				TEL
			</th>
			<td>
				<?php
				echo $this->Form->input('tel', ['type' => 'tel', 'label' => false, 'class' => '' ]);
				?>				
			</td>
		</tr>
		<tr>
			<th>
				FAX
			</th>
			<td>
				<?php
				echo $this->Form->input('fax', ['type' => 'fax', 'label' => false, 'class' => '' ]);
				?>				
			</td>
		</tr>
		<tr>
			<th>
				カテゴリ
			</th>
			<td>
				<?= $this->Form->select('category', Defines::INQUIRY_CATEGORIES ) ?>
				
			</td>
		</tr>
		<tr>
			<th class="requied">
				商品情報
			</th>
			<td class="product">
				<?php
				echo $this->Form->input('product', ['type' => 'fax', 'label' => false, 'class' => '' ]);
				?>
				<div class="comment">※ 商品名や型式、JANコードを入力してください。 JANコードとは</div>
			</td>
		</tr>
		<tr>
			<th class="requied">
				故障内容
			</th>
			<td>
				<?= $this->Form->textArea('content'); ?>
				<br>
			</td>
		</tr>
	</tbody>
</table>
<br>
<div class="text-center">

	<button class="my-btn my-btn-primary"　type="submit" >送信</button>
	<?php
	echo $this->Form->end();
	?>
</div>
<br>
