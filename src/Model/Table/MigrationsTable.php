<?php
/**
 * This file is part of Web Task Runner for Pentaho Data Integration.
 *
 * Web Task Runner for Pentaho Data Integration is free software: you
 * can redistribute it and/or modify it under the terms of the GNU
 * Affero General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option)
 * any later version.
 *
 * Web Task Runner for Pentaho Data Integration is distributed in the
 * hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE.  See the GNU Affero General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
 */

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
 * @property ScenariosTable $Scenarios
 * @property MigrationsParametersTable $MigrationsParameters
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

    public function getExecLine($migration_id, $exec = true){

        //Chemin de Kitchen sur le système
        $kitchen = ROOT.'/vendor/pentaho/data-integration/kitchen.sh';

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
            $tasksExecLines[$taskId] = $kitchen . " -file=" . $tasksPath[$taskId]." ".$scenario_parameters.$exec_line;

            if($exec){
                $tasksExecLines[$taskId] .= ">".LOGS."kitchen/".$migration_id."_".$taskId.".log 2>&1 & echo $! >".LOGS."kitchen/".$migration_id."_".$taskId.".pid";
            }

        }

        return $tasksExecLines;
    }

    public function allScenarioParametersFilled($id){
        $migration = $this->get($id, ['contain' => ['Scenarios']]);

        $parameters_scenarios = $this->Scenarios->ParametersScenarios->find('all')->where([
            'scenario_id' => $migration->scenario->id
        ])->count();

        $parameters_scenarios_filled = $this->Scenarios->ParametersScenarios->find('all')->where([
            'scenario_id' => $migration->scenario->id,
            'value IS NOT NULL',
            'value <> ""'
        ])->count();

        return $parameters_scenarios == $parameters_scenarios_filled;
    }
}
