<?php

namespace frontend\controllers\cabinet;

use board\forms\users\EditNameForm;
use board\services\users\EditNameService;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{
    public $nameService;

    public function __construct($id, $module, EditNameService $nameService , $config = [])
    {
        $this->nameService = $nameService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionEdit()
    {
        $id = Yii::$app->user->getId();
        $model = $this->findModel($id);

        $form = new EditNameForm($model);

        if($form->load(Yii::$app->request->post()) && $form->validate()){
            try{
                $this->nameService->edit(Yii::$app->user->identity->getId(), $form);
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

    protected function findModel($id)
    {
        if (($user = \board\entities\User::findOne($id)) !== null) {
            return $user;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}