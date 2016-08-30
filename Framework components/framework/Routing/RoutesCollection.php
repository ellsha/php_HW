<?php

namespace Framework\Routing;

use Framework\Routing\Route;

class RoutesCollection
{
    private $collection;

    public function map($method, $path, callable $action)
    {
        $this->register(new Route($method, $path, $action));
    }

    public function get($path, callable $action)
    {
        $this->map('GET', $path, $action);
    }

    public function post($path, callable $action)
    {
        $this->map('POST', $path, $action);
    }

    public function patch($path, callable $action)
    {
        $this->map('PATCH', $path, $action);
    }

    public function put($path, callable $action)
    {
        $this->map('PUT', $path, $action);
    }

    public function delete($path, callable $action)
    {
        $this->map('DELETE', $path, $action);
    }

    public function register(Route $route)
    {
        $this->collection[] = $route;
    }

    public function collection()
    {
        return $this->collection;
    }
}