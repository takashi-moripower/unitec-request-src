<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Repair Controller
 *
 * @property \App\Model\Table\RepairTable $Repair
 */
class RepairController extends AppController {

	public function initialize() {
		$this->viewBuilder()->layout('repair');
	}

	public function index() {
		return $this->redirect(['action' => 'step0']);
	}

	public function step0() {
		
	}

	public function step1() {
		
	}

	public function step2() {
		
	}

	public function step3() {
		
	}

}
