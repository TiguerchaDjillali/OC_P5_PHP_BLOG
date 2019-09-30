

<h1> La liste des variables envoyées </h1>

<?php
$vars = get_defined_vars();
foreach($vars as $key => $value){
    echo $key.'******'.gettype($value).'</br>';
}
?>


<hr>
<div class="container-fluid">
    <div class="row">


        <div class="col-lg-8 col-md-10 mx-auto">
            <h2>Vous avez <?= $postsNumber ?> articles</h2>
            <hr>
            <h3><a href="/admin/post-insert.html">Ajouter un article</a></h3>
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Titre</th>
                    <th>Autheur</th>
                    <th>Visible</th>
                    <th>Date d'ajout</th>
                    <th>Date de modification</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($postsList as $post) { ?>
                    <tr>
                        <th scope="row"><?= $post->getId() ?></th>
                        <td><?= $post->getTitle() ?></td>
                        <td><?= $post->getUser()->getUserName() ?></td>
                        <td><?= $post->isVisible() ? 'Oui' : 'Non' ?></td>
                        <td><?= $post->getPublicationDate()->format('d/m/y') ?></td>
                        <td><?= $post->getPublicationDate()->format('d/m/y') ?></td>
                        <td><a href="/admin/post-show-<?= $post->getId() ?>.html"> View </a></td>
                        <td><a href="/admin/post-update-<?= $post->getId() ?>.html"> Update </a></td>
                        <td><a href="/admin/post-delete-<?= $post->getId() ?>.html"> Delete </a></td>

                    </tr>

                <?php } ?>

                </tbody>
            </table>


        </div>
    </div>


</div>

