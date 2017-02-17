<?php

namespace App\Controller;

use App\Defines\Defines;
use App\Form\RepairForm;
use Cake\Core\Configure;

/**
 * Repair Controller
 *
 * @property \App\Model\Table\RepairTable $Repair
 */
class RepairController  extends BaseController {

	public function initialize() {
		parent::initialize();
		$this->loadComponent('SaveCsv');
		$this->viewBuilder()->layout('progress');
		$this->_filePath = Configure::read('data_dir') . Defines::REPAIR_PREFIX . '/';
	}
	
	protected function _getForm(){
		return new RepairForm;
	}
}
