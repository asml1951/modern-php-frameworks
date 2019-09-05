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
            <p class="col-lg-12">
                <h2><?= $article['title'] ?> </h2>
                <p><h3><?= 'Автор новости: ' . $article->author['name'] .
                '  email автора: ' . $article->author['email'] ?></h3></p>
                <img src="<?= '/images/' . $article['image'] ?>" alt="yii" class="img-thumbnail ">
                <p><h4><?= $article['subtitle'] ?></h4></p>
                <p><?= $article['content'] ?></p>
        <?php } ?>
        </div>


    </div>
</div>





