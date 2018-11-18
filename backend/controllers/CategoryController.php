<?php

namespace backend\controllers;

use board\forms\categories\CategoriesUpdateForm;
use Yii;
use board\entities\Category;
use backend\search\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use board\forms\categories\CategoriesForm;
use board\services\category\CategoryManageService;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    public $manageService;

    public function __construct($id, $module, CategoryManageService $manageService , $config = [])
    {
        $this->manageService = $manageService;
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
                    'move-up' => ['POST'],
                    'move-down' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new CategoriesForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $data = $this->manageService->create($form);
                Yii::$app->session->setFlash('success', 'Категория успешно добавлена');
                return $this->redirect(['view', 'id' => $data->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('danger', 'Возникла ошибка при сохранении категории.  ' . $e);
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $category = $this->findModel($id);

        $form = new CategoriesUpdateForm($category);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $this->manageService->edit($category->id, $form);
                Yii::$app->session->setFlash('success', 'Категория успешно обновлена');
                return $this->redirect(['view', 'id' => $category->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('danger', 'Возникла ошибка при обновлении категории.  ' . $e);
            }
        }

        return $this->render('update', [
            'model' => $form,
            'category' => $category,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->manageService->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionMoveUp($id)
    {
        $this->manageService->moveUp($id);
        return $this->redirect(['index']);
    }

    public function actionMoveDown($id)
    {
        $this->manageService->moveDown($id);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Заправшиваемая страница не существует.');
    }
}
