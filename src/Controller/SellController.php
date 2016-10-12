<?php

namespace App\Controller;

use App\Defines\Defines;
use App\Form\SellForm;
use SplFileObject;

/**
 * Repair Controller
 *
 * @property \App\Model\Table\RepairTable $Repair
 */
class SellController extends BaseController {

	public function initialize() {
		parent::initialize();
		$this->loadComponent('SaveCsv');
		$this->viewBuilder()->layout('sell');
		$this->_filePath = Defines::SELL_PATH;
	}

	protected function _getForm() {
		return new SellForm;
	}

	protected function _getCategories() {
		$file = fopen(Defines::DATA_FILE_CATEGORIES, 'r+');
		while (true) {
			$data = fgetcsv($file);
			if (empty($data)) {
				break;
			}
			if (strpos($data[0], '#') === 0) {
				continue;
			}
			$records[] = $data;
		}
		fclose($file);

		return $records;
	}

	public function step5($email = NULL, $token = NULL) {
		$form = $this->_getForm();

		if ($this->request->is('post')) {
			$data = $this->request->data;

			$data3 = $form->execute($data);

			if ($data3 !== false) {
				$this->request->session()->delete('sell');
				$this->request->session()->write('sell.data',$data3);
				$this->request->session()->write('sell.token',$token);
				return $this->redirect(['action' => 'step51']);
			}
		}

		$entity = $this->_checkToken($token);

		if (!$entity) {
			$this->Flash->errors('invalid access 1');
			return $this->redirect('/');
		}
		
		$this->set('id',$entity->id);

		$this->set(compact('email', 'form'));
	}
	
	public function step51(){
		$categories = $this->_getCategories();
		$this->set( compact( 'categories'));
	}
	
	public function step52(){
		
	}

}
