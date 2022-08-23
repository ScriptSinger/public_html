<aside class="sidebar">
    <button class="menu__btn btn--blackgray" type="button">Меню</button>
    <div class="sidebar__inner ">
        <nav class="sidebar__nav">
            <a class="sidebar__link" href="<?= BASE_URL ?>">Главная</a>
            <?php foreach ($cats as $cat) : ?>
                <a class="sidebar__link" href="<?= BASE_URL ?>articles/<?= $cat['url_cat'] ?>">
                    <p class="sidebar__par"> <?= $cat['nav_cat'] ?></p>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
</aside>