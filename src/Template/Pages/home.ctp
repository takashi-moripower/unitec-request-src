<?php
$this->append('script');
echo $this->Html->script('sideHeight');
$this->end();
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 right-main">
			<h1>Home</h1>

			<ul class="my-list1"> 
				<li>
					<?= $this->Html->link('修理', ['controller' => 'repair', 'action' => 'step0']) ?>
				</li>
				<li>
					<?= $this->Html->link('問合せ', ['controller' => 'inquiry', 'action' => 'step0']) ?>
				</li>
				<li>
					<?= $this->Html->link('部品購入', ['controller' => 'sell', 'action' => 'step0']) ?>
				</li>
			</ul>

			<hr>
			<ul class="my-list1"> 
				<li>
					<?= $this->Html->link('サイト運営に関する免責事項',['controller'=>'pages', 'action'=>'display','site_policy'] ) ?>
				</li>
			</ul>

			20170124

		</div>
	</div>
</div>