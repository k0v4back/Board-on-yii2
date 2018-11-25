<?php

namespace board\forms\advert;

use board\entities\Advert;
use board\entities\Category;
use board\entities\Regions;
use board\entities\User;
use yii\base\Model;

class AdvertEditForm extends Model
{
    public $category_id;
    public $region_id;
    public $title;
    public $price;
    public $address;
    public $content;
    public $city;

    public function __construct(Advert $advert, $config = [])
    {
        $this->category_id = $advert->category_id;
        $this->region_id = $advert->region_id;
        $this->title = $advert->title;
        $this->price = $advert->price;
        $this->address = $advert->address;
        $this->content = $advert->content;
        $this->city = $advert->city;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['city'], 'integer'],
            [['category_id'], 'integer'],
            [['region_id'], 'integer'],
            [['title'], 'string'],
            [['price'], 'integer'],
            [['address'], 'string'],
            [['content'], 'string'],
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