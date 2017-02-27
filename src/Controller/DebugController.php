<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use Cake\I18n\Time;

class DebugController extends AppController {

	public function index() {

		$table = TableRegistry::get('sells');
		
		
		$d1 = Date::today();
		$d2 = Date::tomorrow();

		$d3 = Time::today();
		$d4 = Time::tomorrow();
		
		$c1 = $table->find()
				->where([
					'created >' => $d1,
					'created <=' => $d2,
				])
				->count();
		$c2 = $table->find()
				->where([
					'created >' => $d3,
					'created <=' => $d4,
				])
				->count();
		
		$data =[
			$c1,
			$c2,
			$d1,
			$d3,
			($d1 > $d3) ? 't' : 'f',
		] ;
		$this->set('data', $data);
		$this->render('/Common/debug');
	}

	public function error() {
		
	}

}
