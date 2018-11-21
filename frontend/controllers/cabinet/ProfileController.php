<?php

namespace frontend\controllers\cabinet;

use board\entities\User;
use board\forms\profile\EditNameForm;
use board\forms\profile\EditPhoneForm;
use board\forms\profile\VerifiedCodeForm;
use board\services\users\EditProfileService;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'edit', 'edit-phone', 'phone-verified', 'code', 'test'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public $profileService;

    public function __construct($id, $module, EditProfileService $profileService, $config = [])
    {
        $this->profileService = $profileService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $id = Yii::$app->user->getId();
        $model = $this->findModel($id);

        $user = new User();

        return $this->render('index', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    public function actionEdit()
    {
        $id = Yii::$app->user->getId();
        $model = $this->findModel($id);

        $form = new EditNameForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->profileService->editName(Yii::$app->user->identity->getId(), $form);
                Yii::$app->session->setFlash('success', 'Ваши данные успешно отредактированы');
                return $this->redirect(['cabinet/profile/index']);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('danger', 'Возникла ошибка при редактировании данных');
                return $this->redirect(['cabinet/profile/index']);
            }
        }

        return $this->render('edit', [
            'model' => $form,
        ]);
    }

    public function actionEditPhone()
    {
        $id = Yii::$app->user->getId();
        $model = $this->findModel($id);

        $form = new EditPhoneForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->profileService->editPhone(Yii::$app->user->identity->getId(), $form);
                Yii::$app->session->setFlash('success', 'Ваш телефон успешно отредактирован');
                return $this->redirect(['cabinet/profile/index']);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('danger', 'Возникла ошибка при редактировании телефона');
                return $this->redirect(['cabinet/profile/index']);
            }
        }

        return $this->render('editPhone', [
            'model' => $form,
        ]);
    }

    public function actionCode()
    {
        $this->profileService->code(Yii::$app->user->identity->getId());

        return $this->render('code');
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

    protected function findModel($id)
    {
        if (($user = User::findOne($id)) !== null) {
            return $user;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}