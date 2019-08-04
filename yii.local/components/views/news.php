
<div class="body-content">
        <div class="row">
        <?php foreach($articles as $article) { ?>

            <article class="col-lg-12">
                <h2><?= $article['title'] ?> </h2>
            <img src="<?= '/images/' . $article['image'] ?>" alt="yii" class="img-thumbnail ">
                <p><h4><?= $article['subtitle'] ?></h4></p>
                <p><?= $article['text'] ?></p>
            </article>
        <?php } ?>
        </div>
</div>
