<?php
use function OpenFram\h;

?>
<div class="col-12">

        <h2> Commentaires <small class="float-right"><?php escape_to_html(count($comments)) ?> commentaires</small></h2>


    <?php foreach ($comments as $comment) { ?>


        <div class="media">
            <div class="media-body">
                <p class="float-right"><small>
                        Le <?php escape_to_html($comment->getPublicationDate()->format('d/m/Y à H\hi\ ')) ?></small></p>

                <h4 class="media-heading currentUser_name"><?php escape_to_html($comment->getUser()->getUserName()) ?></h4>
                <p><?php escape_to_html($comment->getContent()) ?></p>
            </div>
        </div>

    <?php } ?>
</div>
