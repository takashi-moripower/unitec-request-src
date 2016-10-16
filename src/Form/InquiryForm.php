<?php

namespace App\Form;

use App\Form\BaseForm;
use App\Defines\Defines;
use Cake\Validation\Validator;
use Cake\Form\Schema;

class InquiryForm extends BaseForm {

	public function __construct() {
		$this->_tableName = 'inquiries';
		$this->_mailTemplate = Defines::MAIL_TEMPLATE_INQUIRY_COMPLETE;
	}

	protected function _buildSchema(Schema $schema) {
		return $schema->addFields([
					'name1' => 'string',
					'name2' => 'string',
					'kana-name1' => 'string',
					'kana-name2' => 'string',
					'post-code' => 'number',
					'address' => 'string',
					'access' => 'number',
					'tel' => 'string',
					'fax' => 'string',
					'email' => 'email',
					'content' => 'text',
					'product' => 'string',
					'category' => 'date',
		]);
	}

	protected function _buildValidator(Validator $validator) {
		$validator->requirePresence([
			'name1',
			'name2',
			'kana-name1',
			'kana-name2',
			'post-code',
			'address',
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

	protected function _getDataToCsv($entity, $data) {

		$date = $entity->created->format('Y-m-d h:i:s');

		$result = [
			Defines::INQUIRY_DATA_CODE => $entity->code,
			Defines::INQUIRY_DATA_DATE => $date,
			Defines::INQUIRY_DATA_NAME1 => $data['name1'],
			Defines::INQUIRY_DATA_NAME2 => $data['name2'],
			Defines::INQUIRY_DATA_KANA_NAME1 => $data['kana-name1'],
			Defines::INQUIRY_DATA_KANA_NAME2 => $data['kana-name2'],
			Defines::INQUIRY_DATA_POST_CODE => $data['post-code'],
			Defines::INQUIRY_DATA_ADDRESS => $data['address'],
			Defines::INQUIRY_DATA_ACCESS => $data['access'],
			Defines::INQUIRY_DATA_TEL => $data['tel'],
			Defines::INQUIRY_DATA_FAX => $data['fax'],
			Defines::INQUIRY_DATA_EMAIL => $data['email'],
			Defines::INQUIRY_DATA_CONTENT => $data['content'],
			Defines::INQUIRY_DATA_PRODUCT => $data['product'],
			Defines::INQUIRY_DATA_CATEGORY => $data['category'],
		];

		return $result;
	}

}