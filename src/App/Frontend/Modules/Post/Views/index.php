<!-- Page Header -->
<div class="page-header header-filter clear-filter purple-filter" data-parallax="true"
     style="background-image: url('./assets/img/bg2.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <div class="brand text-center">
                    <h1>Liste des articles</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<article class="main main-raised">
    <div class="section section-tabs">

        <div class="section section-tabs">
            <div class="container">
                <div class="row">

                    <h2 class="text-center title col-12">Derniers articles</h2>

                    <?php foreach ($postsList as $post) { ?>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-header-text card-header-primary">
                                    <div class="card-text">
                                        <h4 class="card-title"><?= $post->getTitle() ?></h4>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <p style="height:100px; overflow-y: hidden"><?= $post->getSubTitle() ?></p>
                                    <a href="/post-<?= $post->getId() ?>.html" class="btn btn-primary">Lire</a>

                                    <p class="float-right pt-3">Publié par <a href="#"
                                                                              class="font-italic"> <?= $post->getUser()->getUserName() ?> </a>
                                        - Le
                                        <?= $post->getPublicationDate()->format('d/m/Y à H\hi\ ') ?>

                                    </p>


                                </div>
                            </div>
                        </div>

                    <?php } ?>


                </div>
            </div>
        </div>

    </div>
</article>