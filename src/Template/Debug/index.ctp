<?php
$urls = [];
$urls[] = ['controller' => 'pages', 'action' => 'display', 'home'];
$urls[] = ['controller' => 'pages', 'action' => 'display', 'cat01'];
$urls[] = ['controller'=>'sell','action'=>'index'];

?>

<ul>
<?php
foreach( $urls as $url ){
	echo "<li>";
	echo $this->Html->link( $this->Url->build($url),$url);
	echo "</li>";
}?>	
</ul>
