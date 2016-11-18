<?php 
echo $this->Form->create(NULL,['url'=>['controller'=>'debug','action'=>'getData']]);
echo $this->Form->submit('submit');
echo $this->Form->end() ;
?>