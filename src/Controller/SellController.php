<?php

namespace App\Controller;

use App\Defines\Defines;
use App\Form\SellForm;
use SplFileObject;
use Cake\ORM\TableRegistry;

/**
 * Repair Controller
 *
 * @property \App\Model\Table\RepairTable $Repair
 */
class SellController extends BaseController {

	public function initialize() {
		parent::initialize();
		$this->loadComponent('SaveCsv');
		$this->viewBuilder()->layout('progress');
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
				$this->request->session()->write('sell.data', $data3);
				$this->request->session()->write('sell.token', $token);
				return $this->redirect(['action' => 'step51']);
			}
		}

		$entity = $this->_checkToken($token);

		if (!$entity) {
			$this->Flash->errors('invalid access 1');
			return $this->redirect('/');
		}

		$this->set('id', $entity->id);

		$this->set(compact('email', 'form'));
	}

	public function step51() {
		$categories = $this->_getCategories();
		$this->set(compact('categories'));
	}

	public function step52() {
		
	}

	public function step53() {
		
	}

	public function step59() {
		if (!$this->request->is('post', 'put', 'patch')) {
			$this->Flash->error('invalid access');
			return $this->redirect('/');
		}

		$session = $this->request->session();
		$token = $session->read('sell.token');
		$code = $session->read('sell.data.'. Defines::SELL_DATA_CODE);
		
		$parts_post = $this->request->data['parts'];

		if (!$token || !$this->_checkToken($token, false)) {
			$this->render('step5_error');
			return;
		}

		foreach ($parts_post as $p) {
			//	パーツデータの先頭に注文コードを付与
			array_unshift( $p ,  $code );
			if ($p['count'] > 0) {
				$parts_valid[] = $p;
			}
		}
		
		$this->set('referer' , $this->referer(['controller'=>'sell','action'=>'step51']));

		$this->set('parts', $parts_valid);
		$this->request->session()->write('sell.parts', $parts_valid);
	}

	public function step6() {
		$session = $this->request->session();
		$parts = $session->read('sell.parts');
		$data = $session->read('sell.data');
		$token = $session->read('sell.token');

		if (!$token || !$this->_checkToken($token, false)) {
			$this->render('step5_error');
			return;
		}

		$this->_saveData($data);
		$this->_saveParts($data, $parts);
		$this->_postComplete($data, $parts);

		$this->_removeToken($token);
		$session->write('sell', NULL);
		$this->set('code', $data[Defines::REPAIR_DATA_CODE]);

//		$this->set('code', $code);
	}

	protected function _saveData($data) {
		$csv = $this->SaveCsv->getBody($data);
		$filename = $data[Defines::SELL_DATA_CODE] . '.csv';

		try {
			$f = fopen($this->_filePath . $filename, 'w+');
			fwrite($f, $csv);
			fclose($f);
		} catch (Exception $ex) {
			$this->flash->error('file can not open');
			return $this->redirect('/');
		}
	}

	protected function _saveParts($data, $parts) {

		$csv = $this->SaveCsv->getBody2($parts);
		$filename = $data[Defines::SELL_DATA_CODE] . '.csv';
		$path = Defines::SELL_PARTS_PATH;

		try {
			$f = fopen($path . $filename, 'w+');
			fwrite($f, $csv);
			fclose($f);
		} catch (Exception $ex) {
			$this->flash->error('file can not open');
			return $this->redirect('/');
		}
	}

	protected function _removeToken($token) {
		$table = \Cake\ORM\TableRegistry::get('sells');
		$entity = $table->find()
				->where(['token' => $token])
				->first();
		if ($entity) {
			$entity->token = NULL;
			$table->save($entity);
		}
	}

	protected function _postComplete($data, $parts) {
		
		$template = Defines::MAIL_TEMPLATE_SELL_COMPLETE;
		
		$template['subject'] .= sprintf('（受付番号:%s）', $data[Defines::SELL_DATA_CODE]);

		$emailObj = new \Cake\Network\Email\Email($template);
		$emailObj
				->viewVars(compact('data', 'parts'))
				->to($data[Defines::SELL_DATA_EMAIL])
				->send();
	}
	
	public function debug(){
		$ne = TableRegistry::get('sells')->newEntity();
		
		$this->viewBuilder()->layout('default');
		
		$this->set('data',$ne->source());
		$this->render('/Common/debug');
	}

}
