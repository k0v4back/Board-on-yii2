<?php

namespace backend\controllers;

use backend\search\RegionsDetailSearch;
use board\forms\regions\RegionsCreateForm;
use board\forms\regions\RegionsUpdateForm;
use board\services\regions\RegionsService;
use Yii;
use board\entities\Regions;
use backend\search\RegionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegionsController implements the CRUD actions for Regions model.
 */
class RegionsController extends Controller
{
    private $regionsService;

    public function __construct($id, $module, RegionsService $regionsService, $config = [])
    {
        $this->regionsService = $regionsService;
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Regions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = Regions::find()->where(['parent_id' => null]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'query' => $query,
        ]);
    }

    /**
     * Displays a single Regions model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new RegionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchDetailModel = new RegionsDetailSearch();
        $dataDetailProvider = $searchDetailModel->search(Yii::$app->request->queryParams);
        $breadcrumbs = $this->regionsService->breadcrumbs($this->findModel($id));

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataDetailProvider' => $dataDetailProvider,
            'searchDetailModel' => $searchDetailModel,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Creates a new Regions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new RegionsCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $region = $this->regionsService->create($form);
                Yii::$app->session->setFlash('success', 'Регион успешно добавлен');
                if($region->parent_id > 0){return $this->redirect(['view', 'id' => $region->parent_id]); } else {return $this->redirect(['index']);}
            } catch (\DomainException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('success', 'Не удалось добавить регион');
            }
        }

        $data = $this->regionsService->settlements();

        return $this->render('create', [
            'model' => $form,
            'data' => $data,
        ]);
    }

    /**
     * Updates an existing Regions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $region = $this->findModel($id);

        //        if ($region->load(Yii::$app->request->post()) && $region->save()) {
//            return $this->redirect(['view', 'id' => $region->id]);
//        }

        $form = new RegionsUpdateForm($region);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->regionsService->edit($region->id, $form);
                return $this->redirect(['view', 'id' => $region->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $form,
            'region' => $region,
        ]);
    }

    /**
     * Deletes an existing Regions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Regions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Regions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($region = Regions::findOne($id)) !== null) {
            return $region;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
