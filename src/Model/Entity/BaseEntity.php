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
class BaseEntity extends Entity {

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * Note that when '*' is set to true, this allows all unspecified fields to
	 * be mass assigned. For security purposes, it is advised to set '*' to false
	 * (or remove it), and explicitly make individual fields accessible as needed.
	 *
	 * @var array
	 */
	protected $_accessible = [
		'*' => true,
		'id' => false
	];

	/**
	 * Fields that are excluded from JSON versions of the entity.
	 *
	 * @var array
	 */
	protected $_hidden = [
		'token'
	];

	public function setSereal() {
		$table_r = TableRegistry::get('repairs');

		$count = $table_r->find()
				->where([
					'created >' => Date::today(),
					'created <=' => Date::tomorrow(),
				])
				->count();

		$this->sereal = $count;
	}
	
	protected function _getCode(){
		$date_string = $this->created->format('Ymd');
		$sereal = sprintf( '%03d' , $this->sereal );
		return "WR-{$date_string}-{$sereal}";
	}
}
