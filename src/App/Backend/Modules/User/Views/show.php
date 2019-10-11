<?php var_dump($user); ?>
<div class="row">
    <div class="col-md-6">
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
    </div>

    <div class="col-md-6">
        <div class="card card-profile">
            <div class="card-avatar">
                <a href="#pablo">
                    <img class="img" src="../images/user/user-<?= $user->getId() ?>.jpg" />
                </a>
            </div>
            <div class="card-body">
                <h6 class="card-category text-gray"><?=  $user->getUserName()  ?></h6>
                <h4 class="card-title"><?=$user->getRole()->getName()?></h4>
                <p ><?= $user->getLastName() . ' ' . $user->getFirstName() ?></p>
                <p><?= $user->getEmail() ?></p>
                <div class="card-description">
                    <?= $user->getDescription() ?>

                </div>
                <a href="#pablo" class="btn btn-primary btn-round">Follow</a>
            </div>
        </div>
    </div>
</div>