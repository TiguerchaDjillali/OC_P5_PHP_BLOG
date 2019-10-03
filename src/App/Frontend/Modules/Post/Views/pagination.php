<nav aria-label="...">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>


        <?php
        $pagesNumber = intdiv($postsNumber, $limit) + ( ($postsNumber % $limit !== 0) ? 1 : 0);
        $page = 1;

        while ($page <= $pagesNumber) { ?>
            <?php $active = ($page == $activePage) ? ' active' : ''; ?>

            <li class="page-item <?= $active ?>">
                <a class="page-link" href="/posts-<?= $page ?>.html">
                    <?= $page ?>
                    <?= ($page == $activePage) ? ' <span class="sr-only">(current)</span>' : ''; ?>
                </a>
            </li>
            <?php $page++;
        } ?>


        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>
