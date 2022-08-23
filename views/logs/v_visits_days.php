<main class="main">
    <div class="article">
        <?php foreach ($visitsDays  as $day) : ?>
            <ul>
                <li><a class="title__link" href="<?= BASE_URL ?>log/<?= $day ?>"> <?= $day ?></a></li>
            </ul>
        <?php endforeach; ?>
    </div>
</main>