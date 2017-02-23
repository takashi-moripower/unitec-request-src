<?php

namespace App\Defines;

use Cake\Core\Configure;

class Defines {

//--------------------------------------------------------------------------------
//		共通
//--------------------------------------------------------------------------------
	const TOKEN_TIME_LIMIT = 30;
	const ACCESS_EMAIL = 1;
	const ACCESS_TEL = 2;
	const ACCESS_FAX = 3;
	const ACCESS_FIELD = [
		self::ACCESS_EMAIL => 'email',
		self::ACCESS_TEL => 'tel',
		self::ACCESS_FAX => 'fax',
	];
	const ACCESS_NAME = [
		self::ACCESS_EMAIL => 'Eメール',
		self::ACCESS_TEL => '電話',
		self::ACCESS_FAX => 'FAX',
	];
	const ACCESS_DEFAULT = [
		self::ACCESS_EMAIL => 1,
		self::ACCESS_TEL => 0,
		self::ACCESS_FAX => 0,
	];

	static function accessText($value) {

		$access = explode("\r\n", $value);

		$access_text = [];
		$AN = self::ACCESS_NAME;
		foreach ($access as $a) {
			$access_text[] = $AN[$a];
		}

		return implode(',', $access_text);
	}

//--------------------------------------------------------------------------------
//		Email
//--------------------------------------------------------------------------------

	const MAIL_TEMPLATE_REPAIR_CHECK = [
		'template' => 'check',
		'subject' => '修理受付サービス　本人確認手続き',
		'service' => '修理受付',
	];
	const MAIL_TEMPLATE_REPAIR_COMPLETE = [
		'template' => 'repairComplete',
		'subject' => '修理受付サービス　修理受付完了',
	];
	const MAIL_TEMPLATE_INQUIRY_CHECK = [
		'template' => 'check',
		'subject' => 'お問合せ受付サービス　本人確認手続き',
		'service' => 'お問合せ受付',
	];
	const MAIL_TEMPLATE_INQUIRY_COMPLETE = [
		'template' => 'inquiryComplete',
		'subject' => 'お問合せ受付サービス　お問合せ受付完了',
	];
	const MAIL_TEMPLATE_SELL_CHECK = [
		'template' => 'check',
		'subject' => '部品購入受付サービス　本人確認手続き',
		'service' => '部品購入受付',
	];
	const MAIL_TEMPLATE_SELL_COMPLETE = [
		'template' => 'sellComplete',
		'subject' => '部品購入受付サービス　部品購入受付完了',
	];

	static function getTemplateCheck($type) {

		$tmp = Configure::read('templates.mail.common.check') + Configure::read('templates.mail.base');

		switch ($type) {
			case 'repair':
				return Configure::read('templates.mail.repair.check') + $tmp;

			case 'inquiry':
				return Configure::read('templates.mail.inquiry.check') + $tmp;

			case 'sell':
				return Configure::read('templates.mail.sell.check') + $tmp;
		}
	}

