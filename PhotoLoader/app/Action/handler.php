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
    $_FILES['datafile']['name'],
    $_FILES['datafile']['tmp_name']
);

$photo->upload();

header('Location: /' . $photo->getImageUrl());