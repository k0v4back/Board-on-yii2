<?php

namespace frontend\controllers\advert;

use board\entities\Advert;
use board\entities\Avatar;
use board\entities\Photo;
use board\entities\Regions;
use board\entities\User;
use board\forms\advert\AdvertEditForm;
use board\forms\advert\AdvertForm;
use board\forms\profile\UploadAvatarForm;
use board\repositories\AdvertRepository;
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
    private $advertRepo;

    public function __construct($id, $module, AdvertService $advertService, AdvertRepository $advertRepo, array $config = [])
    {
        $this->advertService = $advertService;
        $this->advertRepo = $advertRepo;
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

    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        $form = new AdvertEditForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->advertService->edit($id, $form);
                Yii::$app->session->setFlash('success', 'Ваши данные успешно отредактированы');
                return $this->redirect(['advert/advert/show', 'id' => $id]);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('danger', 'Возникла ошибка при редактировании данных');
                return $this->redirect(['advert/advert/show', 'id' => $id]);
            }
        }

        return $this->render('advertEdit', [
            'model' => $form,
        ]);
    }

    public function actionShow($id)
    {

        $advert = Advert::find()->where(['id' => $id])->all();
        $advertCont = Advert::find()->all();
        $user = User::find()->where(['id' => $advert[0]['user_id']])->limit(1)->one();
        $avatar = Avatar::find()->where(['user_id' => $user->id])->limit(1)->one();
        $photo = Photo::find()->where(['advert_id' => $advert[0]['id']])->all();
        $region = Regions::find()->where(['id' => $advert[0]['region_id']])->limit(1)->one();
        $city = Regions::find()->where(['id' => $advert[0]['city']])->limit(1)->one();

        $breadcrumbs = $this->advertService->getParentId($advert[0]['city']);

        return $this->render('show', [
            'advert' => $advert,
            'advertCont' => $advertCont,
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'avatar' => $avatar,
            'photos' => $photo,
            'region' => $region,
            'city' => $city,
        ]);
    }

    public function actionAdd($id)
    {
        if(Yii::$app->user->isGuest)
        {
            $this->redirect(['site/index']);
        }
        $model = $this->findModel($id);
        $currentUser = Yii::$app->user->identity->id;

        Advert::addFavorites($currentUser, $model);
        Yii::$app->session->setFlash('success', "Объявление <b>$model->title</b> добавлено в избранное");
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDel($id)
    {
        if(Yii::$app->user->isGuest)
        {
            $this->redirect(['site/index']);
        }
        $model = $this->findModel($id);
        $currentUser = Yii::$app->user->identity->id;

        Advert::deleteFavorites($currentUser, $model);
        Yii::$app->session->setFlash('success', "Объявление <b>$model->title</b> уделено из избранного");
        return $this->redirect(Yii::$app->request->referrer);
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
        $model = Photo::findOne($id);
        $advert_id = $model->advert_id;
        $advert = Advert::findOne($advert_id);

        if (Yii::$app->user->identity->getId() == $advert->user_id) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Фото было удалено!');
            return $this->redirect(Yii::$app->request->referrer);
        }
        Yii::$app->session->setFlash('danger', 'Ошибка! Не стоит пытаться удалять чужие фото :)');
        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionDeleteAdvert($id)
    {
        $model = Advert::findOne($id);
        if (Yii::$app->user->identity->getId() == $model->user_id) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Объявление удалено!');
            return $this->redirect(['cabinet/profile/index', 'id' => $model->user_id]);
        }
        Yii::$app->session->setFlash('danger', 'Ошибка! Не стоит пытаться удалять чужие объявления :)');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionPublic($id)
    {
        $model = Advert::findOne($id);
        $model->status = 1;
        $model->save();
        return $this->redirect(['advert/advert/show', 'id' => $id]);
    }

    public function actionClose($id)
    {
        $model = Advert::findOne($id);
        $model->status = 3;
        $model->save();
        return $this->redirect(['advert/advert/show', 'id' => $id]);
    }


    protected function findModel($id)
    {
        if (($advert = Advert::findOne($id)) !== null) {
            return $advert;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}