<?php

namespace App\Controller;

use App\Defines\Defines;
use App\Form\InquiryForm;
use Cake\Core\Configure;
/**
 * Repair Controller
 *
 * @property \App\Model\Table\RepairTable $Repair
 */
class InquiryController  extends BaseController {

	public function initialize() {
		parent::initialize();
		$this->loadComponent('SaveCsv');
		$this->viewBuilder()->layout('progress');
		$this->_filePath = Configure::read('data_dir') . Defines::INQUIRY_PREFIX . '/';
	}
	
	protected function _getForm(){
		return new InquiryForm;
	}
	
	
}
