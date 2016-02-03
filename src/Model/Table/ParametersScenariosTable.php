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

use App\Model\Entity\ParametersScenario;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ParametersScenarios Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Parameters
 * @property \Cake\ORM\Association\BelongsTo $Scenarios
 */
class ParametersScenariosTable extends Table
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

        $this->table('parameters_scenarios');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Parameters', [
            'foreignKey' => 'parameter_id'
        ]);
        $this->belongsTo('Scenarios', [
            'foreignKey' => 'scenario_id'
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
            ->allowEmpty('value');

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
        $rules->add($rules->existsIn(['parameter_id'], 'Parameters'));
        $rules->add($rules->existsIn(['scenario_id'], 'Scenarios'));
        return $rules;
    }
}
