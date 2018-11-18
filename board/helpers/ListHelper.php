<?php

namespace board\helpers;

class ListHelper
{
    public static function parentCategoriesList(): array
    {
        return \yii\helpers\ArrayHelper::map(\board\entities\Category::find()->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }
}
