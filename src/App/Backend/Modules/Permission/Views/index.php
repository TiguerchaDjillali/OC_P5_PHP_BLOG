

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
            <h2 class="text-danger" >Only for Administrator</h2>
            <h2>Vous avez <?= $permissionsNumber ?> permissions</h2>

            <hr>
            <h3><a href="/admin/permission-insert.html">Ajouter une permission</a></h3>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Module</th>
                    <th scope="col">Action</th>
                    <th scope="col">Description</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php  foreach($permissionsList as $permission) { ?>
                    <tr>
                        <th scope="row"><?= $permission->getId() ?></th>
                        <td><?= $permission->getModule() ?></td>
                        <td><?= $permission->getAction() ?></td>
                        <td><?= $permission->getDescription() ?></td>
                        <td><a href=""><i class="fa fa-eye"></i></a></td>
                        <td><a href=""><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a href=""><i class="far fa-trash-alt"></i></a></td>

                    </tr>

                <?php  } ?>
                
                </tbody>
            </table>


        </div>
    </div>
</div>


