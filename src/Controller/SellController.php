<?php

namespace App\Controller;

use App\Defines\Defines;
use App\Form\SellForm;
use SplFileObject;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

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
		$this->_filePath = Configure::read('data_dir') . Defines::SELL_PREFIX . '/';
	}

	protected function _getForm() {
		return new SellForm;
	}

	public function step0() {
		
	}

	public function step01($src = '') {
		$this->set('src', $src);
	}

	public function step1($src = '') {
		$this->set('src', $src);
		$this->set('img_base', Configure::read('templates.img_base'));

		$this->request->session()->write('sell.product_page', $src);
	}

	public function step19() {
		if (!$this->request->is('post', 'put', 'patch')) {
			$this->Flash->error('invalid access');
			return $this->redirect('/');
		}

		$parts_post = $this->request->data['parts'];
		$parts_valid = [];

		foreach ($parts_post as $p) {
			if ($p['count'] > 0) {
				$parts_valid[] = $p;
			}
		}

		$this->request->session()->write('sell.parts', $parts_valid);

		return $this->redirect(['action' => 'step2']);
	}

	public function step3() {
		
	}

	public function step4($arg = NULL) {
		
	}

	public function step5($arg1 = NULL, $arg2 = NULL) {

		$form = new SellForm();
		$form->readSession($this->request->session());

		$this->set('form', $form);

		if ($this->request->is('post')) {
			return $this->_step51();
		}
	}

	protected function _step51() {
		$table = TableRegistry::get("Sells");
		$entity = $table->newEntity();

		$form = new SellForm();
		$form->setEntity($entity);

		$data = $form->execute($this->request->data);

		//フォーム入力が不正だった場合
		if (empty($data)) {
			$this->set('form', $form);
			return;
		}

		$parts = $this->request->session()->read('sell.parts');

		//パーツデータが存在しない＝「戻る」で無理やり移動したパターン？
		if (empty($parts)) {
			$this->render('step5_error');
			return;
		}

		$this->request->session()->write('sell.data', $data);

		$this->redirect(['action' => 'step6']);
	}

	public function step6() {
		$parts = $this->request->session()->read('sell.parts');
		$data = $this->request->session()->read('sell.data');
		$product_page = $this->request->session()->read('sell.product_page');

		if (empty( $parts) || empty($data)) {
			return $this->render('step5_error');
		}
		
		$this->set('parts', $parts);
		$this->set('data', $data);
		$this->set('product_page', $product_page);
	}

	public function step7() {
		if (!$this->_save()) {
			return $this->render('step5_error');
		}

		$data = $this->request->session()->read('sell.data');
		$code = $data[Defines::SELL_DATA_CODE];
		$this->set('code', $code);

		$this->request->session()->write('sell', NULL);
	}

	protected function _save() {
		$data = $this->request->session()->read('sell.data');
		$parts = $this->request->session()->read('sell.parts');

		if( empty( $data ) || empty($parts)){
			return false;
		}


		$entity = $this->_setToken();
		$code = $entity->code;
		$date = $entity->created->format('Y-m-d h:i:s');


		$data[Defines::SELL_DATA_CODE] = $code;
		$data[Defines::SELL_DATA_DATE] = $date;

		foreach ($parts as &$part) {
			//	パーツデータの先頭に注文コードを付与
			array_unshift($part, $code);
		}

		$this->_saveData($data);

		$this->_saveParts($data, $parts);

		$this->_postComplete($data, $parts);

		$this->request->session()->write('sell.data', $data);
		
		return true;
	}

	/**
	 * トークンをセットし、シリアルを入手
	 * @return type
	 */
	protected function _setToken() {
		$table = TableRegistry::get("sells");
		$entity = $table->newEntity();
		$entity->setSereal();
		$table->save($entity);

		return $entity;
	}

	protected function _saveData($data) {
		$csv = $this->SaveCsv->getBody($data);
		$filename = $data[Defines::SELL_DATA_CODE] . '.csv';

		$this->_checkPath($this->_filePath);

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
		$path = $this->_filePath . '/parts/';

		$this->_checkPath($path);

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

		$template = Defines::getTemplateComplete('sell');

		$template['subject'] .= sprintf('（受付番号:%s）', $data[Defines::SELL_DATA_CODE]);

		$emailObj = new \Cake\Network\Email\Email($template);
		$emailObj
				->viewVars(compact('data', 'parts'))
				->to($data[Defines::SELL_DATA_EMAIL])
				->send();
	}

}
