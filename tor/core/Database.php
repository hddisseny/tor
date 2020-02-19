<?php

namespace tor\core;

class Database {
    private $pdo_database_instance;

    public function __construct()
    {
        
        $host = TOR_DB_HOST;
        $db   = TOR_DB_NAME;
        $user = TOR_DB_USER;
        $pass = TOR_DB_PASS;
        $charset = 'utf8mb4';

        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        try {
             $this->pdo_database_instance = new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

    }
    public function prepare(){
        $stmt =  $this->pdo_database_instance->query("SELECT * FROM tt");
        print_r($stmt);
    }
}