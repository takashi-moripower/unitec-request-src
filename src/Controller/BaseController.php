<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Form\RepairForm;
use App\Form\EmailForm2;
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

		$form = new EmailForm2(strtolower($this->name));

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
		$form = $this->_getForm();

		if ($this->request->is('post')) {
			$data = $this->request->data;

			$data3 = $form->execute($data);

			if ($data3 !== false) {
				$csv = $this->SaveCsv->getBody($data3);
				$filename = $data3[0] . '.csv';

				try {
					$f = fopen($this->_filePath . $filename, 'w+');
					fwrite($f, $csv);
					fclose($f);
				} catch (Exception $ex) {
					$this->flash->error('file can not open');
					return $this->redirect('/');
				}

				return $this->redirect(['action' => 'step6', $data3[Defines::INQUIRY_DATA_CODE]]);
			}
		}


		$entity = $this->_checkToken($token);

		if (!$entity) {
			$this->Flash->errors('invalid access 1');
			return $this->redirect('/');
		}

		$this->set('id', $entity->id);

		$this->set(compact('email', 'token', 'form'));
	}

	public function step6($code) {
		$this->set('code', $code);
	}

	public function debug() {
		
	}

}
