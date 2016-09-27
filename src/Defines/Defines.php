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
		self::REPAIR_PROGRESS_STEP_INFO => '申し込み手続きの確認',
		self::REPAIR_PROGRESS_REPAIR_AGREEMENT => '修理に関する注意事項の確認',
		self::REPAIR_PROGRESS_PRIVACY_AGREEMENT => '個人情報の取扱等の確認',
		self::REPAIR_PROGRESS_EMAIL_INPUT => 'メールアドレスの入力',
		self::REPAIR_PROGRESS_EMAIL_SENDING => '本人確認メールの受信',
		self::REPAIR_PROGRESS_DATA_INPUT => '修理情報の入力',
		self::REPAIR_PROGRESS_END => '申し込み終了',
	
	];

}
