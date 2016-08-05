<?php

require_once "vendor/autoload.php";

use PhotoLoader\Classes\Container;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$log = new Logger("name");
$log->pushHandler(new StreamHandler('logs/error.log', Logger::WARNING));

$container = Container::instance();
$container->logger = new Logger("error");
$container->config = require "./app/config.php";

$url = array_key_exists("REDIRECT_URL", $_SERVER) ? $_SERVER["REDIRECT_URL"] : "/";

switch ($url) {
    case "/":
    case "/index":
    case null: {
        include "./pages/form.html";
        break;
    }
    case "/image": {
        include "./app/Action/handler.php";
        break;
    }
    default: {
        include "./app/Action/image.php";
        break;
    }
}
