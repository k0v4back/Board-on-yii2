<?php

namespace board\services\creative;

use board\entities\User;
use board\forms\creative\User\UserCreateForm;
use board\repositories\UserRepository;
use board\forms\creative\User\UserEditForm;

class UserManageService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password
        );
        $this->repository->save($user);
        return $user;
    }

    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email,
            $form->status,
            $form->role
        );
        $this->repository->save($user);
    }
}