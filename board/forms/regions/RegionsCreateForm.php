<?php
namespace board\forms\regions;

use yii\base\Model;

class RegionsCreateForm extends Model
{
    public $name;
    public $parent_id;
    public $slug;

    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'unique', 'targetClass' => '\board\entities\Regions', 'message' => 'Это имя уже занято.'],
            ['slug', 'unique', 'targetClass' => '\board\entities\Regions', 'message' => 'Этот слаг уже занят.'],
            [['parent_id'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
    }
}
