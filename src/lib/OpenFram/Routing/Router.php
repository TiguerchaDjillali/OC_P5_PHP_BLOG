<?php

namespace OpenFram\Routing;

class Router
{
    protected $routes = [];

    const NO_ROUTE = 1;

    /**
     * @param Route $route
     */
    public function addRoute(Route $route)
    {
        if (!in_array($route, $this->routes)) {
            $this->routes[] = $route;
        }
    }

    /**
     * @param  $url
     * @return Route
     */
    public function getRoute(string $url)
    {
        foreach ($this->routes as $route) {

            if (($varsValues = $route->match($url)) !== false) {
                if ($route->hasVars()) {
                    $varsNames = $route->getVarsNames();
                    $listVars = [];
                    foreach ($varsValues as $key => $value) {
                        if ($key !== 0) {
                            $listVars[$varsNames[$key-1]] = $value;
                        }
                    }
                    $route->setVars($listVars);

                }
                return $route;
            }
        }
        throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
    }
}
