<?php

namespace PhotoLoader\Classes;

use Monolog\Logger;

/**
 * Class Container
 * @package PhotoLoader\Classes
 *
 * @property Logger $logger
 * @property array $config
 * @property array $datafile
 */
class Container
{
    private static $instance;
    private $container = [];

    private function __construct() {}

    /**
     * @return Container
     */
    public static function instance()
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->container[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->container[$name];
    }
}

