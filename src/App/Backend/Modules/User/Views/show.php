<?php
use function OpenFram\h;
use function OpenFram\u;

?>
<div class="col-12 col-md-3">

    <ul class="nav nav-pills nav-pills-icons  flex-column " role="tablist">
        <li class="nav-item">
            <a class="nav-link active show" href="#profil" role="tab" data-toggle="tab" aria-selected="true">
                <i class="material-icons">person</i> Profil
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#edit" role="tab" data-toggle="tab" aria-selected="false">
                <i class="material-icons">edit</i> Editer
            </a>
        </li>

    </ul>

</div>
<div class="col-md-9">
    <div class="tab-content pt-4">
        <div class="tab-pane active show" id="profil">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="#pablo">
                        <img class="img" src="..<?= htmlspecialchars($user->getProfileImage()) ?>" .jpg"/>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-category text-gray"><?= htmlspecialchars($user->getUserName()) ?></h6>
                    <h4 class="card-title"><?= htmlspecialchars($user->getRole()->getName()) ?></h4>
                    <p><?= htmlspecialchars($user->getLastName()) . ' ' . htmlspecialchars($user->getFirstName()) ?></p>
                    <p><?= htmlspecialchars($user->getEmail()) ?></p>
                    <div class="card-description">
                        <?= htmlspecialchars($user->getDescription()) ?>

                    </div>
                    <a href="#pablo" class="btn btn-primary btn-round">Follow</a>
                </div>
            </div>

        </div>
        <div class="tab-pane" id="edit">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit Profile</h4>
                    <p class="card-category">Complete your profile</p>
                </div>
                <div class="card-body">
                    <form class="contact-form" action="/admin/user-edit-<?= htmlspecialchars(urlencode($user->getId())) ?>.html" method="post"
                          enctype="multipart/form-data">

                        <?= $form ?>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


