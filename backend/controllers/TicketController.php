<?php

namespace backend\controllers;

use board\entities\ticket\Messages;
use board\entities\ticket\Status;
use board\entities\ticket\Ticket;
use board\entities\User;
use board\forms\ticket\TicketMessageForm;
use board\services\ticket\TicketMessageService;
use board\services\ticket\TicketService;
use yii\web\Controller;
use Yii;

class TicketController extends Controller
{
    private $ticketService;
    private $ticketMessageService;

    public function __construct($id, $module, TicketService $ticketService, TicketMessageService $ticketMessageService, $config = [])
    {
        $this->ticketService = $ticketService;
        $this->ticketMessageService = $ticketMessageService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect('/user/login/login');
        }

        $tickets = Ticket::find()->orderBy(['id' => SORT_DESC])->all();

        return $this->render('index', [
            'tickets' => $tickets,
        ]);
    }

    public function actionMessages($ticket)
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect('/user/login/login');
        }

        $tickets = Messages::find()->where(['ticket_id' => $ticket]);
        $user_id = Yii::$app->user->identity->id;
        $form = new TicketMessageForm();
        $history = Status::find()->where(['ticket_id' => $ticket])->all();
        $lastHistory = Status::find()->where(['ticket_id' => $ticket])->orderBy(['id' => SORT_DESC])->one();

        $messages = Messages::find()->where(['ticket_id' => $ticket])->all();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->ticketMessageService->send($ticket, $user_id, $form);
                Yii::$app->session->setFlash('success', 'Ваше сообщение успешно отправлено Пользователю.');
                return $this->redirect(['ticket/messages', 'ticket' => $ticket]);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('danger', 'Возникла ошибка при отправки сообщения админу' . $e);
                return $this->redirect(['.ticket/messages', 'ticket' => $ticket]);
            }
        }

        return $this->render('sendMessage', [
            'model' => $form,
            'messages' => $messages,
            'history' => $history,
            'lastHistory' => $lastHistory,
            'ticket' => $ticket,
        ]);
    }

    public function actionOpen($ticket)
    {
        $user_id = Status::find()->where(['ticket_id' => $ticket])->orderBy(['id' => SORT_DESC])->one();
        $this->ticketOpen($ticket, $user_id->user_id);
        Yii::$app->session->setFlash('success', 'Статус обновлён.');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionApproved($ticket)
    {
        $user_id = Status::find()->where(['ticket_id' => $ticket])->orderBy(['id' => SORT_DESC])->one();
        $this->ticketApproved($ticket, $user_id->user_id);
        Yii::$app->session->setFlash('success', 'Статус обновлён.');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionClose($ticket)
    {
        $user_id = Status::find()->where(['ticket_id' => $ticket])->orderBy(['id' => SORT_DESC])->one();
        $this->ticketClose($ticket, $user_id->user_id);
        Yii::$app->session->setFlash('success', 'Статус обновлён.');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public static function user($id)
    {
        return User::find()->where(['id' => $id])->all();
    }


    //------------------------------------------------------------------------------------------------------------------
    public function ticketOpen($ticket_id, $user_id)
    {
        $ticket = new Status();
        $ticket->ticket_id = $ticket_id;
        $ticket->user_id = $user_id;
        $ticket->created_at = time();
        $ticket->status = Status::OPEN;
        $ticket->save();
    }

    public function ticketApproved($ticket_id, $user_id)
    {
        $ticket = new Status();
        $ticket->ticket_id = $ticket_id;
        $ticket->user_id = $user_id;
        $ticket->created_at = time();
        $ticket->status = Status::APPROVED;
        $ticket->save();
    }

    public function ticketClose($ticket_id, $user_id)
    {
        $ticket = new Status();
        $ticket->ticket_id = $ticket_id;
        $ticket->user_id = $user_id;
        $ticket->created_at = time();
        $ticket->status = Status::CLOSED;
        $ticket->save();
    }

}