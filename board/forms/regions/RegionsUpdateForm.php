<?php

namespace board\forms\regions;

use board\entities\Regions;
use yii\base\Model;

class RegionsUpdateForm extends Model
{
    public $name;
    public $parent_id;
    public $slug;

    public function __construct(Regions $regions, $config = [])
    {
        $this->name = $regions->name;
        $this->parent_id = $regions->parent_id;
        $this->slug = $regions->slug;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
    }
}