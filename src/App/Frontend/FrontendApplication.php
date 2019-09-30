<?php

namespace App\Frontend;

use OpenFram\Application;
use OpenFram\Routing\Route;
use OpenFram\Routing\Router;
use function GuzzleHttp\Psr7\stream_for;
use function Http\Response\send;

class FrontendApplication extends Application
{

    public function __construct()
    {
        parent::__construct();
        $this->name = 'Frontend';
    }

    /**
     * @return void
     */
    public function run(): void
    {

        $controller = $this->getController($this->request->getUri()->getPath());
        $controller->execute();
        $page = $controller->getPage()->getGeneratedPage();
        send($this->response->withBody(stream_for($page)));


    }
}
