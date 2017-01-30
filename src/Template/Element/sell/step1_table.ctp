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
		foreach( $parts as $part ):
			$id = $part['id'];
			$name = $part['name'];
			$cost = $part['cost'];
			$note = $part['note'];
			?>
			<tr>
				<th class="check text-center"><i class="fa fa-square-o fa-fw fa-2x"</th>
				<td><?= $id ?><?= $this->Form->hidden("parts.{$id}.id", ['value' => $id]) ?></td>
				<td><?= $name ?><?= $this->Form->hidden("parts.{$id}.name", ['value' => $name]) ?></td>
				<td class="text-right"><?= $cost ?><?= $this->Form->hidden("parts.{$id}.cost", ['value' => $cost]) ?></td>
				<td><?= $this->Form->select("parts.{$id}.count",range(0,99),['class'=>'count']) ?></td>
				<td><?= $note ?><?= $this->Form->hidden("parts.{$id}.note", ['value' => $note]) ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<div class="text-center">
	<a href="<?= $this->Url->build(['action' => 'step01' , $category_page ]) ?>" class="my-btn">戻る</a>
	<button class="my-btn my-btn-primary" type="submit" >購入依頼</button>
</div>
<?= $this->Form->end() ?>

<?= $this->append('script',$this->Html->script('sell'))?>
