<?php

namespace board\services\users;

use board\forms\profile\EditNameForm;
use board\forms\profile\EditPhoneForm;
use board\forms\profile\VerifiedCodeForm;
use board\repositories\UserRepository;

class EditProfileService
{
    private $data;

    public function __construct(UserRepository $data)
    {
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
    }

    public function verifiedCode($codeForm, $id)
    {
        $user = $this->data->get($id);
        $dbCode = $user->code;

//        if($codeForm === $dbCode)
//        {
//            echo "Good";die();
//        }else{
//            echo "False";die();
//        }

//        var_dump($codeForm);die();
    }
}