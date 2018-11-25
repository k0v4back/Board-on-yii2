<?php

namespace frontend\controllers;

use board\forms\search\SearchForm;
use board\repositories\SearchAdvertRepository;
use yii\web\Controller;
use Yii;
/**
 * Site controller
 */
class SiteController extends Controller
{
    private $searchAdvertRepository;

    public function __construct($id, $module, SearchAdvertRepository $searchAdvertRepository , $config = [])
    {
        $this->searchAdvertRepository = $searchAdvertRepository;
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionIndex()
    {
        $form = new SearchForm();
        $form->load(Yii::$app->request->queryParams);
        $form->validate();

        $dataProvider = $this->searchAdvertRepository->search($form);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchForm' => $form,
        ]);
    }

}