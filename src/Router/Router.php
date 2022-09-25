<?php

namespace Router;

/**
 * Handling HTTP requests
 */

class Router 
{
    private array $routes = [];
    private array $errorRoute = [];

    /** 
     * Add route
     * 
     * @return void
     */
    public function addRoute(array $route): void
    {
        $this->routes[] = $route;
    }

    /**
     * Set route for 404
     * 
     * @return void
     */
    public function setErrorRoute(array $route): void
    {
        $this->errorRoute = $route;
    }

    /**
     * Match router based on provided request url
     * 
     * @param string $requestUrl
     * @return array
     */
    public function match(string $requestUrl): array
    {
        if (($key = array_search($requestUrl, array_column($this->routes, 'url'))) !== false) {
            return $this->routes[$key];
        }

        return $this->errorRoute;
    }

}