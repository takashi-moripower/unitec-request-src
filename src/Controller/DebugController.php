<?php
namespace App\Controller;

use App\Controller\AppController;

class DebugController extends AppController{
	public function index(){
		
//		$result = mkdir("/tmp/cindy/data", 0777 , true );
//		chmod("/tmp/cindy/data" , 0777 );
//		$result = rmdir("/tmp/cindy/data");
//		$result = rmdir("/tmp/cindy");
		
		chmod("/tmp/cindy/data" , 0777 );
		chmod("/tmp/cindy" , 0777 );
		
		$this->set('data','success');
		$this->render('../Common/debug');
	}
}