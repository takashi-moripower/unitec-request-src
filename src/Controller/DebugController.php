<?php
namespace App\Controller;

use App\Controller\AppController;

class DebugController extends AppController{
	public function index(){
		
	}
	
	public function getData(){
		debug( $this->referer() );
	}
}