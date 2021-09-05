<?php
namespace Base;

class DB
{
    private static $instance;

    private $pdo;

    private function __construct(){}

    private function __clone(){}

    public static function getInstance() : ?self
    {
        if(!self::$instance){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection() : \PDO
    {
        $host = DB_HOST;
        $dbName = DB_NAME;
        $dbUser = DB_USER;
        $dbPass = DB_PASS;

        if(!$this->pdo) {
            $this->pdo = new \PDO(
                "mysql:host=$host;dbname=$dbName",
                $dbUser,
                $dbPass
            );
        }

        return $this->pdo;
    }

}