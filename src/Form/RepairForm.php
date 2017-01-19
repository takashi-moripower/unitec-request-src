<?php

namespace App\Form;

use App\Form\BaseForm;
use App\Defines\Defines;
use Cake\Validation\Validator;
use Cake\Form\Schema;

class RepairForm extends BaseForm {

	public function __construct() {
		$this->_tableName = 'repairs';
		$this->_mailTemplate = Defines::MAIL_TEMPLATE_REPAIR_COMPLETE;
	}

	protected function _buildSchema(Schema $schema) {
		return $schema->addFields([
					'name1' => 'string',
					'name2' => 'string',
					'kana-name1' => 'string',
					'kana-name2' => 'string',
					'post-code' => 'number',
					'address1' => 'string',
					'address2' => 'string',
					'access' => 'number',
					'email' => 'email',
					'tel' => 'string',
					'fax' => 'string',
					'product' => 'string',
					'date' => 'date',
					'content' => 'text'
		]);
	}

	protected function _buildValidator(Validator $validator) {
		$validator->requirePresence([
			'name1',
			'name2',
			'kana-name1',
			'kana-name2',
			'post-code',
			'address1',
			'address2',
			'email',
			'product',
			'content',
		]);

		$validator->allowEmpty(['tel', 'fax']);
		
		$validator->add('name1', 'custom', [
			'rule' => [$this, 'checkZenkaku'],
			'message' => '全角文字で入力してください'
		]);
		$validator->add('name2', 'custom', [
			'rule' => [$this, 'checkZenkaku'],
			'message' => '全角文字で入力してください'
		]);

		$validator->add('kana-name1', 'custom', [
			'rule' => [$this, 'checkKana'],
			'message' => '全角カタカナで入力してください'
		]);
		$validator->add('kana-name2', 'custom', [
			'rule' => [$this, 'checkKana'],
			'message' => '全角カタカナで入力してください'
		]);

		$validator->notEmpty('access', '連絡手段を選択してください');
		
		$validator->add('access', 'custom', [
			'rule' => [$this, 'checkAccess'],
			'message' => '選択された連絡方法が空欄です'
		]);

		$validator->add('post-code', 'custom', [
			'rule' => [$this, 'checkPost'],
			'message' => '半角数字のみ　7桁で入力してください'
		]);

		return $validator;
	}

	protected function _getArrayedData($entity, $data) {

		$date = $entity->created->format('Y-m-d h:i:s');

		$result = [
			Defines::REPAIR_DATA_CODE => $entity->code,
			Defines::REPAIR_DATA_DATE => $date,
			Defines::REPAIR_DATA_NAME1 => $data['name1'],
			Defines::REPAIR_DATA_NAME2 => $data['name2'],
			Defines::REPAIR_DATA_KANA_NAME1 => $data['kana-name1'],
			Defines::REPAIR_DATA_KANA_NAME2 => $data['kana-name2'],
			Defines::REPAIR_DATA_POST_CODE => $data['post-code'],
			Defines::REPAIR_DATA_ADDRESS => $data['address1'].$data['address2'],
			Defines::REPAIR_DATA_ACCESS => $this->_formatAccess( $data['access']),
			Defines::REPAIR_DATA_TEL => $data['tel'],
			Defines::REPAIR_DATA_FAX => $data['fax'],
			Defines::REPAIR_DATA_EMAIL => $data['email'],
			Defines::REPAIR_DATA_CONTENT => $data['content'],
			Defines::REPAIR_DATA_PRODUCT => $data['product'],
			Defines::REPAIR_DATA_BUY_ERA => NULL,
			Defines::REPAIR_DATA_BUY_YEAR => $data['date']['year'],
			Defines::REPAIR_DATA_BUY_MONTH => $data['date']['month'],
		];

		return $result;
	}

}
