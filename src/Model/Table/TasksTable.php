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

        $this->belongsTo('Tasks', [
            'foreignKey' => 'task_id'
        ]);

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

        $this->hasMany('MigrationsParameters');
        $this->hasMany('ParametersTasks');
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
        $rules->add($rules->existsIn(['task_id'], 'Tasks'));
        return $rules;
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

    /**
     * @param $id int The migration_id to check
     * @param $task_id int The task_id to check
     * @return bool Whether all tasks parameters has been filled or not.
     */
    public function allTaskParametersFilled($id, $task_id){
        $nb_param = $this->ParametersTasks->find('all')->where(['task_id' => $task_id])->count();
        $nb_filled = $this->MigrationsParameters->find('all')->where([
            'task_id' => $task_id,
            'migration_id' => $id,
            'value IS NOT NULL',
            'value <> ""'
        ])->count();

        return $nb_param === $nb_filled;
    }
}
