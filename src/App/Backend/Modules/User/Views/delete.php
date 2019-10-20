<?php
use function OpenFram\h;
use function OpenFram\u;

?>
<div class="col-md-12">
    <div class="card card-profile">
        <div class="card-header card-header-primary">
            <div class="card-avatar">
                <a href="#pablo">
                    <img class="img" src="..<?php echo htmlspecialchars($user->getProfileImage()) ?>"/>
                </a>
            </div>
            <h4 class="card-title">Êtes vous sur de vouloir supprimer cet utlisateur ? </h4>
        </div>


        <div class="card-body">
            <h6 class="card-category text-gray"><?php echo htmlspecialchars($user->getUserName()) ?></h6>
            <h4 class="card-title"><?php echo htmlspecialchars($user->getRole()->getName()) ?></h4>
            <p><?php echo htmlspecialchars($user->getLastName()) . ' ' . htmlspecialchars($user->getFirstName()) ?></p>
            <p><?php echo htmlspecialchars($user->getEmail()) ?></p>

            <form class="contact-form" action="" method="post">

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>
