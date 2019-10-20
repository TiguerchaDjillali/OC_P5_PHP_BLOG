<?php
use function OpenFram\h;
use function OpenFram\u;

?>
<div class="small-header col-12 p-0 ">
    <div class="admin-header header-filter clear-filter purple-filter" data-parallax="true"
         style="background-image: url( <?php echo $post->getFeaturedImage() ?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ml-auto mr-auto">
                    <div class="brand text-center">
                        <h1><?php echo htmlspecialchars($post->getTitle()) ?></h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<article class="main main-raised">
    <section class="section">
        <div class="container">
            <div class="row">
                <h3 class="col-md-4"><?php echo htmlspecialchars($post->getSubtitle())?></h3>

                <p class="col-md-8 pt-md-4"><?php echo htmlspecialchars($post->getContent()) ?> </p>
                <div class="col-12">
                    <p class="pt-3 float-right">
                        Publié par <a href="#" class="font-italic"> <?php echo htmlspecialchars($post->getUser()->getUserName()) ?> </a>
                        - Le <?php echo htmlspecialchars($post->getPublicationDate()->format('d/m/Y à H\hi\ ')) ?>
                    </p>
                </div>

            </div>

        </div>
    </section>

    <hr>

    <section class="section">
        <div class="container">
            <div class="row">

                <div class="col-12">

                    <h2> Commentaires <small class="float-right"><?php echo htmlspecialchars(count($commentsList)) ?> commentaires</small></h2>


                    <?php foreach ($commentsList as $comment) { ?>


                        <div id="comment-<?php echo htmlspecialchars($comment->getId()) ?>"
                             class="media px-3 card <?php echo ($comment->getId() == $targetComment->getId()) ? ' bmd-card-raised bg-light text-dark' : '' ?>">
                            <div class="media-body col-12 ">
                                <p class="float-right">
                                    <small>Le <?php echo htmlspecialchars($comment->getPublicationDate()->format('d/m/Y à H\hi\ ')) ?></small>
                                </p>

                                <h4 class="media-heading currentUser_name"><?php echo htmlspecialchars($comment->getUser()->getUserName()) ?></h4>
                                <p><?php echo htmlspecialchars($comment->getContent()) ?></p>
                                <?php
                                if ($comment->getValid() == 0) { ?>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <button type="submit" name="valid" class="btn btn-primary"
                                                value="<?php echo htmlspecialchars($comment->getId()) ?>">
                                            Valider
                                        </button>

                                <?php } else { ?>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <button type="submit" name="invalid" class="btn btn-primary"
                                                    value="<?php echo htmlspecialchars($comment->getId()) ?>">
                                                Cacher
                                            </button>

                                <?php } ?>

                                            <button type="submit" name="delete" value="<?php echo htmlspecialchars($comment->getId()) ?>"
                                                    class="btn btn-primary">
                                                Supprimer
                                            </button>
                                        </div>
                                    </form>
                            </div>
                        </div>

                    <?php } ?>
                </div>

            </div>
        </div>

    </section>

</article>
