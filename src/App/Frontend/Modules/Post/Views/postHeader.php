<?php
use function OpenFram\h;

?>
<div class="page-header header-filter clear-filter purple-filter" data-parallax="true"
     style="background-image: url( <?= h($post->getFeaturedImage()) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <div class="brand text-center">

                    <h1><?= h($title) ?></h1>

                </div>
            </div>
        </div>
    </div>
</div>
