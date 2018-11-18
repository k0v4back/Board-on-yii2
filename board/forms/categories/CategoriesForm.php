<?php

namespace board\forms\categories;

use board\entities\Category;
use board\validators\SlugValidator;
use yii\base\Model;

class CategoriesForm extends Model
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
            $categories->name = $this->name;
            $categories->slug = $this->slug;
            $categories->title = $this->title;
            $categories->description = $this->description;
            $categories->lft = $this->lft;
            $categories->rgt = $this->rgt;
            $categories->depth = $this->depth;
            $this->parentId = $categories->parent ? $categories->parent->id : 1;
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
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Category::class, 'filter' => $this->_category ? ['<>', 'id', $this->_category->id] : null]

        ];
    }

}