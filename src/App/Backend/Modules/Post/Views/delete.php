<h1> La liste des variables envoyées </h1>

<?php
$vars = get_defined_vars();
foreach ($vars as $key => $value) {
    echo $key . '******' . gettype($value) . '</br>';
}
?>
<hr>
<p> Etes vous sur de supprimer l'article?</p>
<form action="" method="post" >

    <button type="submit">Supprimer</button>

</form>

