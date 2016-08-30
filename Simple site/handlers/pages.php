<?php

$articles = $data->getPageArray($_GET['page']);
$pageCount = $data->getPageCount();

$welcome = "";
if(Authorization::instance()->checkAuth()) {
    $welcome = "Приветствуем, " . Authorization::instance()->getCurrentUsername();
}

echo $welcome;

echo $twig->render('articles.html', array('articles' => $articles, 'pageCount' => $pageCount));