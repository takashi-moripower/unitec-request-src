<?php

use App\Defines\Defines;

$access_name = Defines::ACCESS_NAME;
?>
<ul class="my-list1">
	<li>
		以下の入力内容で送信します。誤りがある場合は「戻る」ボタンで戻って修正してください
	</li>
</ul>

購入内容
<table class="table table-bordered">
	<thead>
		<tr>
			<td>品名</td>
			<td>単価</td>
			<td>数量</td>
			<td>小計</td>
		</tr>
		<?php
		$postage = $data[Defines::SELL_DATA_POSTAGE];
		$sum_all = 0;
		foreach ($parts as $p):
			$sum = $p['cost'] * $p['count'];
			$sum_all += $sum;
			?>
			<tr>
				<td><?= $p['id'] ?>  <?= $p['name'] ?></td>
				<td class="text-right">￥<?= number_format($p['cost']) ?></td>
				<td class="text-center"> <?= $p['count'] ?></td>
				<td class="text-right">￥<?= number_format($sum) ?></td>
			</tr>
			<?php
		endforeach;
		?>
		<tr>
			<td colspan="3">購入額計</td>
			<td class="text-right">￥<?= number_format($sum_all) ?></td>
		</tr>
		<tr>
			<td colspan="3">送料</td>
			<td class="text-right">￥<?= number_format($postage) ?></td>
		</tr>
		<tr>
			<td colspan="3">消費税</td>
			<td class="text-right">￥<?= number_format(floor(($sum_all + $postage) * 0.08)) ?></td>
		</tr>
		<tr>
			<td colspan="3">合計</td>
			<td class="text-right">￥<?= number_format(floor(($sum_all + $postage) * 1.08)) ?></td>
		</tr>
	</thead>
</table>
<ul class="my-list1">
	<li>
		ヤマト運輸による代金引換になります
	</li>
</ul>

<div class="text-center">
	<a href="<?= $this->Url->build(['action' => 'step0']) ?>" class="my-btn">戻る</a>
	<a href="<?= $this->Url->build(['action' => 'step7']) ?>" class="my-btn my-btn-primary"　>送信する</a>
</div>
