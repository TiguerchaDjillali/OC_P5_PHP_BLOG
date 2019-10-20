<?php
use function OpenFram\escape_to_html as h;
use function OpenFram\u;

?>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Edit Profile</h4>
                <p class="card-category">Complete your profile</p>
            </div>
            <div class="card-body">
                <form class="contact-form" action="" method="post" enctype="multipart/form-data">

                    <?= $form ?>

                    <div class="form-group">
                        <button type="submit"  class="btn btn-primary">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
