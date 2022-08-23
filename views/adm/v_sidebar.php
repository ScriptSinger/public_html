<aside class="sidebar">
    <button class="menu__btn btn--blackgray" type="button">Меню</button>
    <div class="sidebar__inner ">
        <nav class="sidebar__nav">
            <a class="sidebar__link" href="<?= BASE_URL ?>adm/articles">главная</a>
            <?php foreach ($cats as $cat) : ?>
                <a class="sidebar__link" href="<?= BASE_URL ?>adm/articles/<?= $cat['url_cat'] ?>"><?= $cat['nav_cat'] ?></a>
            <?php endforeach; ?>
            <a class="sidebar__link" href="<?= BASE_URL ?>adm/cats/all">категории</a>
            <a class="sidebar__link " href="<?= BASE_URL ?>adm/article/add">написать</a>
            <a class="sidebar__link" href="<?= BASE_URL ?>logs">логи</a>
        </nav>
    </div>
</aside>