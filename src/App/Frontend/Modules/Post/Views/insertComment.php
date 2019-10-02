

<form name="sentMessage" id="contactForm" action="comment-<?= $_GET['postId'] ?>.html" method="post">

    <div class="control-group">

        <?= $form ?>

        <div class="form-group">
            <button type="submit" class="btn btn-primary"
                    id="sendMessageButton" <?php if (!$currentUser->hasAttribute('user')) {
                echo ' disabled ';
            } ?>>Envoyer
            </button>

            <?php if (!$currentUser->hasAttribute('user')) { ?>
                <?php
                $currentUser->setAttribute('lastUrl', $currentUser->getApp()->getHttpRequest()->requestUri());
                ?>
                <a class="btn btn-primary"
                   href="/admin/login/">Login</a>

            <?php } ?>
        </div>
    </div>

</form>