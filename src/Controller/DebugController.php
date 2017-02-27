<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use Cake\I18n\Time;

class DebugController extends AppController {

	public function index() {

		$table = TableRegistry::get('sells');

		
		$c1 = $table->find()
				->where([
					'created >' => Date::today(),
					'created <=' => Date::tomorrow(),
				])
				->count();
/*		
		$c2 = $table->find()
				->where([
					'created >' => Time::today(),
					'created <=' => Time::tomorrow(),
				])
				->count();
		
		$s = Time::Today();
		$s = $s->addHours(9);
		
		$e = Time::Tomorrow();
		$e = $e->addHours(9);
		$c3 = $table->find()
				->where([
					'created >' => $s,
					'created <=' => $e,
				])
				->count();

*/		
		
		$data =[
			$c1,
/*			$c2,
			$c3,
			$s == Time::today(),
			$e == Time::tomorrow(),
			$s == Date::today(),
			$e == Date::tomorrow(),
*/		] ;
		$this->set('data', $data);
		$this->render('/Common/debug');
	}

	public function error() {
		
	}
	
	public function create(){
		$table = TableRegistry::get('sells');
		
		for( $i = 0 ; $i<24 ; $i++){
			$e = $table->newEntity();
			$e->created = new Time;
			$e->created = $e->created->addHours($i);
			$e->sereal = $i;
			$table->save($e);
		}
		
		$this->render('/Common/debug');
	}

}
