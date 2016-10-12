<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use App\Defines\Defines;
use App\Utils\AppUtility;

class EmailForm extends Form {

	protected function _buildSchema(Schema $schema) {
		return $schema
						->addFields([
							'email' => 'email',
							'email2' => 'email',
		]);
		;
	}

	protected function _buildValidator(Validator $validator) {
		$validator->requirePresence([
			'email',
			'email2',
		]);

		$validator->add('email2', 'custom', [
			'rule' => [$this, 'checkMail'],
			'message' => '入力内容が異なっています'
		]);

		return $validator;
	}

	public function checkMail($value, $context) {
		return( $context['data']['email'] == $context['data']['email2'] );
	}

	protected function _execute(array $data) {

		$token = AppUtility::makeRandStr(16);

		$table_r = TableRegistry::get('repairs');

		$repair = $table_r->newEntity([
			'token' => $token,
			'email' => $data['email']
		]);

		$repair->setSereal();

		$table_r->save($repair);

		$emailObj = new \Cake\Network\Email\Email( Defines::MAIL_TEMPLATE_REPAIR_CHECK );
		$emailObj->viewVars(['repair' => $repair])
				->to($repair->email)
				->send();

		return true;
	}

	public function setErrors($errors) {
		$this->_errors = $errors;
	}

}
