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
class RepairController extends AppController {

	public function initialize() {
		parent::initialize();
		$this->viewBuilder()->layout('repair');
	}
	
	public function debug(){
		$this->viewBuilder()->layout('default');
		
		$today = \Cake\I18n\Date::today();
		$tomorrow = \Cake\I18n\Date::tomorrow();
		
		$this->set('data',[$today,$tomorrow]);
		$this->render('../Common/debug');
		return;
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
		if ($this->request->is('post')) {
			$email = $this->request->data('email');
			$this->_sendMail($email);
			
			$this->set(['email'=>$email]);
			return $this->redirect(['action'=>'step4', urlencode( $email ) ]);
		}
	}

	protected function _sendMail( $mail ) {
		
		$token = AppUtility::makeRandStr(16);
		
		$table_r = TableRegistry::get('repairs');
		
		$repair = $table_r->newEntity(['token'=>$token]);
		$repair->email = $mail;
		$repair->setSereal();
		
		$table_r->save( $repair );
		
		$emailObj = new \Cake\Network\Email\Email();
//		$emailObj->transport('sakura')
		$emailObj->transport('default')
				->from('takashi@moripower.jp')
				->template('repair')
				->viewVars(['repair' => $repair])
				->to( $mail )
				->subject('repair')
				->send();
	}
	
	public function step4($email){
		$this->set(['email'=>$email]);
	}
	
	public function step5( $email = NULL , $token = NULL ){
		if( $this->request->is('post')){
			$this->set('data',$this->request->data);
			return $this->render('/Common/debug');
		}
		
		$table_r = TableRegistry::get('repairs');
		
		$timeLimit = \Cake\I18n\Time::now();
		$timeLimit->subMinute(30);
		
		
		$valid = true;
		if( $token == NULL ){
			$this->Flash->error('invalid access 0');
			return $this->redirect(['controller'=>'pages','action'=>'display','home']);
		}

		if( !$table_r->exists([
			'token'=> $token, 
			'created >' => $timeLimit
		])){
			$this->Flash->error('invalid access 1');
			return $this->redirect(['controller'=>'pages','action'=>'display','home']);
		}
		
		$this->set(compact('email','token'));
	}
}
