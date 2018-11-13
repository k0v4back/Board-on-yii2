<?php

namespace board\services\users;

use board\forms\users\LoginForm;
use board\repositories\UserRepository;

class LoginService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function login(LoginForm $form)
    {
        $user = $this->users->findByUsernameOrEmail($form->username);
        if(!$user || !$user->isActive() || !$user->validatePassword($form->password)){
            throw new \DomainException('Пользователь или парол не найдены.');
        }
        return $user;
    }
}