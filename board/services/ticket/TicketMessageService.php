<?php

namespace board\services\ticket;

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

    public function send($user_id, TicketMessageForm $form)
    {
        $ticker = Ticket::create(
            $form->user_id = $user_id,
            $form->subject,
            $form->content
        );
        $this->ticketRepository->save($ticker);
        return $ticker;
    }

}