<?php

namespace frontend\controllers\advert;

use board\entities\Advert;
use board\entities\Avatar;
use board\entities\Photo;
use board\forms\advert\AdvertForm;
use board\forms\profile\UploadAvatarForm;
use board\services\advert\AdvertService;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

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

        $pictureUpload = new UploadAvatarForm();

        if ($picture = Avatar::find()->where(['user_id' => $id])->one()) {
            $data = Yii::$app->storage->getFile($picture->name);
        } else {
            $data = Yii::$app->params['storageUri'] . Yii::$app->params['defaultAva'];
        }

        if($form->load(Yii::$app->request->post()) && $form->validate())
        {
            try{
                $result = $this->advertService->create($form);
                Yii::$app->session->setFlash('success', 'Объявление \'' . $result->title . '\' успешно добавлено.');
                return $this->redirect(['cabinet/profile/index', 'id' => $id]);
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('danger', 'Ошибка ' . $e);
            }
        }
        return $this->render('create', [
            'model' => $form,
            'pictureUpload' => $pictureUpload,
            'picture' => $data,
        ]);
    }

    public function actionPicture()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $form = new UploadAvatarForm();
        $form->image = UploadedFile::getInstance($form, 'image');
        if ($form->validate()) {
            $photo = new Photo();
            $photo->name = Yii::$app->storage->saveUploadedFile($form->image);
            $photo->advert_id = 4;
            $photo->created_at = time();
            if($photo->save(false)){
                return [
                    'success' => true,
                    'pictureUri' => Yii::$app->storage->getFile($photo->name),
                ];
            }
        }
        return ['success' => false, 'errors' => $form->getErrors()];
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