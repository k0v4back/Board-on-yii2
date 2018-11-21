<?php

namespace board\services\users;

use board\forms\profile\EditNameForm;
use board\forms\profile\EditPhoneForm;
use board\repositories\UserRepository;

class EditProfileService
{
    public $smsRuService;
    private $data;

    public function __construct(UserRepository $data, SmsRuService $smsRuService)
    {
        $this->smsRuService = $smsRuService;
        $this->data = $data;
    }

    public function editName($id, EditNameForm $form)
    {
        $user = $this->data->get($id);
        $user->editUsername(
            $form->username,
            $form->last_name
        );
        $this->data->save($user);
    }

    public function editPhone($id, EditPhoneForm $form)
    {
        $user = $this->data->get($id);

        $oldPhone = $user->phone;
        $phone = $form->phone;

        if($phone !== $oldPhone){
            $user->clearPhoneVerification();
        }

        $user->editPhone($form->phone);
        $this->data->save($user);
    }

    public function code($id)
    {

        $user = $this->data->get($id);

        $code = \Yii::$app->security->generateRandomString(6);

        $user->generatePhoneVerifiedCode($code);
        $this->data->save($user);
        $this->smsRuService->send($user->phone, $code);

    }

    public function verifiedCode($codeForm, $id)
    {
        $user = $this->data->get($id);
        $dbCode = $user->code;

//        echo $dbCode.'<br>';
//        echo $codeForm;die();

        if($codeForm === $dbCode)
        {
            $user->phoneVerification();
            $user->clearCode();
            $this->data->save($user);
            return \Yii::$app->getResponse()->redirect(array('cabinet/profile/index?id='.$id));
        }else{
            $user->clearPhoneVerification();
            $this->data->save($user);
            $time = $user->phone_verified_token_expire - time();
            \Yii::$app->session->setFlash('danger', 'Вы ввели неверный код подтверждыения<br>Если вам не пришло сообщение, то через ' . $time . ' секунд вы можете сгенерировать ещё один код');
        }
    }
}