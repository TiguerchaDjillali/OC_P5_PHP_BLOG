<?php
use function OpenFram\h;

?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title"><?php echo htmlspecialchars($title) ?></h4>
            <p class="card-category">Exprimez vous</p>
        </div>
        <div class="card-body">

            <form class="contact-form" action="" method="post" enctype="multipart/form-data">

                <?php echo $form ?>

                <div class="form-group">
                    <button type="submit" name="save" class="btn btn-primary" value="0">Enregistrer</button>


                    <button type="submit" name="save" class="btn btn-primary" value="1">Publier</button>
                </div>
            </form>

        </div>
    </div>
</div>
