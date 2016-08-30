<?php

class Connect
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

    private $mysql_host;
    private $mysql_db;
    private $mysql_table;
    private $mysql_dsn;
    private $mysql_user;
    private $mysql_pass;
    private $dbh;
    private $isOpen = false;

    private function setConfig() {
        $config = parse_ini_file("config.ini");
        $this->mysql_host = $config['MYSQL_HOST'];
        $this->mysql_db = $config['MYSQL_DB'];
        $this->mysql_table = $config['MYSQL_TABLE'];
        $this->mysql_dsn = $config['MYSQL_DSN'];
        $this->mysql_user = $config['MYSQL_USER'];
        $this->mysql_pass = $config['MYSQL_PASS'];
    }

    public function open() {
        try {
            if($this->isOpen == false) {
                $this->setConfig();
                $this->dbh = new PDO($this->mysql_dsn, $this->mysql_user, $this->mysql_pass);
                $this->isOpen = true;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getDbh() {
        return $this->dbh;
    }

    public function getTableName() {
        return $this->mysql_table;
    }
}