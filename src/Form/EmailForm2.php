<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use App\Defines\Defines;
use App\Utils\AppUtility;
use Cake\Routing\Router;
use Cake\Utility\Inflector;

class EmailForm2 extends Form {

	protected $_table_name;
	protected $_template;

	public function __construct($type) {
		$this->_type = $type;
		$this->_table_name = Inflector::pluralize($type);
		$this->_template = Defines::getTemplateCheck($type);
	}

	protected function _buildSchema(Schema $schema) {
		return $schema->addFields([
					'email' => 'email',
					'email2' => 'email'
		]);
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

		$table = TableRegistry::get($this->_table_name);

		$token = AppUtility::makeRandStr(16);

		$entity = $table->newEntity(['token' => $token]);
		$entity->setSereal();

		$table->save($entity);
		$email = $data['email'];

		$limit = $entity->created;
		$limit->addMinutes(30);

		$emailObj = new \Cake\Network\Email\Email($this->_template);

		$emailObj->viewVars([
					'email' => $email,
					'title' => $this->_template['subject'],
					'limit' => $limit,
					'url' => Router::url(['controller' => $this->_type , 'action' => 'step41', urlencode($email), $token], true)
				])
				->to($email)
				->send();

		return true;
	}

	public function setErrors($errors) {
		$this->_errors = $errors;
	}

}
