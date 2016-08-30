<?php

$auth = Authorization::instance();
$login = $_POST['login'];
$password = $_POST['password'];

if($auth->checkPassword($login, $password)) {
    echo "Приветствуем вас, $login!<br><a href='/'>На главную страницу</a>";
} else {
    echo "Вы ввели неправильные данные.<br><a href='/'>На главную страницу</a>";
}

$auth->authorize($login);
