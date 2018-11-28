<?php

namespace board\helpers;

use board\entities\Advert;
use board\entities\Category;
use yii\helpers\ArrayHelper;
use board\entities\Regions;

class ListHelper
{
    public static function parentCategoriesList(): array
    {
        return ArrayHelper::map(Category::find()->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }

    public static function category2()
    {
        return ArrayHelper::map(Category::find()->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', function (array $category) {
            return $category['name'];
        });
    }

    public static function category()
    {
        return ArrayHelper::map(Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }

    public static function region()
    {
        return ArrayHelper::map(Regions::find()->where(['parent_id' => null])->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', function (array $region) {
            return $region['name'];
        });
    }

    public static function city()
    {
        return ArrayHelper::map(Regions::find()->where(['>', 'parent_id', 0])->orderBy(['name' => SORT_ASC])->asArray()->all(), 'id', function (array $region) {
            return $region['name'];
        });
    }

    public static function advertStatus()
    {
        return ArrayHelper::map(Advert::find()->all(), 'status', 'status');
    }
}
