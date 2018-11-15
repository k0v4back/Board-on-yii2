<?php
namespace board\forms\regions;

use board\entities\Regions;
use yii\base\Model;

class RegionsForm extends Model
{
    public $name;
    public $parent_id;
    public $slug;

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['parent_id'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['slug'], 'unique'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'parent_id' => 'Parent ID',
        ];
    }
}
