<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Utils\AppUtility;
use Cake\ORM\TableRegistry;
/**
 * Repair Controller
 *
 * @property \App\Model\Table\RepairTable $Repair
 */
class HomeController extends AppController {

	public function initialize() {
		parent::initialize();
	}
	
	public function index(){
		$this->Flash->error('flash from index');
		return $this->redirect(['action'=>'test']);
	}
	
	public function test(){
		//$this->Flash->error('flash from test');
	}
	
}
