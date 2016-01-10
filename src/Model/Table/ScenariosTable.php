<?php
namespace App\Model\Table;

use App\Model\Entity\ParametersScenario;
use App\Model\Entity\Scenario;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Scenarios Model
 *
 * @property ParametersTable $Parameters
 * @property ParametersScenarios $ParametersScenarios
 * @property TasksTable $Tasks
 */
class ScenariosTable extends Table
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

        $this->table('scenarios');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('ParametersScenarios');

        $this->belongsToMany('Parameters');
        $this->belongsToMany('Tasks');
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('description');

        return $validator;
    }
}
