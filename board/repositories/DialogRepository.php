<?php

namespace board\repositories;

use board\entities\dialog\Dialog;

class DialogRepository
{
    public function get($id): Dialog
    {
        if(!$dialog = Dialog::findOne($id)){
            throw new \DomainException('Диалог не найден.');
        }
        return $dialog;
    }

    public function save(Dialog $id)
    {
        if(!$dialog = Dialog::findOne($id)){
            throw new \RuntimeException('Ошибка сохранения диалога.');
        }
    }
}