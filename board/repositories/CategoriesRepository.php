<?php

namespace board\repositories;

use board\entities\Category;
use DomainException;

class CategoriesRepository
{
    public function get($id): Category
    {
        if(!$category = Category::findOne($id)){
            throw new DomainException('Категоря не найдена');
        }
        return $category;
    }

    public function save(Category $category)
    {
        if (!$category->save()) {
            throw new \RuntimeException('Ошибка сохранения категории.');
        }
    }

    public function remove(Category $category): void
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Ошибка при удалении.');
        }
    }
}