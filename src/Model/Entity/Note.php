<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Note Entity
 *
 * @property int $id
 * @property int $type_id
 * @property string $title
 * @property string $keyword
 * @property string $file
 * @property string $path
 * @property string $slug
 * @property int $hit
 * @property int $rating
 * @property string $content
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Type $type
 */
class Note extends Entity
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
        'type_id' => true,
        'title' => true,
        'keyword' => true,
        'file' => true,
        'path' => true,
        'slug' => true,
        'hit' => true,
        'rating' => true,
        'content' => true,
        'important' => true,
        'created' => true,
        'modified' => true,
        'type' => true
    ];
}
