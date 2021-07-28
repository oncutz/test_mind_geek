<?php

namespace app\controllers;
use app\models\Article;

class ArticleController extends \yii\web\Controller
{
    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionIndex()
    {
       
        return $this->render('index');
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
