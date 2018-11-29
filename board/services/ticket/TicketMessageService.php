<?php

namespace board\services\category;

use board\entities\ticket\Ticket;
use board\forms\ticket\TicketForm;
use board\forms\ticket\TicketMessageForm;
use board\repositories\TicketRepository;

class TicketMessageService
{
    private $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function send(TicketMessageForm $form)
    {
        $ticker = Ticket::create(
            $form->user_id,
            $form->ticket_id,
            $form->content
        );
        $this->ticketRepository->save($ticker);
        return $ticker;
    }

}