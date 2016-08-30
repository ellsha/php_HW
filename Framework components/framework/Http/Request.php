<?php

namespace Framework\Http;

use Framework\Collection;
use Framework\Contracts\Http\Request as RequestInterface;

class Request implements RequestInterface
{
    /**
     * @var string
     */
    public $path;

    /**
     * @var string
     */
    public $method;

    /**
     * @var Collection
     */
    public $input;

    /**
     * Request constructor
     *
     * @param string $path
     * @param string $method
     * @param array $input
     */
    public function __construct($path, $method, array $input)
    {
        $this->path = $path;
        $this->method = $method;
        $this->input = new Collection($input);
    }

    public static function createFromGlobals()
    {
        $path = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $input = array_merge($_GET, $_POST);

        return new self($path, $method, $input);
    }

    /**
     * Return uri from request
     *
     * @return string
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * Return HTTP method from request
     *
     * @return string
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * Get value from input array
     * Returns $default if key not found
     *
     * @param string $key
     * @param null|mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if($this->input->has($key)) {
            return $this->input->get($key);
        }

        return $default;
    }

    /**
     * Checks for the parameter in the request
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return $this->input->has($key);
    }

    /**
     * Return HTTP headers collection
     *
     * @return Collection
     */
    public function headers()
    {
        if($this->input->has('headers')) {
            return $this->input->get('headers');
        }

        return new Collection();
    }

    /**
     * Return cookies collection
     *
     * @return Collection
     */
    public function cookies()
    {
        if($this->input->has('cookies')) {
            return $this->input->get('cookies');
        }

        return new Collection();
    }

    /**
     * Return parameters collection
     *
     * @return Collection
     */
    public function input()
    {
        return $this->input;
    }
}