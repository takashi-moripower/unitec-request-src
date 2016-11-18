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

	abstract protected function _getArrayedData($entity, $data);

	public function checkPost($value, $context) {
		return !empty(preg_match('/^[0-9]{7}$/', $value));
	}

	public function checkAccess($value, $context) {

		$fields = Defines::ACCESS_FIELD;
		foreach ($value as $access) {
			$field = $fields[$access];
			if (empty($context['data'][$field])) {
				return false;
			}
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
	
	protected function _formatAccess( $value ){
		return implode( "\r\n" , $value );
	}

	protected function _execute(array $dataPost) {
		$table = TableRegistry::get($this->_tableName);
		$entity = $table->get($dataPost['id']);

		$arrayedData = $this->_getArrayedData($entity, $dataPost);

		return $arrayedData;
	}
}
