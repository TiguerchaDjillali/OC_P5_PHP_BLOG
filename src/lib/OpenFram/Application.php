<?php

namespace OpenFram;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use OpenFram\Routing\Route;
use OpenFram\Routing\Router;
use Psr\Http\Message\ServerRequestInterface;
use function GuzzleHttp\Psr7\stream_for;
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
     *
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
        $this->response = new Response();
        $this->currentUser = new CurrentUser($this);
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
                $this->redirect('/');
            }
        }

        $this->request = $this->request->withQueryParams(array_merge($this->request->getQueryParams('GET'), $matchedRoute->getVars()));

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
     * @return ServerRequest
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     *
     * @return void
     */
    public function setRequest( $request): void
    {
        $this->request =  $request;
    }

    public function getCurrentUser()
    {
        return $this->currentUser;
    }

    public function getName()
    {
        return $this->name;
    }

    public function redirect404(string $message = "")
    {
        //TODO: redirection to not found page
        $page = new Page($this);
        $page->addVar('title', 'Erreur 404');
        $page->addVar('message', $message);
        $page->addVar('pageType', 'Erreur 404');
        $page->setContentFile(__DIR__.'/../../Errors/404.php');

        $response = (new Response())->withStatus(404, 'Not Fount');
        send($response->withBody(stream_for($page->getGeneratedPage())));
        exit;
    }

    public function redirect($url)
    {
        send((new Response())->withStatus(301, 'redirection')->withHeader('Location', $url));

        exit;
    }
}
