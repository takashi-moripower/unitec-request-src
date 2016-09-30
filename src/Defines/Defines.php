<?php
namespace App\Defines;

class Defines {

	const REPAIR_PROGRESS_STEP_INFO = 0;
	const REPAIR_PROGRESS_REPAIR_AGREEMENT= 1;
	const REPAIR_PROGRESS_PRIVACY_AGREEMENT = 2;
	const REPAIR_PROGRESS_EMAIL_INPUT = 3;
	const REPAIR_PROGRESS_EMAIL_SENDING = 4;
	const REPAIR_PROGRESS_DATA_INPUT = 5;
	const REPAIR_PROGRESS_END = 6;
	
	const REPAIR_PROGRESS = [
		self::REPAIR_PROGRESS_STEP_INFO => [
			'label' => '申し込み手続きの確認',
			'icon'=>'rocket',
		],
		self::REPAIR_PROGRESS_REPAIR_AGREEMENT => [
			'label' => '修理に関する注意事項の確認',
			'icon'=>'commenting-o',
		],
		self::REPAIR_PROGRESS_PRIVACY_AGREEMENT => [
			'label' => '個人情報の取扱等の確認',
			'icon'=>'commenting-o',
		],
		self::REPAIR_PROGRESS_EMAIL_INPUT => [
			'label' => 'メールアドレスの入力',
			'icon'=>'pencil',
		],
		self::REPAIR_PROGRESS_EMAIL_SENDING => [
			'label' => '本人確認メールの受信',
			'icon'=>'envelope-o',
		],
		self::REPAIR_PROGRESS_DATA_INPUT => [
			'label' => '修理情報等の入力',
			'icon'=>'wrench',
		],
		self::REPAIR_PROGRESS_END => [
			'label' => '申し込み完了',
			'icon'=>'check-circle',
		],
	];
	

}
