<?php

class User
{
    private $connect;

    public function __construct() {
        $this->connect = Connect::instance();
        $this->connect->open();
    }

    public function getId($login) {
        $sql = "SELECT id FROM users WHERE login = ?";
        $sth = $this->connect->getDbh()->prepare($sql);
        $sth->bindParam(1, $login);
        $sth->execute();
        $data = $sth->fetchAll();
        return $data[0]['id'];
    }

    public function getLogin($id) {

    }

    public function create($login, $password) {
        $sql = "INSERT INTO users (login, pass, ip) VALUES (?, ?, ?)";
        $sth = $this->connect->getDbh()->prepare($sql);
        $sth->bindParam(1, $login);
        $sth->bindParam(2, md5($password));
        $sth->bindParam(3, ip2long($_SERVER['REMOTE_ADDR']));

        // $long = ip2long($_SERVER['REMOTE_ADDR']);
        // $ip   = long2ip($long);

        $sth->execute();
    }
}