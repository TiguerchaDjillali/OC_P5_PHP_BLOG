<?php

use GuzzleHttp\Psr7\ServerRequest;

const DEFAULT_APP = 'Frontend';

require '../vendor/autoload.php';

$get = ServerRequest::fromGlobals()->getQueryParams()['app'] ?? false;

if (!$get || !file_exists(__DIR__ . '/../src/App/' . $get)) {
    $get['app'] = DEFAULT_APP;
}

$appClass = 'App\\' . $get . '\\' . $get . 'Application';

$app = new $appClass(ServerRequest::fromGlobals());

$app->run();

