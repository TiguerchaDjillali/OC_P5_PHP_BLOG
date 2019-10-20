<?php
use function OpenFram\h;

?>
<div class="col-12">

        <h2> Commentaires <small class="float-right"><?php echo htmlspecialchars(count($comments)) ?> commentaires</small></h2>


    <?php foreach ($comments as $comment) { ?>


        <div class="media">
            <div class="media-body">
                <p class="float-right"><small>
                        Le <?php echo htmlspecialchars($comment->getPublicationDate()->format('d/m/Y à H\hi\ ')) ?></small></p>

                <h4 class="media-heading currentUser_name"><?php echo htmlspecialchars($comment->getUser()->getUserName()) ?></h4>
                <p><?php echo htmlspecialchars($comment->getContent()) ?></p>
            </div>
        </div>

    <?php } ?>
</div>
