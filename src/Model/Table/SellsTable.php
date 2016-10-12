<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Repairs Model
 *
 * @method \App\Model\Entity\Repair get($primaryKey, $options = [])
 * @method \App\Model\Entity\Repair newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Repair[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Repair|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Repair patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Repair[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Repair findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SellsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('repairs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('sereal')
            ->requirePresence('sereal', 'create')
            ->notEmpty('sereal');

        $validator
            ->requirePresence('token', 'create')
            ->notEmpty('token');

        return $validator;
    }
}
