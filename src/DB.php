<?php
namespace Base;

use Illuminate\Database\Capsule\Manager;

class DB
{
    public function __construct(){
        $host = DB_HOST;
        $driver = DB_DRIVER;
        $dbName = DB_NAME;
        $dbUser = DB_USER;
        $dbPass = DB_PASS;

            $capsule = new Manager;
            $capsule->addConnection(
                [
                    "driver" => $driver,
                    "host" => $host,
                    "database" => $dbName,
                    "username" => $dbUser,
                    "password" => $dbPass,
                    "charset" => "utf8",
                    "collation" => "utf8_unicode_ci",
                    "prefix" => ""
                ]
            );
            $capsule->bootEloquent();
    }

    private function __clone(){}

    public function getConnection() : void
    {

    }

}