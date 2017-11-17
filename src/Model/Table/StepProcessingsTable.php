<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StepProcessings Model
 *
 * @method \App\Model\Entity\StepProcessing get($primaryKey, $options = [])
 * @method \App\Model\Entity\StepProcessing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StepProcessing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StepProcessing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StepProcessing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StepProcessing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StepProcessing findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StepProcessingsTable extends Table
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

        $this->setTable('step_processings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

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
            ->scalar('uid')
            ->requirePresence('uid', 'create')
            ->notEmpty('uid');

        $validator
            ->scalar('step_status')
            ->requirePresence('step_status', 'create')
            ->notEmpty('step_status');

        return $validator;
    }
}
