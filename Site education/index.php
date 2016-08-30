<?php

header('Content-type: text/html; charset=utf-8');

require_once 'classes/Data.php';
require_once 'classes/User.php';
require_once 'classes/Connect.php';
require_once 'classes/Authorization.php';
require_once 'lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$data = new Data();

try {
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'cache'       => 'compilation_cache',
        'auto_reload' => true
    ));

    switch ($_SERVER["REDIRECT_URL"]) {
        case "/form": {
            echo $twig->render('form.html');
            break;
        }
        case "/sign-in": {
            echo $twig->render('sign-in.html');
            break;
        }
        case "/sign-up": {
            echo $twig->render('sign-up.html');
            break;
        }
        case "/":
        case "/index":
        case null: {
            include 'handlers/pages.php';
            break;
        }
        case "/add-post": {
            include 'handlers/addPost.php';
            break;
        }
        case "/sign-out": {
            include 'handlers/signOut.php';
            break;
        }
        case "/authorization": {
            include 'handlers/signIn.php';
            break;
        }
        case "/registration": {
            include 'handlers/signUp.php';
            break;
        }
    }
}
catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}

