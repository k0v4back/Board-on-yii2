<?php

namespace board\entities;
use phpDocumentor\Reflection\Types\Static_;
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
    const STATUS_DRAFT = 0;
    const STATUS_MODERATION = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_CLOSED = 3;

    public static function crete($user_id, $category_id, $title, $price, $content, $address, $region_id = null, $updated_at = null, $published_at= null) : Advert
    {
        $advert = new static();
        $advert->user_id = $user_id;
        $advert->category_id = $category_id;
        $advert->title = $title;
        $advert->price = $price;
        $advert->content = $content;
        $advert->status = self::STATUS_DRAFT;
        $advert->created_at = time();
        $advert->updated_at = $updated_at;
        $advert->published_at = $published_at;
        $advert->expired_at = time() + (30 * 24 * 60 * 60); // 30 days
        $advert->region_id = $region_id;
        $advert->address = $address;
        return $advert;
    }

    public function edit($category_id, $title, $price, $content, $region_id = null, $address = null)
    {
        $this->category_id = $category_id;
        $this->title = $title;
        $this->price = $price;
        $this->content = $content;
        $this->updated_at = time();
        $this->region_id = $region_id;
        $this->address = $address;
    }


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
