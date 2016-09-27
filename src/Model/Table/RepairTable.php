<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Repair Model
 *
 * @method \App\Model\Entity\Repair get($primaryKey, $options = [])
 * @method \App\Model\Entity\Repair newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Repair[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Repair|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Repair patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Repair[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Repair findOrCreate($search, callable $callback = null)
 */
class RepairTable extends Table
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

        $this->table('repair');
        $this->displayField('id');
        $this->primaryKey('id');
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
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->integer('sereal')
            ->requirePresence('sereal', 'create')
            ->notEmpty('sereal');

        return $validator;
    }
}
