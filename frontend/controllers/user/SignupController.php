<?php

namespace frontend\controllers\user;

use board\forms\users\SignupForm;
use board\services\users\SignupService;
use yii\web\Controller;
use Yii;

class SignupController extends Controller
{
    private $signupService;

    public function __construct($id, $module, SignupService $signupService, $config = [])
    {
        $this->signupService = $signupService;
        parent::__construct($id, $module, $config);
    }

    public function actionSignup()
    {
        $form = new SignupForm(Yii::$app->params['defaultRole']);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->signupService->signup($form);
                Yii::$app->session->setFlash('success', 'Проверьте свой email.');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('signup', [
            'model' => $form,
        ]);
    }
}