<?php

use Framework\Routing\RoutesCollection;
use Framework\Templating\Templater;

$templater = new Templater('../views');
$routes = new RoutesCollection();

$routes->get('/', function() {
    echo 'Home';
});
$routes->get('/hello', function() {
    echo "hello!";
});
$routes->get('/hello/{username}', function($username) use ($templater) {
    echo $templater->parse('/hello.html', ['username' => $username]);
});

return $routes->collection();
