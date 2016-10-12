<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;

/**
 * Repair Entity
 *
 * @property int $id
 * @property int $sereal
 * @property string $token
 * @property \Cake\I18n\Time $created
 */
class Sell extends Repair {
	protected function _getCode(){
		$date_string = $this->created->format('Ymd');
		$sereal = sprintf( '%03d' , $this->sereal );
		return "WS-{$date_string}-{$sereal}";
	}	
}
