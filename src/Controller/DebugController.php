<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class DebugController extends AppController{
	public function index(){
		$table = TableRegistry::get('postages');
		
		$result = $table->find()
				->where(['pref'=>'新潟県'])
				->select('charge')
				->hydrate(0)
				->first();
		
		$this->set('data',$result);
		$this->render('/Common/debug');
	}
}