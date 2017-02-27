<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;

class DebugController extends AppController {

	public function index() {
		
		$data = [
			Date::today(),
			Date::tomorrow(),
			Date::yesterday(),
		];
		
		$this->set('data', $data);
		$this->render('/Common/debug');
	}

	public function error() {
		
	}

}
