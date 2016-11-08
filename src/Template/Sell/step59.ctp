<?php

use App\Defines\Defines;

$access_name = Defines::ACCESS_NAME;

$s = $this->request->session();
$sell = $s->read('sell.data');
$sum_all = 0;
$code = $sell[Defines::SELL_DATA_CODE];
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
				<th>お名前</th>
				<td><?= $sell[Defines::SELL_DATA_NAME1] ?> <?= $sell[Defines::SELL_DATA_NAME2] ?></td>
			</tr>
			<tr>
				<th>フリガナ</th>
				<td><?= $sell[Defines::SELL_DATA_KANA_NAME1] ?> <?= $sell[Defines::SELL_DATA_KANA_NAME2] ?></td>
			</tr>
			<tr>
				<th>住所</th>
				<td>〒<?= $sell[Defines::SELL_DATA_POST_CODE] ?><br><?= $sell[Defines::SELL_DATA_ADDRESS] ?></td>
			</tr>
			<tr>
				<th>連絡手段</th>
				<td><?= Defines::accessText($sell[Defines::SELL_DATA_ACCESS]) ?></td>
			</tr>
			<tr>
				<th>電話番号</th>
				<td><?= $sell[Defines::SELL_DATA_TEL] ?></td>
			</tr>
			<tr>
				<th>FAX</th>
				<td><?= $sell[Defines::SELL_DATA_FAX] ?></td>
			</tr>
			<tr>
				<th>E-mail</th>
				<td><?= $sell[Defines::SELL_DATA_EMAIL] ?></td>
			</tr>
			<tr>
				<th>連絡メモ</th>
				<td><pre><?= $sell[Defines::SELL_DATA_CONTENT] ?></pre></td>
			</tr>

		</tbody>
	</table>
</div>
<div class="panel panel-default">
	<div class="panel-heading">ご購入内容</div>	
	<table class="table table-bordered">
		<thead>
			<tr>
				<th class="text-center">部品番号</th>
				<th class="text-center">部品名</th>
				<th class="text-center">価格</th>
				<th class="text-center">個数</th>
				<th class="text-center">小計</th>
			</tr>	
		</thead>
		<tbody>
			<?php
			foreach ($parts as $p):
				$sum = $p['cost'] * $p['count'];
				$sum_all += $sum;
				?>
				<tr>
					<td><?= $p['id'] ?></td>
					<td><?= $p['name'] ?></td>
					<td class="text-right"><i class="fa fa-jpy"></i><?= number_format($p['cost']) ?></td>
					<td class="text-right"><?= $p['count'] ?></td>
					<td class="text-right"><i class="fa fa-jpy"></i><?= number_format($sum) ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			<tr>
				<td>小計</td>
				<td colspan="4" class="text-right"><i class="fa fa-jpy"></i><?= number_format($sum_all) ?></td>
			</tr>
			<tr>
				<td>消費税</td>
				<td colspan="4" class="text-right"><i class="fa fa-jpy"></i><?= number_format($sum_all * 0.08) ?></td>
			</tr>
			<tr>
				<td>合計</td>
				<td colspan="4" class="text-right"><i class="fa fa-jpy"></i><?= number_format($sum_all * 1.08) ?><br>(送料については別途ご連絡いたします)</td>
			</tr>
		</tfoot>
	</table>

</div>

<div class="text-center">
<?php if(false): ?>
	<a href="<?= $this->Url->build(['action' => 'step53']) ?>" class="my-btn">戻る</a>
<?php endif ?>
	<a href="javascript:history.back();" class="my-btn">戻る</a>
	<a href="<?= $this->Url->build(['action'=>'step6',$code])?>" class="my-btn my-btn-primary"　>送信する</a>
</div>
