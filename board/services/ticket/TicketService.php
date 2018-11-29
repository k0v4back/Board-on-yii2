<?php

namespace board\services\category;

use board\entities\ticket\Ticket;
use board\forms\ticket\TicketEditForm;
use board\forms\ticket\TicketEditStatusForm;
use board\forms\ticket\TicketForm;
use board\repositories\TicketRepository;

class TicketService
{
    private $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function create(TicketForm $form)
    {
        $ticker = Ticket::create(
            $form->user_id,
            $form->subject,
            $form->content
        );
        $this->ticketRepository->save($ticker);
        return $ticker;
    }

    public function edit($id, TicketEditForm $editForm)
    {
        $ticket = $this->ticketRepository->get($id);
        $ticket->edit(
            $editForm->subject,
            $editForm->content
        );
        $this->ticketRepository->save($ticket);
    }

    public function editStatus($id, TicketEditStatusForm $form)
    {
        $ticket = $this->ticketRepository->get($id);
        $ticket->editStatus(
            $form->status
        );
        $this->ticketRepository->save($ticket);
    }


}