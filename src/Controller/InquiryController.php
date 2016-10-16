<?php

namespace App\Controller;

use App\Defines\Defines;
use App\Form\InquiryForm;
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
		$this->_filePath = Defines::INQUIRY_PATH;
	}
	
	protected function _getForm(){
		return new InquiryForm;
	}
	
	
}
