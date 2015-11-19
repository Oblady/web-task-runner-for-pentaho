<?php
namespace App\Model\Table;

use App\Model\Entity\ScenariosTask;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ScenariosTasks Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Scenarios
 * @property \Cake\ORM\Association\BelongsTo $Tasks
 */
class ScenariosTasksTable extends Table
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

        $this->table('scenarios_tasks');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Scenarios', [
            'foreignKey' => 'scenario_id'
        ]);
        $this->belongsTo('Tasks', [
            'foreignKey' => 'task_id'
        ]);
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
            ->add('order', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('order');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['scenario_id'], 'Scenarios'));
        $rules->add($rules->existsIn(['task_id'], 'Tasks'));
        return $rules;
    }
}
