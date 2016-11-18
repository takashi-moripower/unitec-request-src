<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Form\RepairForm;
use App\Form\EmailForm;
use App\Defines\Defines;
use Cake\Utility\Inflector;

/**
 * Repair Controller
 *
 * @property \App\Model\Table\RepairTable $Repair
 */
abstract class BaseController extends AppController {

	public function initialize() {
		parent::initialize();
	}

	abstract protected function _getForm();

	protected function _getTable() {
		return TableRegistry::get(Inflector::pluralize($this->name));
	}

	protected function _checkToken($token, $checkTime = true) {
		$table = $this->_getTable();

		$query = $table->find()
				->where(['token' => $token]);

		if ($checkTime) {
			$timeLimit = \Cake\I18n\Time::now();
			$timeLimit->subMinute(Defines::TOKEN_TIME_LIMIT);
			$query->where(['token' => $token, 'created >' => $timeLimit]);
		}

		$entity = $query->first();

		return $entity;
	}

	protected function _clearToken( $entity ) {
		$table = $this->_getTable();
		$entity->token = NULL;
		$table->save( $entity );
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

		$form = new EmailForm(strtolower($this->name));

		if ($this->request->is('post')) {

			$result = $form->execute($this->request->data);
			$email = $this->request->data['email'];

			if ($result) {
				return $this->redirect(['action' => 'step4', urlencode($email)]);
			}
		}

		$this->set('form', $form);
	}

	public function step4($email) {
		$this->set(['email' => $email]);
	}

	public function step41($email = NULL, $token = NULL) {
		$entity = $this->_checkToken($token);

		if (empty($entity)) {
			$this->render('step4_error');
			return;
		}

		$this->set(compact('email', 'token'));
	}

	public function step5($email = NULL, $token = NULL) {

		//tokenの存在確認　時間は気にしない
		$entity = $this->_checkToken($token, false);
		if (!$entity) {
			$this->Flash->error('invalid access');
			return $this->redirect('/');
		}


		//postされた情報の処理
		$form = $this->_getForm();
		if ($this->request->is('post')) {

			$data = $form->execute($this->request->data);

			if ($data !== false) {
				$session_key = strtolower($this->name);
				$session = $this->request->session();
				$session->delete($session_key);
				$session->write("{$session_key}.data", $data);
				$session->write("{$session_key}.token", $token);
				return $this->redirect(['action' => 'step59']);
			}
		}

		$this->set('id', $entity->id);

		$this->set(compact('email', 'token', 'form'));
	}

	public function step59() {
		$session_key = strtolower($this->name);
		$session = $this->request->session();

		$data = $session->read("{$session_key}.data", NULL);

		if (empty($data)) {
			$this->Flash->error('data not found');
			return $this->redirect('/');
		}

		$token = $session->read("{$session_key}.token", NULL);
		if (empty($this->_checkToken($token, false))) {
			$this->Flash->error('invalid access');
			return $this->redirect('/');
		}

		$code = $data[Defines::REPAIR_DATA_CODE];

		$referer = $this->referer(['controller' => 'sell', 'action' => 'step50']);

		$this->set(compact('data', 'code', 'referer'));
	}

	public function step6() {
		$session_key = strtolower($this->name);
		$session = $this->request->session();

		$data = $session->read("{$session_key}.data", NULL);

		if (empty($data)) {
			$this->Flash->error('data not found');
			return $this->redirect('/');
		}

		$token = $session->read("{$session_key}.token", NULL);
		$entity = $this->_checkToken( $token );
		if (empty($entity)) {
			$this->Flash->error('invalid access');
			return $this->redirect('/');
		}

		$this->_sendCompleteMail($data);
		
		$this->_makeFile($data);
		
		$this->_clearToken($entity);

		$session->delete($session_key);

		$this->set('code', $data[Defines::REPAIR_DATA_CODE]);
	}

	/**
	 * データをファイルに保存　成功でtrue 失敗でfalse
	 * @param type $data
	 * @return boolean
	 */
	protected function _makeFile($data) {
		$csv = $this->SaveCsv->getBody($data);
		$filename = $data[Defines::INQUIRY_DATA_CODE] . '.csv';

		try {
			$f = fopen($this->_filePath . $filename, 'w+');
			fwrite($f, $csv);
			fclose($f);
		} catch (Exception $ex) {
			return false;
		}

		return true;
	}

	protected function _sendCompleteMail($data) {
		$template = Defines::getTemplateComplete(strtolower($this->name));
		$template['subject'] .= sprintf('（受付番号:%s）', $data[Defines::REPAIR_DATA_CODE]);

		$emailObj = new \Cake\Network\Email\Email($template);
		$emailObj
				->viewVars(['data' => $data])
				->to($data[Defines::REPAIR_DATA_EMAIL])
				->send();
	}

}
