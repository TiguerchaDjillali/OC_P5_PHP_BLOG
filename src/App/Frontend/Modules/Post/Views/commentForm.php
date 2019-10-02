
    <h2 class="col-12">Laisser un commentaire </h2>

    <?php if ($currentUser->hasFlash()) echo '<p class = "text-info offset-md-4">', $currentUser->getFlash(), '</p>' ?>

    <form name="sentMessage" id="commentForm" action="post-<?= $post->getId() ?>.html#commentForm"
          method="post" class="col-12">


        <?=  $form ?>



        <div class="form-group">
            <button type="submit" class="btn btn-primary" <?php if (!$currentUser->hasAttribute('user')) {
                echo ' disabled ';
            } ?>>Envoyer </button>

            <?php if (!$currentUser->hasAttribute('user')) { ?>

                <button class="btn btn-primary" type="submit" name="loginForComment" value="1"> log</button>

            <?php } ?>
        </div>


    </form>


