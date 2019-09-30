<h1> La liste des variables envoyées </h1>

<?php
$vars = get_defined_vars();
foreach ($vars as $key => $value) {
    echo $key . '******' . gettype($value) . '</br>';
}
?>
<hr>
<form action="" method="post" >

    <?= $form ?>

    <button type="submit" name = "save" value="0">Enregistrer</button>
    <button type="submit" name="save" value="1">Publier</button>

</form>

