<?php

namespace board\services\advert;

use board\entities\Advert;
use board\entities\Photo;
use board\forms\advert\AdvertForm;
use board\forms\photo\PhotoForm;
use board\forms\profile\UploadAvatarForm;
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
}