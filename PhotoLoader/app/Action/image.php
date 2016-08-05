<?php

namespace PhotoLoader\Action;
use PhotoLoader\Classes\Container;
use PhotoLoader\Classes\Photo;

/**
 * @package PhotoLoader\Action
 */

$container = Container::instance();

$photo = new Photo(
    $container->config['uploadPath'],
    $container->config['uploadDirection'],
    $_SERVER['REDIRECT_URL']
);

if(array_key_exists("width", $_GET) && array_key_exists("height", $_GET)) {

    $width = $_GET['width'];
    $height = $_GET['height'];
    $maxWidth = $container->config['maxWidth'];
    $maxHeight = $container->config['maxHeight'];

    if($width != 0 && $height != 0 && $width <= $maxWidth && $height <= $maxHeight)
    {
        $photo->resize($width, $height);
    }
}

$photo->show();