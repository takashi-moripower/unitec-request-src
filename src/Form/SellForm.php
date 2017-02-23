<?php

namespace App\Form;

use App\Form\BaseForm;
use App\Defines\Defines;
use Cake\Validation\Validator;
use Cake\Form\Schema;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;

class SellForm extends BaseForm {

	protected $_entity;

	public function __construct() {
		$this->_tableName = 'sells';
		$this->_mailTemplate = Defines::getTemplateComplete('sell');
	}

	public function setEntity($entity) {
		$this->_entity = $entity;
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
			'tel',
		]);

		$validator->allowEmpty(['fax', 'content']);

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

		$validator->add('access', 'custom', [
			'rule' => [$this, 'checkAccess'],
			'message' => '選択された連絡方法が空欄です'
		]);

		$validator->add('post-code', 'custom', [
			'rule' => [$this, 'checkPost'],
			'message' => '半角数字のみ　7桁で入力してください'
		]);

		$validator->add('address2', 'custom', [
			'rule' => [$this, 'checkAddressLength'],
			'message' => '住所は合計200文字以内で入力してください'
		]);

		$validator->maxLength('tel', 15, '15文字以内で入力してください');
		$validator->maxLength('fax', 15, '15文字以内で入力してください');
		$validator->maxLength('email', 100, '100文字以内で入力してください');
		$validator->maxLength('content', 2000, '2000文字以内で入力してください');


		return $validator;
	}

	protected function _getArrayedData($entity, $data) {

//		$date = $entity->created->format('Y-m-d h:i:s');
//		$code = $entity->code;

		$date = null;
		$code = null;

		$result = [
			Defines::SELL_DATA_CODE => $code,
			Defines::SELL_DATA_DATE => $date,
			Defines::SELL_DATA_NAME1 => $data['name1'],
			Defines::SELL_DATA_NAME2 => $data['name2'],
			Defines::SELL_DATA_KANA_NAME1 => $data['kana-name1'],
			Defines::SELL_DATA_KANA_NAME2 => $data['kana-name2'],
			Defines::SELL_DATA_POST_CODE => $data['post-code'],
			Defines::SELL_DATA_ADDRESS1 => $data['address1'],
			Defines::SELL_DATA_ADDRESS2 => $data['address2'],
			Defines::SELL_DATA_ACCESS => $this->_formatAccess($data['access']),
			Defines::SELL_DATA_TEL => $data['tel'],
			Defines::SELL_DATA_FAX => $data['fax'],
			Defines::SELL_DATA_EMAIL => $data['email'],
			Defines::SELL_DATA_CONTENT => $data['content'],
			Defines::SELL_DATA_POSTAGE => $this->_getPostage($data),
			Defines::SELL_DATA_BLANK1 => '',
			Defines::SELL_DATA_BLANK2 => '',
		];

		return $result;
	}

	public function readSession($session) {
		$session_data = $session->read('sell.data');
		if (empty($session_data)) {
			$session_data = [];
		}

		$key_to_read = [
			'name1' => Defines::SELL_DATA_NAME1,
			'name2' => Defines::SELL_DATA_NAME2,
			'kana_name1' => Defines::SELL_DATA_KANA_NAME1,
			'kana_name2' => Defines::SELL_DATA_KANA_NAME2,
			'post_code' => Defines::SELL_DATA_POST_CODE,
			'address1' => Defines::SELL_DATA_ADDRESS1,
			'address2' => Defines::SELL_DATA_ADDRESS2,
			'tel' => Defines::SELL_DATA_TEL,
			'fax' => Defines::SELL_DATA_FAX,
			'email' => Defines::SELL_DATA_EMAIL,
			'content' => Defines::SELL_DATA_CONTENT
		];

		foreach ($key_to_read as $key => $path) {
			$this->{$key} = Hash::get($session_data, $path);
		}

		//	accessだけ処理が複雑
		$session_access = Hash::get($session_data, Defines::SELL_DATA_ACCESS);
		if (empty($session_access)) {
			$this->access = Defines::ACCESS_DEFAULT;
		} else {
			$this->access = $this->_unformatAccess($session_access);
		}
	}

	protected function _getPostage($data) {
		$table = TableRegistry::get('postages');

		$result = $table->find()
				->where(['pref' => $data['address1']])
				->first();

		if ($result) {
			return $result->charge;
		}

		return 0;
	}

	protected function _execute(array $data) {
		$entity = $this->_entity;

		$result = $this->_getArrayedData($entity, $data);
		return $result;
	}

	protected function _execute_old(array $data) {
		$table = TableRegistry::get($this->_tableName);
		$entity = $table->get($data['id']);

		$result = $this->_getArrayedData($entity, $data);

		return $result;
	}

}
