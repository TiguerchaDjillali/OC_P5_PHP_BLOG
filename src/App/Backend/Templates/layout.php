<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
</head>
<body>



<p>User : <?= $currentUser->hasAttribute('user')? $currentUser->getAttribute('user')->getUserName() : '' ?></p>
<p>Role : <?= $currentUser->hasAttribute('user')? $currentUser->getAttribute('user')->getRole()->getName() : '' ?></p>
<h3>Message : <?= $currentUser->hasFlash()?  $currentUser->getFlash(): 'Hello' ?></h3>

<?php

echo $content;

?>

</body>
</html>