	static function getTemplateComplete($type) {

		$tmp = Configure::read('templates.mail.common.complete') + Configure::read('templates.mail.base');

		switch ($type) {
			case 'repair':
				return Configure::read('templates.mail.repair.complete') + $tmp;

			case 'inquiry':
				return Configure::read('templates.mail.inquiry.complete') + $tmp;

			case 'sell':
				return Configure::read('templates.mail.sell.complete') + $tmp;
		}
	}

//--------------------------------------------------------------------------------
//		修理
//--------------------------------------------------------------------------------
	const REPAIR_PREFIX = 'HS';
	const REPAIR_PROGRESS_STEP_INFO = 0;
	const REPAIR_PROGRESS_REPAIR_AGREEMENT = 1;
	const REPAIR_PROGRESS_PRIVACY_AGREEMENT = 2;
	const REPAIR_PROGRESS_EMAIL_INPUT = 3;
	const REPAIR_PROGRESS_EMAIL_SENDING = 4;
	const REPAIR_PROGRESS_DATA_INPUT = 5;
	const REPAIR_PROGRESS_END = 6;
	const REPAIR_PROGRESS = [
		self::REPAIR_PROGRESS_STEP_INFO => [
			'label' => '申し込み手続きの確認',
			'icon' => 'rocket',
			'explain' => 'このページです',
		],
		self::REPAIR_PROGRESS_REPAIR_AGREEMENT => [
			'label' => '免責事項について',
			'icon' => 'commenting-o',
			'explain' => '免責事項を確認していただきます',
		],
		self::REPAIR_PROGRESS_PRIVACY_AGREEMENT => [
			'label' => '個人情報の取り扱いに関するご案内',
			'icon' => 'user',
			'explain' => '個人情報取り扱い規約を確認して頂きます',
		],
		self::REPAIR_PROGRESS_EMAIL_INPUT => [
			'label' => 'メールアドレスの入力',
			'icon' => 'pencil',
			'explain' => 'ご利用には、電子メールアドレスが必要です。<br>（携帯電話のメールアドレスはご利用になれません）',
		],
		self::REPAIR_PROGRESS_EMAIL_SENDING => [
			'label' => '本人確認メールの受信',
			'icon' => 'envelope-o',
			'explain' => '前項で入力したメールアドレス宛に、確認メールが届きます。<br>	メールに記載のURLにアクセスし、画面に従って申し込みの手続きを進めてください。',
		],
		self::REPAIR_PROGRESS_DATA_INPUT => [
			'label' => '修理情報等の入力',
			'icon' => 'wrench',
			'explain' => '修理情報やご訪問先など、必要な項目を入力し、送信してください',
		],
		self::REPAIR_PROGRESS_END => [
			'label' => '申し込み完了',
			'icon' => 'check-circle',
			'explain' => '以上で、申込み手続き完了となります',
		],
	];
	const REPAIR_DATA_CODE = 0;
	const REPAIR_DATA_DATE = 1;
	const REPAIR_DATA_NAME1 = 2;
	const REPAIR_DATA_NAME2 = 3;
	const REPAIR_DATA_KANA_NAME1 = 4;
	const REPAIR_DATA_KANA_NAME2 = 5;
	const REPAIR_DATA_POST_CODE = 6;
	const REPAIR_DATA_ADDRESS = 7;
	const REPAIR_DATA_ACCESS = 8;
	const REPAIR_DATA_TEL = 9;
	const REPAIR_DATA_FAX = 10;
	const REPAIR_DATA_EMAIL = 11;
	const REPAIR_DATA_CONTENT = 12;
	const REPAIR_DATA_PRODUCT = 13;
	const REPAIR_DATA_BUY_ERA = 14;
	const REPAIR_DATA_BUY_YEAR = 15;
	const REPAIR_DATA_BUY_MONTH = 16;
//--------------------------------------------------------------------------------
//		問合せ
//--------------------------------------------------------------------------------
	const INQUIRY_PREFIX = 'HT';
	const INQUIRY_PROGRESS_STEP_INFO = 0;
	const INQUIRY_PROGRESS_INQUIRY_AGREEMENT = 1;
	const INQUIRY_PROGRESS_PRIVACY_AGREEMENT = 2;
	const INQUIRY_PROGRESS_EMAIL_INPUT = 3;
	const INQUIRY_PROGRESS_EMAIL_SENDING = 4;
	const INQUIRY_PROGRESS_DATA_INPUT = 5;
	const INQUIRY_PROGRESS_END = 6;
	const INQUIRY_PROGRESS = [
		self::INQUIRY_PROGRESS_STEP_INFO => [
			'label' => '申し込み手続きの確認',
			'icon' => 'rocket',
			'explain' => 'このページです',
		],
		self::INQUIRY_PROGRESS_INQUIRY_AGREEMENT => [
			'label' => '免責事項について',
			'icon' => 'commenting-o',
			'explain' => '免責事項を確認していただきます',
		],
		self::INQUIRY_PROGRESS_PRIVACY_AGREEMENT => [
			'label' => '個人情報の取り扱いに関するご案内',
			'icon' => 'user',
			'explain' => '個人情報取り扱い規約を確認して頂きます',
		],
		self::INQUIRY_PROGRESS_EMAIL_INPUT => [
			'label' => 'メールアドレスの入力',
			'icon' => 'pencil',
			'explain' => 'ご利用には、電子メールアドレスが必要です。<br>（携帯電話のメールアドレスはご利用になれません）',
		],
		self::INQUIRY_PROGRESS_EMAIL_SENDING => [
			'label' => '本人確認メールの受信',
			'icon' => 'envelope-o',
			'explain' => '前項で入力したメールアドレス宛に、確認メールが届きます。<br>	メールに記載のURLにアクセスし、画面に従って申し込みの手続きを進めてください。',
		],
		self::INQUIRY_PROGRESS_DATA_INPUT => [
			'label' => 'お問い合わせ情報等の入力',
			'icon' => 'wrench',
			'explain' => 'お問い合わせ情報やご訪問先など、必要な項目を入力し、送信してください',
		],
		self::INQUIRY_PROGRESS_END => [
			'label' => '申し込み完了',
			'icon' => 'check-circle',
			'explain' => '以上で、申込み手続き完了となります',
		],
	];
	const INQUIRY_DATA_CODE = 0;
	const INQUIRY_DATA_DATE = 1;
	const INQUIRY_DATA_NAME1 = 2;
	const INQUIRY_DATA_NAME2 = 3;
	const INQUIRY_DATA_KANA_NAME1 = 4;
	const INQUIRY_DATA_KANA_NAME2 = 5;
	const INQUIRY_DATA_POST_CODE = 6;
	const INQUIRY_DATA_ADDRESS = 7;
	const INQUIRY_DATA_ACCESS = 8;
	const INQUIRY_DATA_TEL = 9;
	const INQUIRY_DATA_FAX = 10;
	const INQUIRY_DATA_EMAIL = 11;
	const INQUIRY_DATA_CONTENT = 12;
	const INQUIRY_DATA_PRODUCT = 13;
	const INQUIRY_DATA_CATEGORY = 14;
	const INQUIRY_DATA_BLANK1 = 15;
	const INQUIRY_DATA_BLANK2 = 16;
	const INQUIRY_CATEGORIES = [
		0 => '選択してください',
		1 => '大工道具・作業工具・園芸用品に関するお問い合わせ',
		2 => '電動工具・園芸機器に関するお問い合わせ',
		3 => 'キッチン用品に関するお問い合わせ',
		4 => 'その他のお問い合わせ',
	];
//--------------------------------------------------------------------------------
//		部品販売
//--------------------------------------------------------------------------------
	const SELL_PREFIX = 'HB';
	const SELL_PROGRESS_SELECT_PRODUCT = 0;
	const SELL_PROGRESS_SELECT_PARTS = 1;
	const SELL_PROGRESS_STEP_INFO = 2;
	const SELL_PROGRESS_SELL_AGREEMENT = 3;
	const SELL_PROGRESS_PRIVACY_AGREEMENT = 4;
	const SELL_PROGRESS_DATA_INPUT = 5;
	const SELL_PROGRESS_DATA_CHECK = 6;
	const SELL_PROGRESS_END = 7;
	const SELL_PROGRESS = [
		self::SELL_PROGRESS_SELECT_PRODUCT => [
			'label' => '商品選択',
			'icon' => 'hand-pointer-o',
			'explain' => '一覧より商品を選択していただきます',
		],
		self::SELL_PROGRESS_SELECT_PARTS => [
			'label' => '商品内部品選択',
			'icon' => 'wrench',
			'explain' => '部品の種類、数を指定していただきます',
		],
		self::SELL_PROGRESS_STEP_INFO => [
			'label' => '申し込み手続きの確認',
			'icon' => 'rocket',
			'explain' => 'このページです',
		],
		self::SELL_PROGRESS_SELL_AGREEMENT => [
			'label' => '免責事項について',
			'icon' => 'commenting-o',
			'explain' => '免責事項を確認していただきます',
		],
		self::SELL_PROGRESS_PRIVACY_AGREEMENT => [
			'label' => '個人情報の取り扱いに関するご案内',
			'icon' => 'user',
			'explain' => '個人情報取り扱い規約を確認して頂きます',
		],
		self::SELL_PROGRESS_DATA_INPUT => [
			'label' => '購入者情報等の入力',
			'icon' => 'id-card-o',
			'explain' => '部品購入情報やご訪問先など、必要な項目を入力し、送信してください',
		],
		self::SELL_PROGRESS_DATA_CHECK => [
			'label' => '部品情報の確認',
			'icon' => 'question-circle-o',
			'explain' => '選択して頂いた情報の確認をして頂きます',
		],
		self::SELL_PROGRESS_END => [
			'label' => '申し込み完了',
			'icon' => 'check-circle',
			'explain' => '以上で、申込み手続き完了となります',
		],
	];
	const SELL_DATA_CODE = 0;
	const SELL_DATA_DATE = 1;
	const SELL_DATA_NAME1 = 2;
	const SELL_DATA_NAME2 = 3;
	const SELL_DATA_KANA_NAME1 = 4;
	const SELL_DATA_KANA_NAME2 = 5;
	const SELL_DATA_POST_CODE = 6;
	const SELL_DATA_ADDRESS1 = 7;
	const SELL_DATA_ADDRESS2 = 8;
	const SELL_DATA_ACCESS = 9;
	const SELL_DATA_TEL = 10;
	const SELL_DATA_FAX = 11;
	const SELL_DATA_EMAIL = 12;
	const SELL_DATA_CONTENT = 13;
	const SELL_DATA_POSTAGE = 14;
	const SELL_DATA_BLANK1 = 15;
	const SELL_DATA_BLANK2 = 16;

}
