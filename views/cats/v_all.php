<main class="main">
    <div class="article">
        <div class="article__actions">
            <a href="<?= $_SERVER['HTTP_REFERER'] ?>">вернуться</a>
            <a href="<?= BASE_URL ?>adm/cat/add">добавить</a>
        </div>
        <h1 class="article__title"><?= $title ?></h1>
        <table class="table--one">
            <tbody>
                <tr>
                    <td>
                        <div class="special-container"><b>Категория</b></div>
                    </td>
                    <td>
                        <div class="special-container"><b>Заголовок</b></div>
                    </td>
                    <td>
                        <div class="special-container"><b>URL</b></div>
                    </td>
                    <td>
                        <div class="special-container"><b>Description</b></div>
                    </td>
                    <td colspan="2">
                        <div class="special-container"><b>Действие</b></div>
                    </td>
                </tr>
                <?php foreach ($cats as $cat) : ?>
                    <tr>
                        <td> <?= $cat['nav_cat'] ?> </td>
                        <td> <?= $cat['title_cat'] ?> </td>
                        <td> <?= $cat['url_cat'] ?> </td>
                        <td> <?= $cat['description_cat'] ?> </td>
                        <td> <a href="<?= BASE_URL ?>adm/cat/edit/<?= $cat['id_cat'] ?>">редактировать</a> </td>
                        <td> <a id="confirm" href="<?= BASE_URL ?>adm/cat/delete/<?= $cat['id_cat'] ?>">удалить</a> </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>