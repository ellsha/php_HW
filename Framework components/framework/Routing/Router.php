<?php

namespace Framework\Routing;

use Framework\Http\Request;
use Framework\Routing\Route;

class Router
{
    /**
     * @var Request $request
     */
    private $request;

    /**
     * @var array $routes
     */
    private $routes;

    /**
     * Router constructor
     *
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param Request $request
     * @return array|bool
     */
    public function resolve(Request $request)
    {
        foreach ($this->routes as $route) {
            $parameters = $this->match($route, $request);

            if(is_array($parameters)) {
                return [$route, $parameters];
            }
        }

        return false;
    }

    /**
     * @param Route $route
     * @param Request $request
     *
     * @return array|bool
     */
    public function match(Route $route, Request $request)
    {
        if($route->method() != $request->method()) {
            return false;
        }

        if($route->path() == $request->path()) {
            return [];
        }

        $routePath = explode('/', trim($route->path(), '/'));
        $requestPath = explode('/', trim($request->path(), '/'));

        if(count($routePath) != count($requestPath)) {
            return false;
        }

        $parameters = [];

        for($i = 0; $i < count($routePath); $i++) {
            if($routePath[$i] == $requestPath[$i]) {
                continue;
            }

            if(preg_match('/{\w+}/', $routePath[$i])) {
                $parameters[] = $requestPath[$i];
            } else {
                return false;
            }
        }

        return $parameters;
    }
}