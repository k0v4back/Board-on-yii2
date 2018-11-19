<?php

namespace board\services\users;

use board\forms\users\EditNameForm;
use board\repositories\UserRepository;

class EditNameService
{
    private $data;

    public function __construct(UserRepository $data)
    {
        $this->data = $data;
    }

    public function edit($id, EditNameForm $form)
    {
        $user = $this->data->get($id);
        $user->editUsername(
            $form->username,
            $form->last_name
        );
        $this->data->save($user);
    }
}