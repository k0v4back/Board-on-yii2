<?php

namespace board\repositories;

use board\entities\ticket\Ticket;
use DomainException;

class TicketRepository
{
    public function get($id): Ticket
    {
        if(!$ticket = Ticket::findOne($id)){
            throw new DomainException('Заявка не найдена');
        }
        return $ticket;
    }

    public function save(Ticket $ticket)
    {
        if (!$ticket->save()) {
            throw new \RuntimeException('Ошибка добавления заявки');
        }
    }

    public function remove(Ticket $ticket): void
    {
        if (!$ticket->delete()) {
            throw new \RuntimeException('Ошибка удаления заявки');
        }
    }
}