<?php

namespace board\repositories;

use board\entities\Advert;
use board\forms\search\SearchForm;

class SearchAdvertRepository
{
    public function search(SearchForm $form)
    {
        $query = Advert::find();
        $query->andFilterWhere(['like', 'content', $form->content])
            ->andFilterWhere(['like', 'title', $form->title])
            ->andFilterWhere(['like', 'category_id', $form->category])
            ->andFilterWhere(['like', 'region_id', $form->region])
            ->orderBy(['id' => SORT_DESC])
            ->all();
        return $query->all();
    }
}