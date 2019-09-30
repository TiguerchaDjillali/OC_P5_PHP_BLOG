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



<!-- Role Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2> Role : <?= $role->getName() ?> </h2>
                <h2> Slug : <?= $role->getSlug() ?> </h2>



                <hr>
                <h3>Vous avez <?= count($permissions) ?> permissions</h3>
                <hr>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Module</th>
                        <th scope="col">Action</th>
                        <th scope="col">Description</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php  foreach($permissions as $permission) { ?>
                        <tr>
                            <th scope="row"><?= $permission->getId() ?></th>
                            <td><?= $permission->getModule() ?></td>
                            <td><?= $permission->getAction() ?></td>
                            <td><?= $permission->getDescription() ?></td>

                        </tr>

                    <?php  } ?>

                    </tbody>
                </table>


            </div>
        </div>
    </div>
</article>



