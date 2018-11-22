<?php

namespace board\services\advert;

use board\entities\Advert;
use board\forms\advert\AdvertForm;
use board\repositories\AdvertRepository;

class AdvertService
{
    private $repository;

    public function __construct(AdvertRepository $repository)
    {
        $this->repository = $repository;
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
        $this->repository->save($advert);
        return $advert;
    }
}