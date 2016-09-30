
<div class="panel panel-default">
	<div class="panel-body">
		<?= $this->Form->create() ?>
		<?= $this->Form->input('name',['type'=>'text']) ?>
		<?= $this->Form->input('kana-name',['type'=>'text']) ?>
		<?= $this->Form->input('post-code',['type'=>'text']) ?>
		<?= $this->Form->input('address',['type'=>'text']) ?>
		<?= $this->Form->radio('access',['メール','電話','FAX']) ?>
		<?= $this->Form->input('email',['type'=>'text','value'=>$email]) ?>
		<?= $this->Form->input('tel',['type'=>'text']) ?>
		<?= $this->Form->input('fax',['type'=>'text']) ?>
		<?= $this->Form->input('product',['type'=>'text']) ?>
		<?= $this->Form->input('date',['type'=>'date']) ?>
		<?= $this->Form->textArea('content') ?>
		
		<?= $this->Form->submit('送信') ?>
		<?= $this->Form->end() ?>
	</div>
</div>
