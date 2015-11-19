<?php
namespace App\Model\Table;

use App\Model\Entity\Parameter;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parameters Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Scenarios
 * @property \Cake\ORM\Association\BelongsToMany $Tasks
 */
class ParametersTable extends Table
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

        $this->table('parameters');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsToMany('Scenarios', [
            'foreignKey' => 'parameter_id',
            'targetForeignKey' => 'scenario_id',
            'joinTable' => 'parameters_scenarios'
        ]);
        $this->belongsToMany('Tasks', [
            'foreignKey' => 'parameter_id',
            'targetForeignKey' => 'task_id',
            'joinTable' => 'parameters_tasks'
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

        return $validator;
    }
}
