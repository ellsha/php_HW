<?php

class Authorization
{
    private static $instance;
    private function __construct() {}
    public static function instance()
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function authorize($login) {
        $user = new User();
        $id = $user->getId($login);
        $hash = $this->generateCode($id);
        $sql = "INSERT INTO `authorization` (id, hash) VALUES (?, ?)";
        $sth = Connect::instance()->getDbh()->prepare($sql);
        $sth->bindParam(1, $id);
        $sth->bindParam(2, $hash);
        $sth->execute();
        setcookie("token", $hash, time()+60*60*24*30);
    }

    public function exitUser() {
        $token = $_COOKIE['token'];
        $sql = "DELETE FROM authorization WHERE hash = ?;";
        $sth = Connect::instance()->getDbh()->prepare($sql);
        $sth->bindParam(1, $token);
        $sth->execute();
    }

    public function generateCode($id) {
        return md5($id * time());
    }

    public function checkAuth() {
        $result = false;
        $token = $_COOKIE['token'];
        $userId = $this->getUserId($token);
        if(isset($token) && isset($userId)) {
            $result = true;
        }
        return $result;
    }

    public function getCurrentUsername() {
        $sql = "SELECT * FROM users INNER JOIN authorization using(id) WHERE hash = ?;";
        $sth = Connect::instance()->getDbh()->prepare($sql);
        $sth->bindParam(1, $_COOKIE['token']);
        $sth->execute();
        $data = $sth->fetchAll();
        return $data[0]['login'];
    }

    public function getUserId($token) {
        $sql = "SELECT * FROM users INNER JOIN authorization using(id) WHERE hash = ?;";
        $sth = Connect::instance()->getDbh()->prepare($sql);
        $sth->bindParam(1, $token);
        $sth->execute();
        $data = $sth->fetchAll();
        return $data[0]['id'];
    }

    public function checkPassword($login, $password) {
        $result = false;
        $hash = md5($password);
        if($this->getPasswordHash($login) == $hash) {
            $result = true;
        }
        return $result;
    }

    public function checkLogin($login)
    {
        $result = false;
        $sql = "SELECT COUNT(*) FROM users WHERE login = ?";
        $sth = Connect::instance()->getDbh()->prepare($sql);
        $sth->bindParam(1, $login);
        $sth->execute();
        $count = $sth->fetchAll();
        if($count[0][0] == 1) {
            $result = true;
        }
        return $result;
    }

    private function getPasswordHash($login) {
        $sql = "SELECT * FROM users WHERE login=?";
        $sth = Connect::instance()->getDbh()->prepare($sql);
        $sth->bindParam(1, $login);
        $sth->execute();
        $data = $sth->fetchAll();
        return $data[0]['pass'];
    }
}