<?php
use function OpenFram\h;

?>
<div class="col-md-8">
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title"><?= htmlspecialchars($title) ?></h4>
        </div>
        <div class="card-body">
            <p class="card-category">Etes vous sur de vouloir supprimer l'article?</p>
            <ul class="list-group list-unstyled">
                <li class="list-item">Titre: <?= htmlspecialchars($post->getTitle()) ?></li>
                <li class="list-item">Auteur: <?= htmlspecialchars($post->getUser()->getUsername()) ?></li>
                <li class="list-item">Sous-titre: <?= htmlspecialchars($post->getSubTitle()) ?></li>
            </ul>

            <form class="contact-form" action="" method="post">

                <div class="form-group">
                    <button type="submit"  class="btn btn-primary" >Supprimer</button>
                </div>
            </form>

        </div>
    </div>
</div>
