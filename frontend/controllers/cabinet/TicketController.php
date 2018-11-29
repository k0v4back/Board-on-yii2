<?php

namespace frontend\controllers\cabinet;

use board\entities\ticket\Ticket;
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
        $tickets = Ticket::find()->where(['user_id' => $user_id])->all();

        return $this->render('index', [
            'tickets' => $tickets,
        ]);
    }

    public function actionSend($user_id)
    {
        $tickets = Ticket::find()->where(['user_id' => $user_id]);

        $form = new TicketMessageForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->ticketMessageService->send($user_id, $form);
                Yii::$app->session->setFlash('success', 'Ваше сообщение успешно отправлено админу.');
                return $this->redirect(['cabinet/ticket/index', 'user_id' => $user_id]);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('danger', 'Возникла ошибка при отправки сообщения админу'. $e);
                return $this->redirect(['cabinet/ticket/index', 'user_id' => $user_id]);
            }
        }


            return $this->render('sendMessage', [
            'model' => $form,
        ]);
    }
}