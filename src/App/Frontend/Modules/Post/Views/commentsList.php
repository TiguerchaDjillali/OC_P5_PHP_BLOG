
<div class="col-12">

        <h2> Commentaires <small class="float-right"><?= count($comments) ?> commentaires</small></h2>


    <?php foreach ($comments as $comment) { ?>


        <div class="media">
            <div class="media-body">
                <p class="float-right"><small>
                        Le <?= $comment->getPublicationDate()->format('d/m/Y à H\hi\ ') ?></small></p>

                <h4 class="media-heading currentUser_name"><?= $comment->getUser()->getUserName() ?></h4>
                <?= $comment->getContent() ?>
            </div>
        </div>

    <?php } ?>
</div>
