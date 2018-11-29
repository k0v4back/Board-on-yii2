<?php

namespace board\helpers;

use board\entities\ticket\Status;
use board\entities\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class HistoryHelper
{
    public static function statusList(): array
    {
        return [
            Status::OPEN => 'Открыто',
            Status::APPROVED => 'Одобрено',
            Status::CLOSED => 'Закрыто',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Status::OPEN:
                $class = 'label label-primary';
                break;
            case Status::APPROVED;
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