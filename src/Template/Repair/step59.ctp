<?php

use App\Defines\Defines;

$access_name = Defines::ACCESS_NAME;
?>
<ul class="my-list1">
	<li>
		以下の入力内容で送信します。誤りがある場合は「戻る」ボタンで戻って修正してください
	</li>
</ul>
<div class="panel panel-default">
	<div class="panel-heading">お客様情報</div>	
	<table class="table table-bordered">
		<tbody>
			<tr>
				<th class="col-xs-3">お名前</th>
				<td class="col-xs-9"><?= $data[Defines::REPAIR_DATA_NAME1] ?> <?= $data[Defines::REPAIR_DATA_NAME2] ?></td>
			</tr>
			<tr>
				<th>フリガナ</th>
				<td><?= $data[Defines::REPAIR_DATA_KANA_NAME1] ?> <?= $data[Defines::REPAIR_DATA_KANA_NAME2] ?></td>
			</tr>
			<tr>
				<th>住所</th>
				<td>〒<?= $data[Defines::REPAIR_DATA_POST_CODE] ?><br><?= $data[Defines::REPAIR_DATA_ADDRESS] ?></td>
			</tr>
			<tr>
				<th>連絡手段</th>
				<td><?= Defines::accessText($data[Defines::REPAIR_DATA_ACCESS]) ?></td>
			</tr>
			<tr>
				<th>電話番号</th>
				<td><?= $data[Defines::REPAIR_DATA_TEL] ?></td>
			</tr>
			<tr>
				<th>FAX</th>
				<td><?= $data[Defines::REPAIR_DATA_FAX] ?></td>
			</tr>
			<tr>
				<th>E-mail</th>
				<td><?= $data[Defines::REPAIR_DATA_EMAIL] ?></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="panel panel-default">
	<div class="panel-heading">商品情報</div>	
	<table class="table table-bordered">
		<tbody>
			<tr>
				<th class="col-xs-3">商品情報</th>
				<td class="col-xs-9"><pre><?= $data[Defines::REPAIR_DATA_PRODUCT] ?></pre></td>
			</tr>
			<tr>
				<th>購入日</th>
				<td>
					<?= empty($data[Defines::REPAIR_DATA_BUY_YEAR]) ? '?' : $data[Defines::REPAIR_DATA_BUY_YEAR] ?>年
					<?= empty($data[Defines::REPAIR_DATA_BUY_MONTH]) ? '?' : $data[Defines::REPAIR_DATA_BUY_MONTH] ?>月
				</td>
			</tr>
			<tr>
				<th>故障内容</th>
				<td><pre><?= $data[Defines::REPAIR_DATA_CONTENT] ?></pre></td>
			</tr>

		</tbody>
	</table>
</div>

<?=
$this->Element('repair/back59');
