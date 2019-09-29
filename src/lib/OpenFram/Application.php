<?php

namespace OpenFram;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use OpenFram\Routing\Route;
use OpenFram\Routing\Router;
use Psr\Http\Message\ServerRequestInterface;
use function Http\Response\send;

abstract class Application
{
    /**
     * @var ServerRequest
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var string
     */
    protected $name;

    protected $currentUser;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->setRequest();
        $this->response = new Response();
        $this->name = '';
    }

    /**
     * @return mixed
     */
    abstract public function run();

    public function getController()
    {
        $router = new Router();
        $xml = new \DOMDocument();
        $xml->load(__DIR__ . '/../../App/' . $this->name . '/Config/routes.xml');

        $routes = $xml->getElementsByTagName('route');


        foreach ($routes as $route) {
            $vars = [];

            if ($route->hasAttribute('vars')) {
                $vars = explode(',', $route->getAttribute('vars'));
            }
            $routeToAdd = new Route(
                $route->getAttribute('url'),
                $route->getAttribute('module'),
                $route->getAttribute('action'),
                $vars
            );
            $router->addRoute($routeToAdd);
        }

        try {
            $matchedRoute = $router->getRoute($this->request->getUri()->getPath());

        } catch (\RuntimeException $e) {
            if ($e->getCode() == Router::NO_ROUTE) {
                exit(send($this->response->withStatus('404')->withBody(stream_for('<h1>Error 404</h1>'))));
            }
        }

        $_GET = array_merge($_GET, $matchedRoute->getVars());

        $controllerClass = 'App\\'.$this->name.'\\Modules\\' . $matchedRoute->getModule() . '\\' . $matchedRoute->getModule() . 'Controller';
        return new $controllerClass($this, $matchedRoute->getModule(), $matchedRoute->getAction());
    }


    /**
     * @return ServerRequest
     */
    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }

    /**
     *
     * @return void
     */
    public function setRequest(): void
    {
        $this->request =  ServerRequest::fromGlobals();
    }

    public function getCurrentUser()
    {
        return $this->currentUser;
    }

    public function getName()
    {
        return $this->name;
    }
}
