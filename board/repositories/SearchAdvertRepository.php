<?php

namespace board\repositories;

use board\entities\Advert;
use board\entities\Category;
use board\forms\search\SearchForm;
use yii\helpers\ArrayHelper;

class SearchAdvertRepository
{
    public function search(SearchForm $form)
    {
        $categoryIds = Category::findOne(['id' => $form->category]);
        $query = Advert::find()->where(['status' => Advert::STATUS_ACTIVE]);

        if($category = $form->category){
            $categoryIds = ArrayHelper::merge([$form->category], $categoryIds->getChildren()->select('id')->column());
            $query->andWhere(['category_id' => $categoryIds]);
        }

        $query->andFilterWhere(['like', 'content', $form->content])
            ->andFilterWhere(['like', 'title', $form->title])
            ->andFilterWhere(['like', 'region_id', $form->region])
            ->orderBy(['id' => SORT_DESC])
            ->all();
        return $query->all();
    }
}