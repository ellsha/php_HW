<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require "./vendor/autoload.php";

use \BlogApi\Controllers\PostsController;
use \BlogApi\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * whoops register
 */
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


/**
 * set config
 * set connection
 */
$container = Container::instance();
$container->config = require "./app/config.php";
$container->connection = new PDO(
    $container->config["mysql_dsn"],
    $container->config["mysql_user"],
    $container->config["mysql_pass"]
);


/**
 * router setting
 */
$router = new AltoRouter();
$router->map('GET', '/posts', [PostsController::class, 'index']);
$router->map('GET', '/posts/[i:id]', [PostsController::class, 'show']);
$router->map('POST', '/posts', [PostsController::class, 'create']);
$router->map('GET|PUT', '/posts/[i:id]', [PostsController::class, 'update']);
$router->map('DELETE', '/posts/[i:id]', [PostsController::class, 'delete']);

$match = $router->match();
$request = Request::createFromGlobals();

if ($match) {
    $target = $match['target'];
    $params = [$request] + $match['params'];

    if (is_array($target) && count($target) == 2) {
        list($controller, $method) = $target;

        try {
            /** @var \Symfony\Component\HttpFoundation\Response $response */
            $response = call_user_func_array([new $controller, $method], $params);
        } catch (\BlogApi\HttpException $e) {
            $response = new JsonResponse($e->getMessage(), $e->getCode());
        } catch (Exception $e) {
            $response = new JsonResponse($e->getMessage(), 500);
        }

        $response->prepare($request);
        $response->send();
    }
} else {
    // no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    var_dump("404", $match);
}