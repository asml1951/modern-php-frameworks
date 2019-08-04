<?php

namespace app\components;


use yii\base\Widget;

class NewsWidget extends Widget
{
    public $news= [];
    public $view;

    public function init()
    {
        parent::init();

    }

    public function run()
    {
       return $this->render('news',['articles' => $this->news]);
    }
}