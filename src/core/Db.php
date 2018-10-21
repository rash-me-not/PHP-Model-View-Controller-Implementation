<?php

namespace AztecGameStudios\core;
// use AztecGameStudios\Core\config;
use PDO;

class Db {
    private static $instance;

    private static function connect(): PDO {
        $config = new config();
        $dbConfig = $config->get('db');
        $db = new PDO(
            'mysql:host=127.0.0.1;dbname=aztecgames',
            $dbConfig['user'],
            $dbConfig['password']
        );
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $db;
        
    }

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = self::connect();
        }
        return self::$instance;
    }
}