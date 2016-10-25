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
class Repair extends BaseEntity {
	protected $_prefix = "WR";	
}
