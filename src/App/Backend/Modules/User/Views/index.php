


<!-- Page Header -->
<header class="masthead" style="background-image: url('/../img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Djillali TIGUERCHA</h1>
                    <span class="subheading">En mode apprentissage intensif</span>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- Main Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h2>Vous avez <?= $usersNumber ?> users</h2>
            <hr>
            <h3><a href="/admin/user-insert.html">Ajouter un utilisateur</a></h3>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">prénom</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php  foreach($usersList as $user) { ?>
                    <tr>
                        <th scope="row"><?= $user->getId() ?></th>
                        <td><?= $user->getFirstName() ?></td>
                        <td><?= $user->getLastName() ?></td>
                        <td><?= $user->getUserName() ?></td>
                        <td><?= $user->getEmail() ?></td>
                        <td><?= $user->getRole()->getName() ?></td>
                        <td><a href="/admin/user-<?=  $user->getId() ?>.html"><i class="fa fa-eye"></i></a></td>
                        <td><a href=""><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a href=""><i class="far fa-trash-alt"></i></a></td>

                    </tr>

                <?php  } ?>

                </tbody>
            </table>


        </div>
    </div>
</div>
