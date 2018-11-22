<?php

namespace frontend\controllers\cabinet;

use board\entities\Avatar;
use board\entities\User;
use board\forms\profile\EditNameForm;
use board\forms\profile\EditPhoneForm;
use board\forms\profile\UploadAvatarForm;
use board\forms\profile\VerifiedCodeForm;
use board\services\users\avatar\AvatarService;
use board\services\users\EditProfileService;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class ProfileController extends Controller
{
    private $profileService;
    private $avatarService;

    public function __construct($id, $module, EditProfileService $profileService, AvatarService $avatarService, $config = [])
    {
        $this->profileService = $profileService;
        $this->avatarService = $avatarService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex($id)
    {
        $model = $this->findModel($id);
        $currentUser = User::guestOrOther($id);
        $user = new User();

        $picture = new UploadAvatarForm();

        return $this->render('index', [
            'model' => $model,
            'user' => $user,
            'currentUser' => $currentUser,
            'picture' => $picture
        ]);
    }

    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        $form = new EditNameForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->profileService->editName(Yii::$app->user->identity->getId(), $form);
                Yii::$app->session->setFlash('success', 'Ваши данные успешно отредактированы');
                return $this->redirect(['cabinet/profile/index', 'id' => $id]);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('danger', 'Возникла ошибка при редактировании данных');
                return $this->redirect(['cabinet/profile/index', 'id' => $id]);
            }
        }

        return $this->render('edit', [
            'model' => $form,
        ]);
    }

    public function actionEditPhone($id)
    {
        $model = $this->findModel($id);

        $form = new EditPhoneForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->profileService->editPhone(Yii::$app->user->identity->getId(), $form);
                Yii::$app->session->setFlash('success', 'Ваш телефон успешно отредактирован');
                return $this->redirect(['cabinet/profile/index', 'id' => $id]);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('danger', 'Возникла ошибка при редактировании телефона');
                return $this->redirect(['cabinet/profile/index', 'id' => $id]);
            }
        }

        return $this->render('editPhone', [
            'model' => $form,
        ]);
    }

    public function actionCode($id)
    {
        $model = $this->findModel($id);

        if ($model->phone_verified_token_expire == null && $model->phone_verified != 1 || time() > $model->phone_verified_token_expire && $model->phone_verified != 1) {
            $this->profileService->code(Yii::$app->user->identity->getId());

            return $this->render('code');
        } elseif ($model->phone_verified == 1) {
            Yii::$app->session->setFlash('info', 'Ваш телефон уже подтверждён!');
            return $this->redirect(['cabinet/profile/index', 'id' => $id]);
        } else {
            $time = $model->phone_verified_token_expire - time();
            Yii::$app->session->setFlash('danger', 'Новый код будет отправлен через ' . $time . ' секунд');
            return $this->redirect(['cabinet/profile/index', 'id' => $id]);
        }
    }

    public function actionPhoneVerified()
    {
        $id = Yii::$app->user->getId();
        $model = $this->findModel($id);

        $form = new VerifiedCodeForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            $model->code = null;
            $this->profileService->verifiedCode($form->code, Yii::$app->user->identity->getId());
        }

        return $this->render('phoneVerified', [
            'model' => $form,
        ]);
    }

    public function actionPicture()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $form = new UploadAvatarForm();
        $form->image = UploadedFile::getInstance($form, 'image');
        if($form->validate()){
            $photo = new Avatar();
            $photo->name = Yii::$app->storage->saveUploadedFile($form->image);
            $photo->user_id = Yii::$app->user->identity->id;
            if($photo->save(false)) {

            }
        }
        return ['success' => false, 'errors' => $form->getErrors()];
    }

    protected function findModel($id)
    {
        if (($user = User::findOne($id)) !== null) {
            return $user;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}