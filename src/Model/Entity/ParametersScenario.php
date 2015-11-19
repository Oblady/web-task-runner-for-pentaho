<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ParametersScenario Entity.
 *
 * @property int $id
 * @property int $parameter_id
 * @property \App\Model\Entity\Parameter $parameter
 * @property int $scenario_id
 * @property \App\Model\Entity\Scenario $scenario
 * @property string $value
 */
class ParametersScenario extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
