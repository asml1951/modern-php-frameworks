<?php

namespace app\controllers;

use app\models\Article;
use app\models\Author;
use app\models\Group;
use app\models\MyUser;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
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
        return $this->render('index', ['articles' => Article::getLatestArticles()]);
    }

    /**
     * UserGroup action добавляет пользователя в группу
     *
     * @param $uid string
     * @param $gid string
     * @param $validBefore string
     * @return string
     */
    public function actionUserGroup($uid,$gid,$validBefore)
    {
        $user = MyUser::findOne($uid);
        $group = Group::findOne($gid);
        if (isset($user, $group, $validBefore)) {
            $group->link('myusers', $user, [
                'added_to_group' => date('Y-m-d'),
                'valid_before' => $validBefore,
            ]);
            $message = 'Пользователь ' . $user->name . ' добавлен в группу '
                       . $group->name;
            return Yii::$app->response->content = $message;
        } else {
            return Yii::$app->response->content = 'Ощибка!';
        }
    }

    /**
     * Delete action удаляет пользователей с истекшим сроком из групп
     *
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionDelete()
    {
        $rowsNum = Yii::$app->db
            ->createCommand('DELETE FROM user_group WHERE valid_before < NOW()')
            ->execute();
        return Yii::$app->response->content = 'Удалено ' . $rowsNum . ' записей.';

        /*  Второй вариант с использованием QueryBuilder и ORM:

        $userGroup = (new \yii\db\Query())
            ->select(['user_id','group_id'])
            ->from('user_group')
            ->where(['<', 'valid_before', $date])
            ->all();
        foreach($userGroup as $row){
          $user = MyUser::findOne($row['user_id']);
          $group = Group::findOne($row['group_id']);
          $group->unlink('myusers', $user,true);
        }
        */
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
        return $this->render('login', ['model' => $model]);
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
        $author = Author::findOne(['name' => 'А.С. Пушкин']);
        $articles = $author->news;
        return $this->render('say', ['message' => $message]);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }


}
