<?php

class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private static $instance = null;
    public $conn;

    private function __construct() {
        try {
            $this->host     = $_ENV['DB_HOST'] ?? 'localhost';
            $this->dbname   = $_ENV['DB_NAME'] ?? '';
            $this->username = $_ENV['DB_USER'] ?? 'root';
            $this->password = $_ENV['DB_PASS'] ?? '';
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}
/*
try {
    $db = Database::getInstance();
    echo "DB OK (connected)";
} catch (Throwable $e) {
    echo "DB Error: " . $e->getMessage();
}
exit;
*/
?>