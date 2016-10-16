<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Utility\Hash;

class SaveCsvComponent extends Component {

	public function getBody($item) {
		$fp = fopen('php://temp/maxmemory:' . (5 * 1024 * 1024), 'a');

		$data = [];
		foreach ($item as $value_utf) {
			$value_sjis = mb_convert_encoding($value_utf, 'SJIS-win', 'utf8');
			$data[] = $value_sjis;
		}

		fputcsv($fp, $data);

		rewind($fp);

		//リソースを読み込み文字列を取得する
		$csv = stream_get_contents($fp);
		//ファイルクローズ
		fclose($fp);

		return $csv;
	}

	public function getBody2($items) {
		$fp = fopen('php://temp/maxmemory:' . (5 * 1024 * 1024), 'a');

		foreach ($items as $item) {
			$data = [];
			foreach ($item as $value_utf) {
				$value_sjis = mb_convert_encoding($value_utf, 'SJIS-win', 'utf8');
				$data[] = $value_sjis;
			}
			fputcsv($fp, $data);
		}

		rewind($fp);

		//リソースを読み込み文字列を取得する
		$csv = stream_get_contents($fp);
		//ファイルクローズ
		fclose($fp);

		return $csv;
	}

}
