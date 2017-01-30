<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Postages Model
 *
 * @method \App\Model\Entity\Postage get($primaryKey, $options = [])
 * @method \App\Model\Entity\Postage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Postage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Postage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Postage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Postage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Postage findOrCreate($search, callable $callback = null, $options = [])
 */
class PostagesTable extends Table
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

        $this->table('postages');
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
            ->requirePresence('pref', 'create')
            ->notEmpty('pref');

        $validator
            ->integer('charge')
            ->requirePresence('charge', 'create')
            ->notEmpty('charge');

        return $validator;
    }
}
