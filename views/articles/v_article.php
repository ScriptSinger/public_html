<main class="main">
    <div class="article">
        <div class="article__actions">
            <a href="<?= $_SERVER['HTTP_REFERER'] ?>">вернуться</a>
            <a rel="nofollow" class="popup-link" href="#share">поделиться<img class="article__actions--icon" src="<?= BASE_URL ?>assets/img/social/share.svg" alt=""></a>
        </div>
        <div class="article__header">
            <h1 class="article__title"><?= $article['title'] ?></h1>
            <ul class="article__data">
                <li class="article__data--item">
                    <time datetime="<?= $article['dt_add'] ?>"><?= $this->cuteDate($article['dt_add']) ?></time>
                </li>
                <li class="article__data--item">
                    <a href="<?= BASE_URL ?>articles/<?= $article['url_cat'] ?>"><?= $article['title_cat'] ?></a>
                </li>
            </ul>
        </div>
        <article class="article__content">
            <div class="article__text">
                <?= htmlspecialchars_decode($article['content']) ?>
            </div>
        </article>
        <div class="article__footer">
            
       
        
        
 
     



      <div id="vk_comments"></div>

      
      
       </div> 
    </div>

    <!--Popup -->
    <div class="popup popup--share" id="share">
        <div class="paper-toast" id="successMessage">Ссылка скопирована в буфер обмена</div>
        <a class="close close-popup" href="#"></a>
        <div class="popup__body">
            <div class="popup__content popup__content--share">
                <div class="modal">
                    <div class="modal__header">
                        <h1 class="title">Поделиться</h1>
                    </div>
                    <div class="modal__body">
                        <div class="modal__group">
                            <input class="modal__caption" id="clipBoardInput" type="text" value="<?= $currentUrl ?>">
                        </div>
                    </div>
                    <div class="modal__footer">


                        <div class="social ya-share2" data-copy="extraItem" data-curtain data-size="l" data-shape="round" data-services="vkontakte,telegram,whatsapp"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="up-top"><span class="up-btn">наверх</span></div>
</main>