<?php
class Database {
    private static $host = 'localhost';
    private static $db_name = 'web1_final_project';
    private static $username = 'root';
    private static $password = '';
    private static $conn = null;

    public static function connect() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name . ";charset=utf8mb4", self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                die("Connection Error: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
?>