<?php
use function OpenFram\h;
use function OpenFram\u;

?>

<h2 class="col-12">Laisser un commentaire </h2>

<?php if ($currentUser->hasFlash()) { ?>

    <div class=" col-12 alert alert-success">
        <div class="container">
            <div class="alert-icon">
                <i class="material-icons">check</i>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
            </button>
            <b>Success Alert:</b> <?php echo htmlspecialchars($currentUser->getFlash()) ?>
        </div>
    </div>

<?php } ?>

<form name="sentMessage" id="commentForm" action="post-<?php echo htmlspecialchars(urlencode($post->getId())) ?>.html#commentForm"
      method="post" class="col-12">


    <?php echo $form ?>


    <div class="form-group">
        <button type="submit" class="btn btn-primary" <?php if (!$currentUser->hasAttribute('user')) {
            echo ' disabled ';
} ?>>Envoyer
        </button>

        <?php if (!$currentUser->hasAttribute('user')) { ?>

            <button class="btn btn-primary" type="submit" name="loginForComment" value="1"> Sign in</button>

        <?php } ?>
    </div>


</form>


