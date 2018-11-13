<?php

namespace frontend\controllers\user;

use board\forms\users\PasswordResetRequestForm;
use board\forms\users\ResetPasswordForm;
use board\services\users\PasswordResetRequestService;
use board\services\users\SignupService;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;

class ResetController extends Controller
{
    private $passwordResetRequestService;
    private $signupService;

    public function __construct($id, $module, PasswordResetRequestService $passwordResetRequestService, SignupService $signupService, $config = [])
    {
        $this->passwordResetRequestService = $passwordResetRequestService;
        $this->signupService = $signupService;
        parent::__construct($id, $module, $config);
    }

    public function actionConfirm($token)
    {
        try {
            $this->signupService->confirm($token);
            Yii::$app->session->setFlash('success', 'Ваш email успешно подтверждён.');
            return $this->redirect(['login']);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->goHome();
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $form = new PasswordResetRequestForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->passwordResetRequestService->request($form);
                Yii::$app->session->setFlash('success', 'Проверьте ваш email с дальнейшими инструкциями.');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $form,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
//        $service = new PasswordResetRequestService();
//        $service = Yii::$container->get(PasswordResetRequestService::class);

        try {
            $this->passwordResetRequestService->validateToken($token);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        $form = new ResetPasswordForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->passwordResetRequestService->reset($token, $form);
                Yii::$app->session->setFlash('success', 'Новый пароль успешно сохранён.');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('resetPassword', [
            'model' => $form,
        ]);
    }


}