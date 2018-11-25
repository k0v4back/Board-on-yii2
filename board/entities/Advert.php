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
 * @property int $city
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

    public static function crete($user_id, $category_id, $title, $price, $content, $address, $region_id, $city, $updated_at = null, $published_at = null) : Advert
    {
        $advert = new static();
        $advert->user_id = $user_id;
        $advert->category_id = $category_id;
        $advert->title = $title;
        $advert->price = $price;
        $advert->content = $content;
        $advert->address = $address;
        $advert->region_id = $region_id;
        $advert->city = $city;
        $advert->status = self::STATUS_DRAFT;
        $advert->created_at = time();
        $advert->updated_at = $updated_at;
        $advert->published_at = $published_at;
        $advert->expired_at = time() + (30 * 24 * 60 * 60); // 30 days
        return $advert;
    }

    public function edit($category_id, $region_id, $city, $address, $title, $price, $content)
    {
        $this->category_id = $category_id;
        $this->region_id = $region_id;
        $this->city = $city;
        $this->address = $address;
        $this->title = $title;
        $this->price = $price;
        $this->content = $content;
        $this->updated_at = time();
    }


    public static function tableName()
    {
        return '{{%advert}}';
    }

    public static function addFavorites($currentUser, Advert $advert)
    {
        $redis = \Yii::$app->redis;
        $redis->sadd("user:{$currentUser}:favoriteAdvert", $advert->id);
    }

    public static function deleteFavorites($currentUser, Advert $advert)
    {
        $redis = \Yii::$app->redis;
        $redis->srem("user:{$currentUser}:favoriteAdvert", $advert->id);
    }

    public static function getFavorites()
    {
        $redis = \Yii::$app->redis;
        $currentUser = \Yii::$app->user->identity->id;
        $key = "user:{$currentUser}:favoriteAdvert";
        $ids = $redis->smembers($key);
        return Advert::find()->where(['id' => $ids])->orderBy('title')->asArray()->all();
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
