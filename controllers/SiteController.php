<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Article;
use app\models\CardImages;
use app\models\Cast;
use app\models\Directors;
use app\models\Genres;
use app\models\ArtImages;
use app\models\ViewingWindow;
use app\models\Alternatives;
use app\models\Videos;

use linslin\yii2\curl\Curl;


class SiteController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        $allArticles = Article::find()->all();

        if(count($allArticles) === 0) {
       
            $data = $this->loadJSON(Yii::$app->params['JSONUrl']);

            foreach($data as $item) {
                $article = new Article;
                $article->load($item, '');
                $article->loadDependencies($item);
                $article->save();
            }
           
        }

        parent::__construct($id, $module,$config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $articles = Article::find()->with('theCardImages', 'theCast', 'theDirectors', 'theGenres', 'theArtImages', 'theVideos', 'theWindow')->all();
     
        return $this->render('index', ['articles' => $articles]);
    }

    public function loadJSON(string $JSONUrl):array
    {
       
        $curl     = new Curl();
        $response = $curl->get($JSONUrl);
        $utf      = utf8_encode($response);
        $jsonData = json_decode($utf, true);

        return $jsonData;
        
    }

    public function actionAbout()
    {
        
        return $this->render('about');
    }

    public function actionContact()
    {

        return $this->render('contact');
    }

}
