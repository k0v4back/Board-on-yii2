<?php

namespace board\forms\categories;

use board\entities\Category;
use yii\base\Model;
use yii\helpers\ArrayHelper;

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
            $this->name = $categories->name;
            $this->slug = $categories->slug;
            $this->title = $categories->title;
            $this->description = $categories->description;
            $this->lft = $categories->lft;
            $this->rgt = $categories->rgt;
            $this->depth = $categories->depth;
            $this->parentId = $categories->parent ? $categories->parent->id : null;
            $this->_category = $categories;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['description'], 'string'],
            [['parentId'], 'integer'],
            [['name', 'slug', 'title'], 'string', 'max' => 255],
            [['name', 'slug'], 'unique', 'targetClass' => Category::class, 'filter' => $this->_category ? ['<>', 'id', $this->_category->id] : null]
        ];
    }

}