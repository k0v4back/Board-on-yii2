<?php

namespace frontend\controllers\dialog;

use board\entities\Advert;
use board\entities\dialog\Dialog;
use board\forms\dialog\MessagesForm;
use board\services\dialog\DialogService;
use yii\web\Controller;
use Yii;

class DialogController extends Controller
{
    private $dialogService;

    public function __construct($id, $module, DialogService $dialogService, $config = [])
    {
        $this->dialogService = $dialogService;
        parent::__construct($id, $module, $config);
    }

    public function actionDialog($id)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect(['/user/login/login']);
        }

        $form = new MessagesForm();
        $form->dialog_id = $id;

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->dialogService->createMessage($id, $form);
                return $this->refresh();
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('danger', 'Ошибка! Сообщение не отправлено!'. $e);
            }
        }

        return $this->render('index', [
            'model' => $form,
        ]);
    }

    public function actionCreate($advert, $owner, $user = null)
    {
        $dialog = new Advert();
        if($dataOfDialog = $dialog->getOrCreateDialog($advert, $owner, $user = Yii::$app->user->getId())){
             return $this->redirect(['dialog/dialog/dialog', 'id' => $dataOfDialog[0]["id"]]);
        }else{
            Yii::$app->session->setFlash('danger', 'Ошибка! Диалог не создан!');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
}