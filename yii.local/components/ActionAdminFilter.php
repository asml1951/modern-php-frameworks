<?php
namespace app\components;

use Yii;
use yii\base\ActionFilter;
use yii\web\UnauthorizedHttpException;

//use yii\web\Response;
//use yii\web\UnauthorizedHttpException;

class ActionAdminFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        $headers = Yii::$app->request->headers;

        if ($headers->has('x-username')
            && $headers->get('x-username') == 'admin') {

            if ($headers->has('x-password')
            && password_verify('123456', $headers->get('x-password'))) {

               return parent::beforeAction($action);
            }
        }

        throw new UnauthorizedHttpException('You Are Not Authorized', '401');


    }
}