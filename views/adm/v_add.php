<main class="main">
    <div class="article">
        <form class="form" method="post" enctype="multipart/form-data">
            <h1 class="article__title"><?= $title ?></h1>
            <div class="form__group">
                <label for="">Категория:</label>
                <select name="id_cat" class="caption">
                    <?php foreach ($cats as $cat) : ?>
                        <option value="<?= $cat['id_cat'] ?>"><?= $cat['title_cat'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form__group">
                <label for="">Заголовок:</label>
                <input id="item" data-limit="80" class="caption" name="title" type="text" value="<?= $fields['title'] ?>">
            </div>

            <div class="form__group">
                <label for="">Описание страницы:</label>
                <input id="item" data-limit="128" class="caption" name="description" type="text" value="<?= $fields['description'] ?>">
            </div>

            <div class=" form__group">
                <label for="">Содержание:</label>
                <textarea class="desc" name="content"><?= $fields['content'] ?></textarea>

            </div>

            <div class="form__group">
                <label for="">Атрибут alt:</label>
                <input class="caption" name="alt" type="text" value="<?= $fields['alt'] ?>">
            </div>

            <div class="form__row">
                <!-- <label class="upload">
                    <input type="file" name="file" class="input__file">
                </label> -->
                <input type="file" name="file">
                <button type="submit" class="btn btn--red">Опубликовать</button>
            </div>

            <div class="error-list">
                <?php if ($errors) : ?>
                    <?php foreach ($errors as $error) : ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </form>
    </div>
</main>