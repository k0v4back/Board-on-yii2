<?php

namespace board\entities;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "advert".
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property int $region_id
 * @property string $title
 * @property int $price
 * @property string $address
 * @property string $content
 * @property int $status
 * @property string $reject_reason
 * @property int $created_at
 * @property int $updated_at
 * @property int $published_at
 * @property int $expired_at
 *
 * @property Category $category
 * @property Regions $region
 * @property User $user
 */
class Advert extends ActiveRecord
{
    
    public static function tableName()
    {
        return '{{%advert}}';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getRegion()
    {
        return $this->hasOne(Regions::class, ['id' => 'region_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
