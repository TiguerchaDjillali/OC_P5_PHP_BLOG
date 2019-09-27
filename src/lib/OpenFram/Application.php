<?php

namespace OpenFram;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

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
