<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use App\Defines\Defines;

/**
 * Repair Entity
 *
 * @property int $id
 * @property int $sereal
 * @property string $token
 * @property \Cake\I18n\Time $created
 */
class Sell extends BaseEntity {
	protected $_prefix = Defines::SELL_PREFIX;	
}
