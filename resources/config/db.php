<?php

require_once __DIR__ . './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class database {

    private $host;
    private $user;
    private $pass;
    private $name;

    public function __construct() {
        $this->host = $_ENV["DB_HOST"];
        $this->user = $_ENV["DB_user"];
        $this->pass = $_ENV["DB_pass"];
        $this->name = $_ENV["DB_name"];
    }

    protected function connexion() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->name;charset=utf8";
            $pdo = new PDO($dsn, $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection Failed: " . $e);
        }
        return $pdo;
    }
}