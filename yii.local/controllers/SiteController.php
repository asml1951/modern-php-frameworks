<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public $news = [ 'article1' => ['title' => 'Новость 1',
                                    'subtitle' => 'Краткое содержание новости #1',
                                    'text' => 'На сайте Госавтоинспекции появился интерактивный раздел, в котором 
                                    собрана информация о местах размещения средств фото- и видеофиксации нарушений
                                     на дорогах, сообщила официальный представитель МВД Ирина Волк. ',
                                     'image' => 'tree.jpg'],
                     'article2' => ['title' => 'Новость 2',
                                    'subtitle' => 'Краткое содержание новости #2',
                                    'text' => 'На сайте Госавтоинспекции появился интерактивный раздел, в котором 
                                    собрана информация о местах размещения средств фото- и видеофиксации нарушений
                                     на дорогах, сообщила официальный представитель МВД Ирина Волк.',
                                      'image' => 'boat.jpg'],
                     'article3' => ['title' => 'Новость 3',
                                    'subtitle' => 'Краткое содержание новости #3',
                                    'text' => 'На сайте Госавтоинспекции появился интерактивный раздел, в котором 
                                    собрана информация о местах размещения средств фото- и видеофиксации нарушений
                                     на дорогах, сообщила официальный представитель МВД Ирина Волк.',
                                     'image' => 'balloons.jpg'],
                     'article4' => ['title' => 'Новость 4',
                                    'subtitle' => 'Краткое содержание новости #4',
                                    'text' => 'На сайте Госавтоинспекции появился интерактивный раздел, в котором 
                                    собрана информация о местах размещения средств фото- и видеофиксации нарушений
                                     на дорогах, сообщила официальный представитель МВД Ирина Волк.',
                                    'image' => 'balloons.jpg'],
                     'article5' => ['title' => 'Новость 5',
                                    'subtitle' => 'Краткое содержание новости #5',
                                    'text' => 'На сайте Госавтоинспекции появился интерактивный раздел, в котором 
                                    собрана информация о местах размещения средств фото- и видеофиксации нарушений
                                     на дорогах, сообщила официальный представитель МВД Ирина Волк.',
                                    'image' => 'secretcave.jpg'],
                     'article6' => ['title' => 'Новость 6',
                                    'subtitle' => 'Краткое содержание новости #6',
                                    'text' => 'На сайте Госавтоинспекции появился интерактивный раздел, в котором 
                                    собрана информация о местах размещения средств фото- и видеофиксации нарушений
                                     на дорогах, сообщила официальный представитель МВД Ирина Волк.',
                                    'image' => 'pipe-sculpture.jpg'],
        ];

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
        return $this->render('index', ['articles' => array_slice($this->news, 0, 5, true)]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = 'Привет!')
    {

        return $this->render('say', ['message' => $message]);
    }
}
