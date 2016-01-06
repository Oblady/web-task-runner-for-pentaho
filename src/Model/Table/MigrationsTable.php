<?php
namespace App\Model\Table;

use App\Model\Entity\Migration;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

/**
 * Migrations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Scenarios
 */
class MigrationsTable extends Table
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

        $this->table('migrations');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Scenarios', [
            'foreignKey' => 'scenario_id'
        ]);

        $this->hasMany('MigrationsParameters');
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
        return $rules;
    }

    public function getExecLine($migration_id){

        //Chemin de Kitchen sur le système
        $kitchen = Configure::read('Pentaho.kitchen');

        $migration = $this->get($migration_id,['contain' => ['Scenarios','Scenarios.Parameters', 'Scenarios.Tasks.Parameters']]);

        $scenario_parameters="";
        foreach($migration->scenario->parameters as $parameter){
            $scenario_parameters .= "-param:".$parameter->name."=".$parameter->_joinData->value." ";
        }

        $migrationsParametersId = $this->MigrationsParameters->find('list', [
            'keyField' => 'parameter.name',
            'valueField' => 'value',
            'groupField' => 'task_id'
        ])->contain(['Parameters'])
          ->where([
            'MigrationsParameters.migration_id' => $migration_id
        ])->toArray();

        $tasksPath = $this->Scenarios->Tasks->find('list', [
            'keyField' => 'id',
            'valueField' => 'job_path'
        ])->toArray();

        $tasksExecLines = [];
        foreach($migrationsParametersId as $taskId => $task){
            $exec_line = "" ;
            foreach($task as $parameter_name => $parameter_value){
                $exec_line .= "-param:".$parameter_name."=".$parameter_value." ";
            }
            $tasksExecLines[$taskId] = $kitchen . " -file=" . $tasksPath[$taskId]." ".$scenario_parameters.$exec_line."-logfile=/var/log/pentaho-migration-".$migration_id.".log";
        }

        return $tasksExecLines;
    }
}
