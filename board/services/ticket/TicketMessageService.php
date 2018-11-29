<?php

namespace board\services\ticket;

use board\entities\ticket\Messages;
use board\entities\ticket\Ticket;
use board\forms\ticket\TicketMessageForm;
use board\repositories\TicketRepository;

class TicketMessageService
{
    private $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function send($ticket_id, $user_id, TicketMessageForm $form)
    {
        $ticker = Messages::send(
            $form->ticket_id = $ticket_id,
            $form->user_id = $user_id,
            $form->content
        );
        $this->ticketRepository->saveMessage($ticker);
        return $ticker;
    }

}