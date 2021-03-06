<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Zipcodes Model
 *
 * @method \App\Model\Entity\Zipcode get($primaryKey, $options = [])
 * @method \App\Model\Entity\Zipcode newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Zipcode[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Zipcode|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Zipcode patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Zipcode[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Zipcode findOrCreate($search, callable $callback = null, $options = [])
 */
class ZipcodesTable extends Table
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

        $this->setTable('zipcodes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('zipcode')
            ->allowEmpty('zipcode');

        $validator
            ->scalar('state')
            ->allowEmpty('state');

        $validator
            ->scalar('city')
            ->allowEmpty('city');

        $validator
            ->scalar('town')
            ->allowEmpty('town');

        return $validator;
    }
}
