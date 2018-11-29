<?php

namespace board\repositories;

use board\entities\ticket\Messages;
use DomainException;

class MessageMessageRepository
{
    public function get($id): Messages
    {
        if(!$message = Messages::findOne($id)){
            throw new DomainException('Сообщение не найдено');
        }
        return $message;
    }

    public function save(Messages $message)
    {
        if (!$message->save()) {
            throw new \RuntimeException('Ошибка при отправки сообщения');
        }
    }

    public function remove(Messages $message): void
    {
        if (!$message->delete()) {
            throw new \RuntimeException('Ошибка при удалении сообщения');
        }
    }
}