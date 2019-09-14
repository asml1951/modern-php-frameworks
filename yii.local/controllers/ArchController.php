<?php


namespace app\controllers;


use app\models\Article;
use yii\web\Controller;

class ArchController extends Controller
{
    /**
     * @param string $date
     * @param array $rubrics
     * @return string
     */
    public function actionIndex(string $date, array $rubrics)
    {
        $articles = Article::getByDateAndRubric($date, $rubrics);
        if(!empty($articles)){
        foreach ($articles as $article) {
            $article['arch'] = 1;
            $article->save();
        }
        }
        return $this->render('index', ['n' => count($articles)]);
    }
}