<?php

namespace board\entities;

use Yii;
use yii\helpers\Inflector;

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

    public static function addRegion($name, $parent_id, $slug = null)
    {
        $region = new static();
        $region->name = $name;
        $region->parent_id = $parent_id;
        if($slug) $region->slug = $slug ; $region->slug = Inflector::slug($name);
        return $region;
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
