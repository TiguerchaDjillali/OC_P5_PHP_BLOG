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
        <div class="container">
            <div class="row">

                <h2 class="text-center title col-12">Articles</h2>
                <div class="col-12">
                    <?php include 'pagination.php'; ?>
                    <hr>
                </div>

                <?php foreach ($postsList as $post) { ?>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-text card-header-primary">
                                <div class="card-text">
                                    <h4 class="card-title"><?= h($post->getTitle()) ?></h4>
                                </div>
                            </div>
                            <div class="card-body">

                                <p style="height:100px; overflow-y: hidden"><?= h($post->getSubTitle()) ?></p>
                                <a href="/post-<?= h(u($post->getId()))?>.html" class="btn btn-primary">Lire</a>

                                <p class="float-right pt-3">Publié par <a href="#"
                                                                          class="font-italic"> <?= $post->getUser()->getUserName() ?> </a>
                                    - Le
                                    <?= h($post->getPublicationDate()->format('d/m/Y à H\hi\ ')) ?>

                                </p>


                            </div>
                        </div>
                    </div>

                <?php } ?>
                <div class="col-12">
                    <hr>
                    <?php include 'pagination.php'; ?>
                </div>


            </div>
        </div>
    </div>

</article>
