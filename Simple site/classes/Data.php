<?php

class Data
{
    private $connect;
    private $countPerPage;

    public function __construct() {
        $this->connect = Connect::instance();
        $this->connect->open();
        $config = parse_ini_file("config.ini");
        $this->countPerPage = $config['ARTICLES_PER_PAGE'];
    }

    public function getFullArray() {
        $sth = $this->connect->getDbh()->prepare("SELECT * FROM " . $this->connect->getTableName());
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    public function getPageArray($page) {
        return array_slice($this->getFullArray(), --$page * $this->countPerPage, $this->countPerPage);
    }

    public function createRow($title, $content) {
        $stmt = $this->connect->getDbh()->prepare("INSERT INTO " . $this->connect->getTableName() .
            "(title, content) VALUES (:title, :content)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->execute();
    }

    public function getPageCount() {
        $articlesCount = count($this->getFullArray());
        return (int)ceil($articlesCount / $this->countPerPage);
    }
}