<?php
/**
 * Created by PhpStorm.
 * User: ellsha
 * Date: 05.08.16
 * Time: 15:38
 */

interface Request
{
    public function get($key, $default = null);
    public function has($key);
    public function set($key, $value);
    public function header($key, $default = null);
    public function method();
    public function uri();
}