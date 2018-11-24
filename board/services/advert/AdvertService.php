<?php

namespace board\services\advert;

use board\entities\Advert;
use board\entities\Photo;
use board\entities\Regions;
use board\forms\advert\AdvertForm;
use board\forms\photo\PhotoForm;
use board\repositories\AdvertRepository;
use board\repositories\PhotoRepository;

class AdvertService
{
    private $repositoryAdvert;
    private $photoRepository;

    public function __construct(AdvertRepository $repositoryAdvert, PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
        $this->repositoryAdvert = $repositoryAdvert;
    }

    public function create(AdvertForm $form)
    {
        $advert = Advert::crete(
            $form->user_id,
            $form->category_id,
            $form->title,
            $form->price,
            $form->content,
            $form->address,
            $form->region_id,
            $form->city,
            $form->reject_reason
        );
        $this->repositoryAdvert->save($advert);
        return $advert;
    }

    public function uploadPhoto($advert_id, PhotoForm $form)
    {
        $photo = Photo::upload(
            $advert_id,
            $form->name
            );
        $this->photoRepository->save($photo);
        return $photo;
    }

    public function getParentId($id)
    {
        static $new_mas = array();
        foreach (Regions::find()->where(['id' => $id])->all() as $key => $litle3){
            if($litle3->parent_id){
                $new_mas[] = $litle3->parent_id;
                $this->getParentId($litle3->parent_id);
            }
            return $new_mas;
        }
    }
}