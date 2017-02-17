<?php

use App\Defines\Defines;

$this->append('script');
echo $this->Html->script('https://yubinbango.github.io/yubinbango/yubinbango.js');
$this->end();

$template_date = '<div>{{year}}　年　{{month}}　月</div>';
$template_radio = '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}><div class="my-radio"></div>';
echo $this->Form->create($form, ['class' => 'h-adr']);
$this->Form->templates([
	'radio' => $template_radio
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

				<?= $this->Form->input('address1', ['type' => 'text', 'label' => false, 'class' => 'p-region', 'placeholder' => '都道府県']); ?><br>
				<?= $this->Form->input('address2', ['type' => 'text', 'label' => false, 'class' => 'p-locality p-street-address p-extended-address', 'placeholder' => '市町村・番地・建物']); ?>
			</td>
		</tr>
		<tr>
			<th class="requied">
				連絡手段
			</th>
			<td class="my-form-check">
				<?php
				$access_error = !empty($form->errors()['access']);
				$access_types = \App\Defines\Defines::ACCESS_NAME;
				?>
				<div class="form-group <?= $access_error ? 'has-error' : '' ?>">
					<?php
					echo $this->Form->select('access', $access_types, ['multiple' => 'checkbox', 'default' => Defines::ACCESS_DEFAULT]);

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
			<th class="requied">
				E-mail
			</th>
			<td>
				<?php
				echo $this->Form->input('email', ['type' => 'email', 'label' => false, 'class' => '',]);
				?>				
			</td>
		</tr>
		<tr>
			<th class="requied">
				TEL
			</th>
			<td>
				<?php
				echo $this->Form->input('tel', ['type' => 'tel', 'label' => false, 'class' => '']);
				?>				
			</td>
		</tr>
		<tr>
			<th>
				FAX
			</th>
			<td>
				<?php
				echo $this->Form->input('fax', ['type' => 'fax', 'label' => false, 'class' => '']);
				?>				
			</td>
		</tr>
		<tr>
			<th class="">
				連絡メモ<br>
			</th>
			<td>
				<?= $this->Form->input('content', ['type' => 'textArea', 'placeHolder' => '2000文字以内で入力してください', 'label' => false]); ?>
				<br>
			</td>
		</tr>
	</tbody>
</table>
<br>
<div class="text-center">

	<button class="my-btn my-btn-primary"　type="submit" >次へ</button>
	<?php
	echo $this->Form->end();
	?>
</div>
<br>

