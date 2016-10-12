<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use App\Defines\Defines;

abstract class BaseForm extends Form {

	protected $_filePath;
	protected $_mailTemplate;
	protected $_tableName;

	abstract protected function _getDataToCsv( $entity , $data );
	
	public function checkPost($value, $context) {
		return !empty(preg_match('/^[0-9]{7}$/', $value));
	}

	public function checkAccess($value, $context) {
		$fields = Defines::ACCESS_FIELD;
		$access_field = $fields[$context['data']['access']];

		if (empty($context['data'][$access_field])) {
			return false;
		}

		return true;
	}

	public function checkZenkaku($value, $context) {
		$len = mb_strlen($value);
		$width = mb_strwidth($value);

		return ($len * 2 == $width);
	}

	public function checkKana($value, $context) {
		return ( preg_match("/^[ァ-ヶー]+$/u", $value) != 0 );
	}

	
	protected function _execute(array $data) {
		$table = TableRegistry::get( $this->_tableName );
		$entity = $table->get( $data['id'] );

		$result = $this->_getDataToCsv($entity, $data);

		$entity->token = NULL;
		$table->save($entity);

		$emailObj = new \Cake\Network\Email\Email( $this->_mailTemplate );
		$emailObj
				->viewVars(['data' => $result])
				->to($data['email'])
				->send();

		return $result;
	}
}
