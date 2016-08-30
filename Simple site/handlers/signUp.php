<?php

$user = new User();
$login = $_POST['login'];
$password = $_POST['password'];

if($user->checkLogin($login)) {
    echo "Пользователь с таким логином уже есть.<br><a href='/'>На главную страницу</a>";
    die();
}

$user->create($login, $password);
echo "Теперь вы можете войти на сайт.<br><a href='/'>На главную страницу</a>";