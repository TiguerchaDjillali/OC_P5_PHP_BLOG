<?php
use function OpenFram\escape_to_html as h;
use function OpenFram\u;

?>

<!-- Page Header -->
<?php require 'postHeader.php' ?>


<article class="main main-raised">
    <section class="section">

        <div class="container">
            <div class="row">

                <h3 class="col-md-4"><?php h($post->getSubtitle()) ?></h3>

                <p class="col-md-8 pt-md-4"><?php h($post->getContent()) ?> </p>
                <div class="col-12">
                    <p class="pt-3 float-right">
                        Publié par <a href="#" class="font-italic"> <?php h($post->getUser()->getUserName()) ?> </a>
                        - Le <?php h($post->getPublicationDate()->format('d/m/Y à H\hi\ ')) ?>
                    </p>
                </div>

            </div>

        </div>
    </section>


    <hr>


    <section class="section" id="commentForm">
        <div class="container">
            <div class="row">

                <?php require 'commentForm.php' ?>

            </div>
        </div>
    </section>

    <hr>

    <section class="section">
        <div class="container">
            <div class="row">
                <?php require 'commentsList.php'; ?>
            </div>
        </div>

    </section>

</article>
