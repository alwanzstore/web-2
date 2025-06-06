<?php
namespace Config;

require __DIR__ . '/../vendor/autoload.php';

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Connection{
    public static function make(){
        $dotenv = Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->safeLoad();
        $dotenv->required(['DB_HOST','DB_NAME','DB_USER','DB_PASS']);

        $host = $_ENV['DB_USER'];
        $DB = $_ENV['DB_NAME'];
        $USER =$_ENV['DB_USER'];
        $PASS =$_ENV['DB_PASS'];

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$DB; charset=utf8", $USER, $PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
        
    }
}

?>