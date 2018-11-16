<?php

namespace board\services\regions;

use board\entities\Regions;
use board\forms\regions\RegionsCreateForm;
use board\forms\regions\RegionsUpdateForm;
use board\repositories\RegionsRepository;
use yii\helpers\ArrayHelper;

class RegionsService
{
    private $regionRespository;

    public function __construct(RegionsRepository $regionRespository)
    {
        $this->regionRespository = $regionRespository;
    }

    public function create(RegionsCreateForm $form)
    {
        $region = Regions::addRegion(
            $form->name,
            $form->parent_id,
            $form->slug
        );
        $this->regionRespository->save($region);
        return $region;
    }

    public function edit($id, RegionsUpdateForm $form): void
    {
        $region = $this->regionRespository->get($id);
        $region->edit(
            $form->name,
            $form->parent_id,
            $form->slug
        );
        $this->regionRespository->save($region);
    }

    public function settlements()
    {
        $regions = Regions::find()->all();
        $data1 = ArrayHelper::index($regions, 'id');
        return ArrayHelper::getColumn($data1, 'name');
    }
}