<?php
/**
 * Created by : alex
 * Date: 24.07.19
 * Time: 17:51
 */

namespace app\controllers;

use app\components\ActionAdminFilter;
use yii\web\Controller;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'class' => '\app\components\ActionAdminFilter'

        ];
    }


    public function actionPanel()
    {
        return $this->render('adminpanel');
    }
}