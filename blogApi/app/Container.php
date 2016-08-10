<?php

namespace BlogApi;

use PDO;

/**
 * Class Container
 * @package BlogApi
 *
 * @property string[] $config
 * @property PDO $connection
 */
class Container
{
    private static $instance;
    private $container = [];

    private function __constuct() {}

    public static function instance()
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function __get($name)
    {
        return $this->container[$name];
    }

    public function __set($name, $value)
    {
        $this->container[$name] = $value;
    }
}