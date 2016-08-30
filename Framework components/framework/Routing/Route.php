<?php

namespace Framework\Routing;

class Route
{
    /**
     * @var string method
     */
    private $method;

    /**
     * @var string $path
     */
    private $path;

    /**
     * @var callable $action
     */
    private $action;

    /**
     * Route constructor
     *
     * @param string $path
     * @param string $method
     * @param callable $action
     */
    public function __construct($method, $path, callable $action)
    {
        $this->method = strtoupper($method);
        $this->path = $path;
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * @return callable
     */
    public function action()
    {
        return $this->action;
    }

}