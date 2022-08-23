<?php if ($total > 1) : ?>
    <nav aria-label="pagination__wrapper">
        <div class="center">
            <div class="pagination">
                <?php if ($page != 1) : ?>
                    <li><a href="<?= BASE_URL ?>adm/articles/<?= $page - 1 ?>">«</a></li>
                <?php endif; ?>
                <?php for ($i = $left; $i <= $right; $i++) : ?>
                    <?php if (($i < 1) || ($i > $total)) continue; ?>
                    <?php if ($i == $page) : ?>
                        <li style="border: 1px solid black"><a href="<?= BASE_URL ?>adm/articles/<?= $i ?>"><b><?= $i ?></b> </a></li>
                    <?php else : ?>
                        <li><a href="<?= BASE_URL ?>adm/articles/<?= $i ?>"><?= $i ?> </a></li>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php if ($page != $total) : ?>
                    <li><a href="<?= BASE_URL ?>adm/articles/<?= $page + 1 ?>">»</a></li>
                <?php endif; ?>
            </div>
        </div>
    </nav>
<?php endif; ?>