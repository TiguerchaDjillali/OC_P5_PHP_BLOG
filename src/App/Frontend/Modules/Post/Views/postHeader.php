<?php
use function OpenFram\escape_to_html as h;

?>
<div class="page-header header-filter clear-filter purple-filter" data-parallax="true"
     style="background-image: url( <?php h($post->getFeaturedImage()) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <div class="brand text-center">

                    <h1><?php h($title) ?></h1>

                </div>
            </div>
        </div>
    </div>
</div>
