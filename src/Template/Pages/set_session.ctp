<?php
$this->request->session()->write('data','this is a pen');

$data = $this->request->session()->read('data');
echo $data;