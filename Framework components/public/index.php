<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../framework/Templating/Templater.php';
include '../framework/Contracts/Arrayable.php';
include '../framework/Collection.php';
include '../framework/Routing/Route.php';
include '../framework/Routing/Router.php';
include '../framework/Contracts/Http/Request.php';
include '../framework/Http/Request.php';
include '../framework/Routing/RoutesCollection.php';
$routes = include '../framework/Routing/routes.php';

use Framework\Routing\Router;
use Framework\Http\Request;

$router = new Router($routes);
$resolve = $router->resolve(Request::createFromGlobals());

if (!$resolve) {
    pageNotFound();
}

list($route, $parameters) = $resolve;
call_user_func_array($route->action(), $parameters);


function pageNotFound() {
    header("HTTP/1.0 404 Not Found");
    include '../views/404.html';
    die();
}