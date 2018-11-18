<?php

namespace board\forms\categories;

use board\entities\Category;
use board\validators\SlugValidator;
use yii\base\Model;

class CategoriesUpdateForm extends Model
{
    public $name;
    public $slug;
    public $title;
    public $description;
    public $lft;
    public $rgt;
    public $depth;

    public $parentId;

    private $_category;

    public function __construct(Category $categories = null, $config = [])
    {
        if($categories){
            $this->name = $categories->name;
            $this->slug = $categories->slug;
            $this->title = $categories->title;
            $this->description = $categories->description;
            $this->lft = $categories->lft;
            $this->rgt = $categories->rgt;
            $this->depth = $categories->depth;
            $this->parentId = $categories->parent ? $categories->parent->id : null;
        }

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'slug', 'lft', 'rgt', 'depth'], 'required'],
            [['description'], 'string'],
            [['parentId'], 'integer'],
            [['lft', 'rgt', 'depth'], 'integer'],
            [['name', 'slug', 'title'], 'string', 'max' => 255],
        ];
    }

}