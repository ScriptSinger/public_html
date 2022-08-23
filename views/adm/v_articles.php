<main class="main">
    <h1 class="section__title section__title--center"><?= $title ?></h1>
    <?php foreach ($articles as $id => $article) : ?>
        <article class="post">
            <div class="post__header"><a class="popup-link" href="#popup-<?= $article['img'] ?>"><img loading="lazy" class="post__preview" src="<?= BASE_URL . SMALL_IMG_DIR . $article['img'] ?> " alt="<?= $article['alt'] ?>"></a></div>
            <div class="post__body">
                <div class="post__content">
                    <h2 class="post__title"><a href="<?= BASE_URL . 'adm/article/' . $article['url_art'] . '/' . $article['id_article'] ?>"> <?= $article['title'] ?></a></h2>
                    <p class="post__description"> <?= $article['intro'] ?></p>
                </div>
                <div class="post__footer">
                    <ul class="post__data">
                        <li class="post__data--item">
                            <time datetime="<?= $article['dt_add'] ?>"><?= $this->cuteDate($article['dt_add']) ?></time>
                        </li>
                        <li class="post__data--item">
                            <?= $article['name'] ?>
                        </li>
                        </li>
                        <li>
                            <a id="confirm" class="remove item" href="<?= BASE_URL . 'adm/article/delete/' . $article['url_art'] . '/' . $article['id_article'] ?>">
                                <img src="<?= BASE_URL ?>assets/img/delete.svg" alt="delete">
                            </a>
                        </li>
                        <li>
                            <a class="edit item" href="<?= BASE_URL . 'adm/article/edit/' . $article['url_art'] . '/' . $article['id_article'] ?>">
                                <img src="<?= BASE_URL ?>assets/img/edit.svg" alt="edit">
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="popup" id="popup-<?= $article['img'] ?>">
                    <div class="popup__body">
                        <div class="popup__content popup__content_image">
                            <a class="close close-popup" href="#" rel="nofollow">&nbsp;</a>
                            <div class="popup__img"><img class="post__preview" alt="<?= $article['alt'] ?>" src="<?= BASE_URL . BIG_IMG_DIR . $article['img'] ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
    <?= $navbar ?>
</main>