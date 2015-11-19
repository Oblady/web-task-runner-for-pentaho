<?php
namespace App\Model\Table;

use App\Model\Entity\Task;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tasks Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Parameters
 * @property \Cake\ORM\Association\BelongsToMany $Scenarios
 */
class TasksTable extends Table
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

        $this->table('tasks');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsToMany('Parameters', [
            'foreignKey' => 'task_id',
            'targetForeignKey' => 'parameter_id',
            'joinTable' => 'parameters_tasks'
        ]);
        $this->belongsToMany('Scenarios', [
            'foreignKey' => 'task_id',
            'targetForeignKey' => 'scenario_id',
            'joinTable' => 'scenarios_tasks'
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('job_path');

        return $validator;
    }
}
