<?php

namespace board\repositories;

use board\entities\Advert;
use board\forms\search\SearchForm;

class SearchAdvertRepository
{
    public function search(SearchForm $form)
    {
        $query = Advert::find();
        $query->andFilterWhere(['like', 'content', $form->content])->orderBy(['id' => SORT_DESC])->all();
        return $query->all();
    }
}