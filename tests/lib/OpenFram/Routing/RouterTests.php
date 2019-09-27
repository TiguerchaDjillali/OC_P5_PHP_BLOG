<?php


namespace Tests\OpenFram\Routing;


use OpenFram\Routing\Route;
use OpenFram\Routing\Router;
use PHPUnit\Framework\TestCase;

class RouterTests extends TestCase
{
    private $router;

    public function setUp(): void
    {
        $this->router = new Router();

    }

    public function tearDown(): void
    {
        unset($this->router);
    }

    public function testGetRoute()
    {
        $input = "/post-12.html";

        $this->router->addRoute(new Route('/post-([0-9]+)\.html', 'post', 'show', ['id']));
        $output = $this->router->getRoute($input);
        $this->assertEquals('post', $output->getModule(), 'The result should be equal to \'post\'');
        $this->assertEquals([0 =>'id'], $output->getVarsNames(), 'The result should be equal to \'id\'');
        $this->assertEquals(['id' => 12], $output->getVars(), 'The result should be equal to \'12\'');
    }
}