<!-- Page Header -->
<?php require 'postHeader.php' ?>


<article class="main main-raised">
    <section class="section">

        <div class="container">
            <div class="row">
                <?php var_dump($post);?>

                <h3 class="col-md-4"><?= $post->getSubtitle() ?></h3>

                <p class="col-md-8 pt-md-4"><?= $post->getContent() ?> </p>
                <div class="col-12">
                    <p class="pt-3 float-right">
                        Publié par <a href="#" class="font-italic"> <?= $post->getUser()->getUserName() ?> </a>
                        - Le <?= $post->getPublicationDate()->format('d/m/Y à H\hi\ ') ?>
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
