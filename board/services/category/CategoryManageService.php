<?php

namespace board\services\category;

use board\entities\Category;
use board\repositories\CategoriesRepository;
use board\forms\categories\CategoriesForm;

class CategoryManageService
{
    private $categories;

    public function __construct(CategoriesRepository $categories)
    {
        $this->categories = $categories;
    }

    public function create(CategoriesForm $form)
    {
        $parent = $this->categories->get($form->parentId);
        $category = Category::create(
            $form->parentId,
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            $form->lft,
            $form->rgt,
            $form->depth
        );
        $category->appendTo($parent);
        $this->categories->save($category);
        return $category;
    }

    public function edit($id, $form)
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        $category->edit(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            $form->lft,
            $form->rgt,
            $form->depth
        );
        if ($form->parentId !== 0) {
            $parent = $this->categories->get($form->parentId);
            $category->appendTo($parent);
        }
        $this->categories->save($category);
//        var_dump($category->parent);die();
    }

    public function remove($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        $this->categories->remove($category);
    }

    private function assertIsNotRoot(Category $category): void
    {
        if ($category->isRoot()) {
            throw new \DomainException('Нету root категории.');
        }
    }
}