<?php

namespace frontend\controllers\advert;

use board\entities\Advert;
use board\forms\advert\AdvertForm;
use board\services\advert\AdvertService;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class AdvertController extends Controller
{
    private $advertService;

    public function __construct($id, $module, AdvertService $advertService , array $config = [])
    {
        $this->advertService = $advertService;
        parent::__construct($id, $module, $config);
    }

    public function actionCreate()
    {
        $id = Yii::$app->user->identity->id;

        $form = new AdvertForm();
        $form->user_id = $id;

        if($form->load(Yii::$app->request->post()) && $form->validate())
        {
//            echo 'Валидация прошла';die();
            try{
                $this->advertService->create($form);
                Yii::$app->session->setFlash('success', 'Объявление успешно добавлено.');
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('danger', 'Ошибка ' . $e);
            }
        } else {
            echo 'Ошибка валидации';
            var_dump($form->errors); die();
        }

        return $this->render('create', [
            'model' => $form,
        ]);
    }

    public function actionTest()
    {
        echo 'Test';die();
    }

    protected function findModel($id)
    {
        if (($advert = Advert::findOne($id)) !== null) {
            return $advert;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}