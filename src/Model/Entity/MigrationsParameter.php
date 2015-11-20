<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MigrationsParameter Entity.
 *
 * @property int $id
 * @property int $migration_id
 * @property \App\Model\Entity\Migration $migration
 * @property int $task_id
 * @property int $parameter_id
 * @property \App\Model\Entity\Parameter $parameter
 * @property string $value
 */
class MigrationsParameter extends Entity
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
