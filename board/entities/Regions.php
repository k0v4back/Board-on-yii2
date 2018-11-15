<?php

namespace board\entities;

use Yii;

/**
 * This is the model class for table "regions".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $parent_id
 *
 * @property Regions $parent
 * @property Regions[] $regions
 */
class Regions extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%regions}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Regions::class, ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Regions::class, ['parent_id' => 'id']);
    }
}
