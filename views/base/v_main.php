<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="sJmqfgd3VfTRuLSrN-e5MCfvHmigdEL_dFJQbfTKWvA">
    <meta name="yandex-verification" content="7843198b5b2a0b60">
    <title><?= $pageTitle ?></title>
    <meta name="description" content="<?= htmlspecialchars_decode($description) ?>">
    <meta name="robots" content="all">
    <link rel="canonical" href="<?= $canonical ?>">
    <!--Favicons-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= BASE_URL ?>assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= BASE_URL ?>assets/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?= BASE_URL ?>assets/img/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?= BASE_URL ?>assets/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
    <?php if ($styles) foreach ($styles as $style) : ?>
        <link rel="stylesheet" href="<?= BASE_URL . CSS_DIR . $style  ?>.css">
    <?php endforeach; ?>

</head>

<body>
    <header class="header" id="header">
        <div class="wrapper">
            <div class="header__inner">
                <div class="header__logo"><a class="nav__link" href="<?= BASE_URL ?>" >УФА-МАСТЕР</a></div>
                <nav class="nav" id="nav">
                    <a class="nav__link" href="#" rel="nofollow">Регистрация</a>
                    <?php if ($user !== null) : ?>
                        <a class="nav__link" href="<?= BASE_URL ?>auth/logout">Выход (<?= $user['name'] ?>) </a>
                    <?php else : ?>
                        <a class="nav__link" href="<?= BASE_URL ?>auth/login">Вход</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>

    <div class="wrapper">
        <?= $pageContent ?>
    </div>

    <!-- Footer -->
    <footer class=" footer">
        <div class="wrapper">
            <div class="footer__inner">
                <div class="footer__block">
                    <h2 class="footer__title">Локация</h2>
                    <address class="footer__address">
                        <div>Россия, Республика Башкортостан</div>
                        <div>город Уфа</div>
                    </address>
                </div>

                <div class="footer__block">
                    <!-- <h4 class="footer__title"></h4> -->
                    <div class="social  social--footer">
                        <a class="social__item" href="https://vk.com/rbtufa2016" target="_blank" rel="noreferrer" aria-label="vk">
                            <img class="social__icon" src="<?= BASE_URL ?>assets/img/vk.svg" alt="vk" width="34" height="34">
                        </a>
                        <a class="social__item" href="https://chat.whatsapp.com/EeXtkvis2gJ90pBJPjAjl8" target="_blank" rel="noreferrer" aria-label="whatsapp">
                            <img class="social__icon" src="<?= BASE_URL ?>assets/img/whatsapp.svg" alt="whatsapp" width="34" height="34">
                        </a>
                    </div>
                </div>

                <div class="footer__block">
                    <h2 class="footer__title">РБТ УФА</h2>
                    <div class="footer__text">Ремонт Техники <br><a class="footer__mobile" href="tel:+79191421604">89610510205</a><br>
                        <a class="footer__mobile" href="tel:+79196093485">89196093485</a>
                    </div>
                </div>
            </div><!-- /.footer__inner -->
        </div><!-- /.container -->

        <div class="copyright">
            <div class="wrapper">
                <div class="copyright__text">
                    <div>Copyright © 2019 Все права защищены | Информация на сайте не является
                        публичной офертой.
                    </div>
                    <div>Made <span>by $Bill</span></div>
                </div>
            </div>
            <!--footer__inner-->
        </div>
        <!--container-->
    </footer>
   
    <script src="<?= BASE_URL ?>assets/js/app.js"> </script>
    <?php if ($apiScripts) foreach ($apiScripts as $apiScript) : ?>
        <script src="<?= $apiScript   ?> "></script>
    <?php endforeach; ?>
    <?php if ($scripts) foreach ($scripts as $script) : ?>
        <script src="<?= BASE_URL . JS_DIR . $script  ?>.js"></script>
    <?php endforeach; ?>
 </body>

</html>