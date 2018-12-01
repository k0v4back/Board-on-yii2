<?php

namespace board\services\dialog;

use board\entities\dialog\Dialog;
use board\forms\dialog\DialogForm;
use board\forms\dialog\MessagesForm;
use board\repositories\DialogRepository;

class DialogService
{
    private $dialogRepository;

    public function __construct(DialogRepository $dialogRepository)
    {
        $this->dialogRepository = $dialogRepository;
    }

//    public function createDialog($id, DialogForm $form)
//    {
//        $dialog = $this->dialogRepository->get($id);
//        $createDialog = Dialog::
//    }

    public function createMessage($id, MessagesForm $form)
    {
        $message = $this->dialogRepository->get($id);
        $message->writeMessage(\Yii::$app->user->getId(), $form->message);

    }
}
