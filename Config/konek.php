<?php

namespace Config;

require_DIR_.'/../vendor/autoload.php';

use PDO;
use PDOException;
use DOtenv\DOtenv;

class konek {
    public static function make()
    {
        $dotenv = Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->safeLoad();
        $dotenv->required(['DB_HOST','DB_NAME','DB_USER','DB_PASS']);

        $host = $_ENV['DB_HOST'];
        $host = $_ENV['DB_NAME'];
        $host = $_ENV['DB_USER'];
        $host = $_ENV['DB_PASS'];

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass, [
                PDO::ATTR_ERRMODE=>
                PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FECT_MODE =>
                PDO::FECT_ASSOC
            ]);    
        } catch (PDOException $e) {
            die("koneksi gagal: " .$se->getMessage());
        }
    }
    
}

?>