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
        $this->name = 'FrontEnd';
    }

    /**
     * @return void
     */
    public function run(): void
    {
        echo $this->request->getUri()->getPath();
        send($this->response->withBody(stream_for("<h1> Hello from FrontendApplication</h1>")));
        $route = new Route('/post-([0-9]+)\.html', 'post', 'show', ['id']);
        var_dump($route->match('/post-1.html'));
        $router = new Router();
        $router->addRoute($route);
        var_dump($router->getRoute('/post-1.html'));
    }
}
