<?php

namespace board\services\users;

use board\entities\User;
use board\forms\users\PasswordResetRequestForm;
use board\forms\users\ResetPasswordForm;
use Yii;
use yii\mail\MailerInterface;
use board\repositories\UserRepository;

class PasswordResetRequestService
{
    private $mailer;
    private $user;

    public function __construct(UserRepository $user, MailerInterface $mailer)
    {
        $this->user = $user;
        $this->mailer = $mailer;
    }

    public function request(PasswordResetRequestForm $form)
    {
        $user = $this->user->getByEmail($form->email);

        if (!$user->isActive()) {
            throw new \DomainException('Пользователь не активен.');
        }

        $user->requestPasswordReset();

        $this->user->save($user);

        $sent = $this
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setTo($user->email)
            ->setSubject('Сброс пароля для пользователя ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Ошибка при отправки.');
        }
    }

    public function validateToken($token)
    {
        if (empty($token) || !is_string($token)) {
            throw new \DomainException('Password reset token cannot be blank.');
        }
        if (!User::findByPasswordResetToken($token)) {

            throw new \DomainException('Wrong password reset token.');
        }
    }

    public function reset(string $token, ResetPasswordForm $form)
    {
        $user = User::findByPasswordResetToken($token);

        if (!$user) {
            throw new \DomainException('User is not found.');
        }

        $user->resetPassword($form->password);

        $this->user->save($user);
    }
}