<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StepProcessing Entity
 *
 * @property int $id
 * @property string $uid
 * @property string $step_status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class StepProcessing extends Entity
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
        'uid' => true,
        'step_status' => true,
        'created' => true,
        'modified' => true
    ];
}
