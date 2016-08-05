<?php

/**
 * Created by PhpStorm.
 * User: ellsha
 * Date: 05.08.16
 * Time: 16:33
 */

class Request
{
    private $params;
    private $headers;
    private $method;
    private $uri;

    public function __construct()
    {
        $this->params = array_merge($_GET, $_POST);
        $this->headers = getallheaders();
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    /**
     * @param $key
     * @param null $default
     * @return null|string
     */
    public function get($key, $default = null)
    {
        if($this->has($key)) {
            return $this->params[$key];
        }

       return $default;
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->params);
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @param $key
     * @param null $default
     * @return null|string
     */
    public function header($key, $default = null)
    {
        if(array_key_exists($key, $this->headers))  {
            return $this->headers[$key];
        }

        return $default;
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
    public function uri()
    {
        return $this->uri;
    }
}