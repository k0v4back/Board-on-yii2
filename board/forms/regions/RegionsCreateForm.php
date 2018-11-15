<?php
namespace board\forms\regions;

use board\entities\Regions;
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
            [['parent_id'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
    }
}
