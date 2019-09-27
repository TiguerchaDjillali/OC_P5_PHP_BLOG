<?php

namespace Tests\OpenFram\Routing;

use OpenFram\Routing\Route;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    private $route;


    public function setUp(): void
{
    $this->route = new Route('/post-([0-9]+)\.html', 'post', 'show', ['id']);

}

    public function tearDown(): void
    {
        unset($this->route);
    }


    public function testMatch()
    {
        $output = $this->route->match("/post-12.html");
        $this->assertEquals([0 => "/post-12.html", 1 => '12'], $output, 'The result should be [0 =>\'/post-12.html\', 1=>12]');
        $output = $this->route->match("/posts-12.html");
        $this->assertFalse($output, 'The result should be false');

    }

}