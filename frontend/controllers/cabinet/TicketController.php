<?php

namespace frontend\controllers\cabinet;

use board\entities\ticket\Messages;
use board\entities\ticket\Ticket;
use board\entities\User;
use board\forms\ticket\TicketForm;
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

    public function actionIndex($user_id)
    {
        $tickets = Ticket::find()->where(['user_id' => $user_id])->orderBy(['id' => SORT_DESC])->all();

        return $this->render('index', [
            'tickets' => $tickets,
        ]);
    }

    public function actionCreate($user_id)
    {
        $tickets = Ticket::find()->where(['user_id' => $user_id]);

        $form = new TicketForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->ticketService->create($user_id, $form);
                Yii::$app->session->setFlash('success', 'Ваше заявка успешно создана, теперь напишите админу.');
                return $this->redirect(['cabinet/ticket/index', 'user_id' => $user_id]);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('danger', 'Возникла ошибка при создании заявки' . $e);
                return $this->redirect(['cabinet/ticket/index', 'user_id' => $user_id]);
            }
        }

        return $this->render('createTicket', [
            'model' => $form,
        ]);
    }

    public function actionMessages($ticket)
    {
        $tickets = Messages::find()->where(['ticket_id' => $ticket]);
        $user_id = Yii::$app->user->identity->id;
        $form = new TicketMessageForm();

        $messages = Messages::find()->where(['ticket_id' => $ticket])->all();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->ticketMessageService->send($ticket, $user_id, $form);
                Yii::$app->session->setFlash('success', 'Ваше сообщение успешно отправлено админу.');
                return $this->redirect(['cabinet/ticket/messages', 'ticket' => $ticket]);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('danger', 'Возникла ошибка при отправки сообщения админу' . $e);
                return $this->redirect(['cabinet/ticket/messages', 'ticket' => $ticket]);
            }
        }

        return $this->render('sendMessage', [
            'model' => $form,
            'messages' => $messages,
        ]);
    }

    public static function user($id)
    {
        return User::find()->where(['id' => $id])->all();
    }
}