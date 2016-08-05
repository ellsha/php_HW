<?php
/**
 * Created by PhpStorm.
 * User: ellsha
 * Date: 05.08.16
 * Time: 15:47
 */

require_once "./vendor/autoload.php";

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$requester = new Request();