<?= $this->append('script',$this->Html->script('sell'))?>
<h2 class="h2-type1">1400010 コンパクト高速ドリル</h2>

<div class="parts-image">
	<img src="../img/drill.png">
</div>
<?= $this->Form->create(NULL, ['url' => $this->Url->build(['action' => 'step59'], 1)]) ?>
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
		$items = [];
		
		$items[] = [
			'id'=>'00000001',
			'name'=>'部品001',
			'cost'=>1000,
			'note'=>'備考01',
		];

		$items[] = [
			'id'=>'00000002',
			'name'=>'部品002',
			'cost'=>2000,
			'note'=>'備考02',
		];
		
		$items[] = [
			'id'=>'00000003',
			'name'=>'部品003',
			'cost'=>3000,
			'note'=>'備考03',
		];
		
		foreach( $items as $i => $item ){
			echo $this->Element('sell/parts',['item'=>$item,'i'=>$i ]);
		}
		?>
		
	</tbody>
</table>
<div class="text-center">
	<a href="<?= $this->Url->build(['action' => 'step52']) ?>" class="my-btn">戻る</a>
	<button class="my-btn my-btn-primary" type="submit" >購入依頼</button>
</div>
<?= $this->Form->end() ?>
