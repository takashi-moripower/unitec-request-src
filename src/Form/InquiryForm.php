<?php

namespace App\Form;

use App\Form\BaseForm;
use App\Defines\Defines;
use Cake\Validation\Validator;
use Cake\Form\Schema;

class InquiryForm extends BaseForm {
	
	public function __construct() {
		$this->_tableName = 'inquiries';
		$this->_mailTemplate = Defines::getTemplateComplete('inquiry');
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
					'tel' => 'string',
					'fax' => 'string',
					'email' => 'email',
					'content' => 'string',
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
			'address1',
			'address2',
			'email',
			'tel',
			'product',
			'content',
		]);

		$validator->allowEmpty(['fax']);

		$validator->add('name1', 'custom', [
			'rule' => [$this, 'checkZenkaku'],
			'message' => '全角文字で入力してください'
		]);
		$validator->maxLength('name1', 20, '20文字以内で入力してください');

		$validator->add('name2', 'custom', [
			'rule' => [$this, 'checkZenkaku'],
			'message' => '全角文字で入力してください'
		]);
		$validator->maxLength('name2', 20, '20文字以内で入力してください');

		$validator->add('kana-name1', 'custom', [
			'rule' => [$this, 'checkKana'],
			'message' => '全角カタカナで入力してください'
		]);
		$validator->maxLength('kana-name1', 20, '20文字以内で入力してください');

		$validator->add('kana-name2', 'custom', [
			'rule' => [$this, 'checkKana'],
			'message' => '全角カタカナで入力してください'
		]);
		$validator->maxLength('kana-name2', 20, '20文字以内で入力してください');

		$validator->notEmpty('access', '連絡手段を選択してください');

		$validator->add('category', 'validValue', [
			'rule' => ['range', 1, 4],
			'message' => 'カテゴリを選択してください'
		]);
		
		$validator->add('access', 'custom', [
			'rule' => [$this, 'checkAccess'],
			'message' => '選択された連絡方法が空欄です'
		]);

		$validator->add('post-code', 'custom', [
			'rule' => [$this, 'checkPost'],
			'message' => '半角数字のみ　7桁で入力してください'
		]);

		$validator->maxLength('address',200,'200文字以内で入力してください');
		$validator->maxLength('tel',15,'15文字以内で入力してください');
		$validator->maxLength('fax',15,'15文字以内で入力してください');
		$validator->maxLength('email',100,'100文字以内で入力してください');
		$validator->maxLength('content',2000,'2000文字以内で入力してください');
		
		return $validator;
	}

	protected function _getArrayedData($entity, $data) {

		$date = $entity->created->format('Y-m-d h:i:s');

		$result = [
			Defines::INQUIRY_DATA_CODE => $entity->code,
			Defines::INQUIRY_DATA_DATE => $date,
			Defines::INQUIRY_DATA_NAME1 => $data['name1'],
			Defines::INQUIRY_DATA_NAME2 => $data['name2'],
			Defines::INQUIRY_DATA_KANA_NAME1 => $data['kana-name1'],
			Defines::INQUIRY_DATA_KANA_NAME2 => $data['kana-name2'],
			Defines::INQUIRY_DATA_POST_CODE => $data['post-code'],
			Defines::INQUIRY_DATA_ADDRESS => $data['address1'].$data['address2'],
			Defines::INQUIRY_DATA_ACCESS => $this->_formatAccess($data['access']),
			Defines::INQUIRY_DATA_TEL => $data['tel'],
			Defines::INQUIRY_DATA_FAX => $data['fax'],
			Defines::INQUIRY_DATA_EMAIL => $data['email'],
			Defines::INQUIRY_DATA_CONTENT => $data['content'],
			Defines::INQUIRY_DATA_PRODUCT => $data['product'],
			Defines::INQUIRY_DATA_CATEGORY => $data['category'],
			Defines::INQUIRY_DATA_BLANK1 => '',
			Defines::INQUIRY_DATA_BLANK2 => '',
		];

		return $result;
	}

}
