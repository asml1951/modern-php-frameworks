<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>


<div class="site-index">

    <div class="jumbotron">
        <h1>Последние новости</h1>
        <p class="lead">Новости со всего мира</p>

    </div>

    <div class="body-content">
        <div class="row">
        <?php foreach($articles as $article) { ?>
            <article>
            <p class="col-lg-12">
                <h2><?= $article['title'] ?> </h2>

                <p><h4><?= $article->articlerubric['name'] ?></h4></p>
                 <?php setlocale(LC_TIME,'ru_RU.UTF-8'); ?>
                <p><h5>Дата публикации: <?= strftime(' %A %e %B %Y ', strtotime($article['published'])) ?></h5></p>
                <?php if(!is_null($article['modified'])) {  ?>
                <p><h5>Обновлено: <?= strftime(' %A %e %B %Y ', strtotime($article['modified'])) ?> </h5></p>
                    <?php } ?>
                <p><?= $article['content'] ?></p>

        <?php } ?>
            </article>
        </div>



    </div>
</div>





