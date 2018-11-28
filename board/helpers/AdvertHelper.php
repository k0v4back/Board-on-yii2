<?php

namespace board\helpers;

use board\entities\Advert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class AdvertHelper
{
    public static function statusList(): array
    {
        return [
            Advert::STATUS_DRAFT => 'Черновик',
            Advert::STATUS_MODERATION => 'Модерация',
            Advert::STATUS_ACTIVE => 'Активно',
            Advert::STATUS_CLOSED => 'Закрыто',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Advert::STATUS_DRAFT:
                $class = 'label label-warning';
                break;
            case Advert::STATUS_MODERATION:
                $class = 'label label-default';
                break;
            case Advert::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-danger';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}