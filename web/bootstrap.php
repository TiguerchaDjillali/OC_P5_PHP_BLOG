<?php


use GuzzleHttp\Psr7\ServerRequest;

const DEFAULT_APP = 'Frontend';

require '../vendor/autoload.php';

//require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

//require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'OpenFram' . DIRECTORY_SEPARATOR . 'functions.php';



$get = ServerRequest::fromGlobals()->getQueryParams()['app'] ?? false;



if(!$get || !file_exists(__DIR__.'/../src/App/'.$get)) {
    $get['app'] = DEFAULT_APP;
}

$appClass = 'App\\' . $get . '\\' . $get . 'Application';

$app = new $appClass();

$app->run();
