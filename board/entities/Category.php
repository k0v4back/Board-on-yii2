<?php

namespace board\entities;

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
 */
class Category extends \yii\db\ActiveRecord
{
    public static function create($id, $name, $slug, $title, $description, $lft, $rgt, $depth)
    {
        $category = new static();
        $category->id = $id;
        $category->name = $name;
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->lft = $lft;
        $category->rgt = $rgt;
        $category->depth = $depth;
        return $category;
    }

    public static function edit($id, $name, $slug, $title, $description, $lft, $rgt, $depth)
    {
        $category = new static();
        $category->id = $id;
        $category->name = $name;
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->lft = $lft;
        $category->rgt = $rgt;
        $category->depth = $depth;
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
