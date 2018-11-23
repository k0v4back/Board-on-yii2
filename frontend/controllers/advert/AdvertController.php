<?php

namespace frontend\controllers\advert;

use board\entities\Advert;
use board\entities\Photo;
use board\forms\advert\AdvertForm;
use board\forms\profile\UploadAvatarForm;
use board\services\advert\AdvertService;
use frontend\behaviors\AccessBehavior;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class AdvertController extends Controller
{
    public function behaviors()
    {
        return [
            AccessBehavior::class,
        ];
    }

    private $advertService;

    public function __construct($id, $module, AdvertService $advertService, array $config = [])
    {
        $this->advertService = $advertService;
        parent::__construct($id, $module, $config);
    }

    public function actionCreate($id)
    {
        $user_id = Yii::$app->user->identity->id;

        $form = new AdvertForm();
        $form->user_id = $user_id;

        $pictureUpload = new UploadAvatarForm();

        if ($form->load(Yii::$app->request->post())) {
            try {
                $this->advertService->create($form);
                return $this->redirect(['advert/advert/add-photo', 'id' => $id]);
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('danger', 'Ошибка ' . $e);
            }
        }
        return $this->render('create', [
            'model' => $form,
            'pictureUpload' => $pictureUpload,
        ]);
    }


    public function actionAddPhoto($id)
    {
        $user_id = Yii::$app->user->identity->id;

        $form = new AdvertForm();
        $form->user_id = $user_id;

        $pictureUpload = new UploadAvatarForm();

        if ($picture = Photo::find()->where(['advert_id' => $id])->all()) {
            $data2 = array();
            foreach ($picture as $key => $photoName){
                $data2[] = $photoName;
            }
        } else {
            $data2 = null;
        }

        return $this->render('addPhoto', [
            'model' => $form,
            'pictureUpload' => $pictureUpload,
            'data2' => $data2,
        ]);
    }

    public function actionPicture($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $form = new UploadAvatarForm();
        $form->image = UploadedFile::getInstance($form, 'image');
        if ($form->validate()) {
            $photo = new Photo();
            $photo->name = Yii::$app->storage->saveUploadedFile($form->image);
            $photo->advert_id = $id;
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

    public function actionDelete($id)
    {
        if ($id) {
            $model = Photo::findOne($id);
            $model->delete();
            Yii::$app->session->setFlash('success', 'Фото было удалено!');
            return $this->redirect(Yii::$app->request->referrer);
        }
        Yii::$app->session->setFlash('danger', 'Ошибка!');
        return $this->redirect(Yii::$app->request->referrer);    }

    protected function findModel($id)
    {
        if (($advert = Advert::findOne($id)) !== null) {
            return $advert;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}