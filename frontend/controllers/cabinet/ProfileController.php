<?php

namespace frontend\controllers\cabinet;

use board\entities\User;
use board\forms\profile\EditNameForm;
use board\forms\profile\EditPhoneForm;
use board\forms\profile\VerifiedCodeForm;
use board\services\users\EditProfileService;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{
    private $profileService;

    public function __construct($id, $module, EditProfileService $profileService, $config = [])
    {
        $this->profileService = $profileService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex($id)
    {
        $model = $this->findModel($id);

        $currentUser = User::guestOrOther($id);

        $user = new User();

        return $this->render('index', [
            'model' => $model,
            'user' => $user,
            'currentUser' => $currentUser,
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

        if ($model->phone_verified_token_expire == null || time() > $model->phone_verified_token_expire) {
            $this->profileService->code(Yii::$app->user->identity->getId());

            return $this->render('code');
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

//        echo var_dump($form);die();

        $model->code = null;
        $this->profileService->verifiedCode($form->code, Yii::$app->user->identity->getId());

        return $this->render('phoneVerified', [
            'model' => $form,
        ]);
    }

    protected function findModel($id)
    {
        if (($user = User::findOne($id)) !== null) {
            return $user;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}