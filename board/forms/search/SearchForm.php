<?php

namespace board\forms\search;

use board\entities\Category;
use board\entities\Regions;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class SearchForm extends Model
{
    public $content;
    public $title;
    public $region;
    public $category;

    public function rules(): array
    {
        return [
            [['content', 'title'], 'string'],
            [['region', 'category'], 'integer'],
        ];
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }

    public function brandsList(): array
    {
        return ArrayHelper::map(Regions::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public function formName()
    {
        return '';
    }
}