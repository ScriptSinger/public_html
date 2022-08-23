<main class="main">
    <article class="article">
        <div class="article__actions">
            <a href="<?= $_SERVER['HTTP_REFERER'] ?>">вернуться</a>
            <a rel="nofollow" class="popup-link" href="#share">поделиться<img class="article__actions--icon" src="<?= BASE_URL ?>assets/img/social/share.svg" alt=""></a>
        </div>
        <div class="article__header">
            <h1 class="article__title"><?= $article['title'] ?></h1>
            <ul class="article__data">
                <li class="article__data--item">
                    <time datetime="<?= $article['dt_add'] ?>"><?= $article['dt_add'] ?></time>
                </li>
                <li class="article__data--item">
                    <a href="<?= BASE_URL ?>adm/articles/<?= $article['url_cat'] ?>"><?= $article['title_cat'] ?></a>
                </li>
            </ul>
        </div>
        <div class="article__content">
            <div class="article__text">
                <?= htmlspecialchars_decode($article['content']) ?>
            </div>

            <div class="tags">
                <?php foreach ($tags as $tag) : ?>
                    <a href="<?= BASE_URL ?>adm/articles/<?= $tag['url'] ?>" target="_blank" rel="noopener" class="tags__link"><?= $tag['title'] ?></a>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="article__footer">
            <div class="article__item">
                <div class="social">
                    <a id="confirm" class="remove item" href="<?= BASE_URL . 'adm/article/delete/' . $article['url_art'] . '/' . $article['id_article'] ?>">
                        <img src="<?= BASE_URL ?>assets/img/delete.svg" alt="delete">
                    </a>
                    <a class="edit item" href="<?= BASE_URL . 'adm/article/edit/' . $article['url_art'] . '/' . $article['id_article'] ?>">
                        <img src="<?= BASE_URL ?>assets/img/edit.svg" alt="edit">
                    </a>
                </div>
            </div>
            <div class="article__item"><span class="article__author"><?= $article['name'] ?></span></div>
        </div>
    </article>

    <!--Popup -->
    <div class="popup popup--share" id="share">
        <a class="close close-popup" href="#"></a>
        <div class="popup__body">
            <div class="popup__content popup__content--share">
                <div class="modal">
                    <div class="modal__header">
                        <h1 class="title">Поделиться</h1>
                    </div>
                    <div class="modal__body">
                        <div class="modal__group">
                            <input class="modal__caption" id="url-input" type="text">
                        </div>
                    </div>
                    <div class="modal__footer">
                        <ul class="social">
                            <li class="social__item">
                                <a rel="nofollow" id="copy-link" class="social__link" href="#"><img src="<?= BASE_URL ?>assets/img/social/copy.svg" alt=""></a>
                            </li>
                            <li class="social__item">
                                <a rel="nofollow" id="vk_share_button" class="social__link" href="#"><img src="<?= BASE_URL ?>assets/img/social/vk.svg" alt=""></a>
                            </li>
                            <li class="social__item">
                                <a rel="nofollow" class="social__link" href=""><img src="<?= BASE_URL ?>assets/img/social/facebook.svg" alt=""></a>
                            </li>
                            <li class="social__item">
                                <a rel="nofollow" class="social__link" href=""><img src="<?= BASE_URL ?>assets/img/social/twitter.svg"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="up-top"><span class="up-btn">наверх</span></div>
</main>