<article class="article">
    <div class="article__actions">
        <div> <a href="<?= $_SERVER['HTTP_REFERER'] ?>">логи</a> / <?= $name ?></div>

    </div>
    <div class="article__header">
        <h1 class="article__title"><?= $title ?></h1>
    </div>
    <table class="table--one">
        <thead>
            <tr>
                <th>Time</th>
                <th>Ip</th>
                <th>City</th>
                <th>Uri</th>
                <th>User_Agent</th>
                <th>Referer</th>
                <th>IsDanger</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($visits as $day) : ?>
                <tr class="" data-bg="<?= $day['isDanger'] ? 1 : 0 ?>">
                    <td><?= $day['dt'] ?></td>
                    <td><?= $day['ip'] ?></td>
                    <td><input class="table__input" value="<?= $day['city'] ?>" type="text"></td>
                    <td><input class="table__input" value="<?= $day['uri'] ?>" type="text"></td>
                    <td><input class="table__input" value="<?= $day['user_agent'] ?>" type="text"></td>
                    <td><input class="table__input" value="<?= $day['referer'] ?>" type="text"></td>
                    <td><?= $day['isDanger'] ? 1 : 0 ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</article>