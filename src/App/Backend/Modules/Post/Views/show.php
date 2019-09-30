<h1> La liste des variables envoyées </h1>
<?php
$vars = get_defined_vars();
foreach ($vars as $key => $value) {
    echo $key . '******' . gettype($value) . '</br>';
}
?>
<hr>

<p><a href="/admin/post-preview-<?= $post->getId() ?>.html">Prévisuliser</a></p>

<h2><?=  $post->getTitle() ?></h2>
<h3><?=  $post->getSubTitle() ?></h3>
<p><?=  $post->getContent() ?></p>

<hr>
<?php foreach($comments as $comment){ ?>
    <p><?=  $comment->getContent() ?></p>
    <hr>

<?php } ?>


