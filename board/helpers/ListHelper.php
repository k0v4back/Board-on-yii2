<?php

namespace board\helpers;

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

    public static function category()
    {
        return ArrayHelper::map(Category::find()->asArray()->all(), 'id', function (array $category) {
            return $category['name'];
        });
    }

    public static function region()
    {
        return ArrayHelper::map(Regions::find()->asArray()->all(), 'id', function (array $region) {
            return $region['name'];
        });
    }
}
