<?php
namespace App\Controller;

use App\Controller\AppController;

class DebugController extends AppController{
	public function index(){
		
//		$result = mkdir("/tmp/cindy/data", 0777 , true );
//		chmod("/tmp/cindy/data" , 0777 );
		$result = rmdir("/tmp/cindy/data");
		$result = rmdir("/tmp/cindy");
		
		$this->set('data',$result);
		$this->render('../Common/debug');
	}
}