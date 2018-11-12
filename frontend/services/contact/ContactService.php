<?php

namespace frontend\services\contact;

use frontend\forms\ContactForm;
use Yii;

class ContactService
{
    private $adminEmail;

    public function __construct($adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    public function send(ContactForm $form)
    {
        $sent = Yii::$app->mailer->compose()
            ->setTo($this->adminEmail)
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if(!$sent){
            throw new \RuntimeException('Ошибка отправления письма');
        }
    }
}