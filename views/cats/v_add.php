<main class="main">
    <article class="article">
        <div class="article__actions">
            <a href="<?= $_SERVER['HTTP_REFERER'] ?>">вернуться</a>
        </div>
        <h1 class="article__title">Категории</h1>
        <form class="form" method="post" enctype="multipart/form-data">
            <div class="form__group">
                <label for="">Название:</label>
                <input class="caption" name="title_cat" type="text" value="<?= $fields['title_cat'] ?>">
            </div>
            <div class="form__group">
                <label for="">Навигационное название:</label>
                <input class="caption" name="nav_cat" type="text" value="<?= $fields['nav_cat'] ?>">
            </div>

            <div class=" form__group">
                <label for="">Описание:</label>
                <textarea id="item" data-limit="128" class="desc" name="description_cat"><?= $fields['description_cat'] ?></textarea>
            </div>
            <div class="form__row">
                <button type="submit" class="btn btn--red">«Отправить»</button>
            </div>
            <div class="error-list">
                <?php if ($errors) : ?>
                    <?php foreach ($errors as $error) : ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </form>
    </article>
</main>