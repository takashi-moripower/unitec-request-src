<?= $this->append('script',$this->Html->script('sell'))?>
<h2 class="h2-type1">1400010 コンパクト高速ドリル</h2>

<div class="parts-image">
	<img src="<?= $this->Url->build('/img/drill.png')?>">
</div>
<?= $this->Form->create(NULL, ['url' =>  ['action' => 'step19']]) ?>
<table class="table table-bordered table-parts">
	<thead>
		<tr>
			<th>
				
			</th>
			<th class="text-center">
				部品番号
			</th>
			<th class="text-center">
				部品名
			</th>
			<th class="text-center">
				単価
			</th>
			<th class="text-center">
				数量
			</th>
			<th class="text-center">
				備考
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
		for ($i = 1; $i <= 10; $i++):
			$id = sprintf('000000%02d', $i);
			$name = sprintf('部品%02d', $i);
			$cost = $i * 1000;
			$note = sprintf('備考%02d', $i);
			?>
			<tr>
				<th class="check text-center"><i class="fa fa-square-o fa-fw fa-2x"</th>
				<td><?= $id ?><?= $this->Form->hidden("parts.{$i}.id", ['value' => $id]) ?></td>
				<td><?= $name ?><?= $this->Form->hidden("parts.{$i}.name", ['value' => $name]) ?></td>
				<td class="text-right"><?= $cost ?><?= $this->Form->hidden("parts.{$i}.cost", ['value' => $cost]) ?></td>
				<td><?= $this->Form->select("parts.{$i}.count",range(0,99),['class'=>'count']) ?></td>
				<td><?= $note ?><?= $this->Form->hidden("parts.{$i}.note", ['value' => $note]) ?></td>
			</tr>
		<?php endfor ?>
	</tbody>
</table>
<div class="text-center">
	<a href="<?= $this->Url->build(['action' => 'step01']) ?>" class="my-btn">戻る</a>
	<button class="my-btn my-btn-primary" type="submit" >購入依頼</button>
</div>
<?= $this->Form->end() ?>
