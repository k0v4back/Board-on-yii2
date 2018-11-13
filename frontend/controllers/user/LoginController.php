<?php

namespace frontend\controllers\user;

use board\forms\users\LoginForm;
use board\services\users\LoginService;
use yii\web\Controller;
use Yii;

class LoginController extends Controller
{
    private $loginService;

    public function __construct($id, $module, LoginService $loginService, $config = [])
    {
        $this->loginService = $loginService;
        parent::__construct($id, $module, $config);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->loginService->login($form);
                Yii::$app->user->login($user, $form->rememberMe ? 3600 * 24 * 30 : 0);
                return $this->goBack();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('login', [
            'model' => $form,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}