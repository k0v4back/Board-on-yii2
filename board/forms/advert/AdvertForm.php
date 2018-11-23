<?php

namespace board\forms\advert;

use board\entities\Category;
use board\entities\Regions;
use board\entities\User;
use yii\base\Model;

class AdvertForm extends Model
{
    public $id;
    public $user_id;
    public $category_id;
    public $region_id;
    public $title;
    public $price;
    public $address;
    public $content;
    public $status;
    public $created_at;
    public $city;
    public $updated_at;
    public $published_at;
    public $expired_at;
    public $reject_reason;

    public function rules()
    {
        return [
//            [['user_id', 'category_id', 'title', 'price', 'content', 'status', 'created_at', 'updated_at', 'published_at', 'expired_at'], 'required'],
            [['user_id', 'category_id', 'title', 'price', 'content', 'region', 'city'], 'required'],
            [['user_id', 'category_id', 'region_id', 'price', 'status', 'created_at', 'updated_at', 'published_at', 'expired_at'], 'integer'],
            [['content', 'reject_reason', 'city'], 'string'],
            [['title'], 'string', 'max' => 150],
            [['address'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::class, 'targetAttribute' => ['region_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'region_id' => 'Region ID',
            'title' => 'Title',
            'price' => 'Price',
            'address' => 'Address',
            'content' => 'Content',
            'status' => 'Status',
            'reject_reason' => 'Reject Reason',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'published_at' => 'Published At',
            'expired_at' => 'Expired At',
            'city' => 'City',
        ];
    }
}