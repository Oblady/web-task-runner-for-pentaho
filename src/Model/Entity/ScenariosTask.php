<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ScenariosTask Entity.
 *
 * @property int $id
 * @property int $scenario_id
 * @property \App\Model\Entity\Scenario $scenario
 * @property int $task_id
 * @property \App\Model\Entity\Task $task
 * @property int $order
 */
class ScenariosTask extends Entity
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
