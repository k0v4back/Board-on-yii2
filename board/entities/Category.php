<?php

namespace board\entities;

use paulzi\nestedsets\NestedSetsBehavior;
use board\entities\queries\CategoryQuery;

/**
 * This is the model class for table "borad_categories".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property int $parentId
 *
 * @property Category $prev
 * @property Category $next
 *
 * @property Category $parent
 * @mixin NestedSetsBehavior
 */
class Category extends \yii\db\ActiveRecord
{
    public static function create($parentId, $name, $slug, $title, $description, $lft, $rgt, $depth)
    {
        $category = new static();
        $category->parentId = $parentId;
        $category->name = $name;
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->lft = $lft;
        $category->rgt = $rgt;
        $category->depth = $depth;
        return $category;
    }

    public function edit($name, $slug, $title, $description, $lft, $rgt, $depth): void
    {
        $category = new static();
        $category->name = $name;
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->lft = $lft;
        $category->rgt = $rgt;
        $category->depth = $depth;
    }

    public function behaviors(): array
    {
        return [
            NestedSetsBehavior::class,
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): CategoryQuery
    {
        return new CategoryQuery(static::class);
    }

    public static function tableName()
    {
        return '{{%borad_categories}}';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'title' => 'Title',
            'description' => 'Description',
            'meta_json' => 'Meta Json',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
        ];
    }
}
