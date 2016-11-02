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

	abstract protected function _getDataToCsv($entity, $data);

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

	protected function _execute(array $data) {
		$table = TableRegistry::get($this->_tableName);
		$entity = $table->get($data['id']);

		$result = $this->_getDataToCsv($entity, $data);

		$entity->token = NULL;
		$table->save($entity);

		$this->_mailTemplate['subject'] .= sprintf('（受付番号:%s）', $result[Defines::REPAIR_DATA_CODE]);

		$emailObj = new \Cake\Network\Email\Email($this->_mailTemplate);
		$emailObj
				->viewVars(['data' => $result])
				->to($data['email'])
				->send();

		return $result;
	}

}
