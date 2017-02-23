<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;

class DebugController extends AppController {

	public function index() {
		$table = TableRegistry::get('sells');

		$table->query()
				->delete()
				->where(['created <' => Date::today()])
				->execute();
		$data = 1;
		$this->set('data', $data);
		$this->render('/Common/debug');
	}

	public function error() {
		
	}

}
