<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Utils\AppUtility;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use App\Form\RepairForm;
use App\Form\EmailForm;
use App\Defines\Defines;

/**
 * Repair Controller
 *
 * @property \App\Model\Table\RepairTable $Repair
 */
class RepairController extends AppController {

	public function initialize() {
		parent::initialize();
		$this->loadComponent('SaveCsv');
		$this->viewBuilder()->layout('inquiry');
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
		
		$form = new EmailForm;
		
		if ($this->request->is('post')) {
			
			$result = $form->execute( $this->request->data );
			$email = $this->request->data['email'];
			
			if( $result ){
				return $this->redirect(['action' => 'step4', urlencode($email)]);
			}
		}

		$this->set( 'form' , $form );
	}

	public function step4($email) {
		$this->set(['email' => $email]);
	}
	
	protected function _checkToken( $token ){
		$timeLimit = \Cake\I18n\Time::now();
		$timeLimit->subMinute( Defines::TOKEN_TIME_LIMIT );
		$table_r = TableRegistry::get('repairs');

		$entity = $table_r->find()
				->where(['token' => $token, 'created >' => $timeLimit])
				->first();
		
		return $entity;
	}
	
	public function step41($email = NULL, $token = NULL){
		$entity = $this->_checkToken( $token );
		
		if( empty( $entity )){
			$this->render('step4_error');
			return;
		}
		
		$this->set(compact('email','token'));
	}

	public function step5($email = NULL, $token = NULL) {
		$table_r = TableRegistry::get('repairs');

		$form = new RepairForm();

		if ($this->request->is('post')) {
			$data = $this->request->data;

			$data3 = $form->execute($data);

			if ($data3 !== false) {
				$csv = $this->SaveCsv->getBody($data3);
				$filename = $data3[0] . '.csv';
				try {
					$f = fopen( Defines::REPAIR_PATH . $filename, 'w+');
					fwrite($f, $csv);
					fclose($f);
				} catch (Exception $ex) {
					$this->flash->error('file can not open');
					return $this->redirect('/');
				}

				return $this->redirect(['action'=>'step6',$data3[Defines::REPAIR_DATA_CODE]]);
			}
		}


		$entity = $this->_checkToken($token);
		
		if (!$entity) {
			$this->Flash->error('invalid access 1');
			return $this->redirect(['controller' => 'pages', 'action' => 'display', 'home']);
		}

		$id_repair = $entity->id;

		$this->set(compact('email', 'token', 'id_repair', 'form'));
	}
	
	public function step6($code){
		$this->set('code',$code);
	}
	
	public function debug(){
		$emailObj = new \Cake\Network\Email\Email( Defines::MAIL_TEMPLATE_REPAIR_COMPLETE );
		
		$emailObj->to( 'takashiabe65535@gmail.com')
				->send();
		
		$this->viewBuilder()->layout('default');
		$this->render('/Common/debug');
	}

}
