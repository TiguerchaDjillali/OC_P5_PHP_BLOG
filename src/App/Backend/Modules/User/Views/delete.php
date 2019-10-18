<div class="col-md-12">
    <div class="card card-profile">
        <div class="card-header card-header-primary">
            <div class="card-avatar">
                <a href="#pablo">
                    <img class="img" src="..<?= h($user->getProfileImage()) ?>"/>
                </a>
            </div>
            <h4 class="card-title">Êtes vous sur de vouloir supprimer cet utlisateur ? </h4>
        </div>


        <div class="card-body">
            <h6 class="card-category text-gray"><?= h($user->getUserName()) ?></h6>
            <h4 class="card-title"><?= h($user->getRole()->getName()) ?></h4>
            <p><?= h($user->getLastName()) . ' ' . h($user->getFirstName()) ?></p>
            <p><?= h($user->getEmail()) ?></p>

            <form class="contact-form" action="" method="post">

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>