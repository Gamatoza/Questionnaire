<?php
require_once 'session.php';

class DB
{
    private PDO $conn;
    private static string $user = 'root';
    private static string $password = '';
    private static string $host = 'localhost';
    private static string $database = 'questionnaire';
    private static array $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    public static function getDBInstance(): PDO
    {
        if (!isset($conn)) {

            try {
                $conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$database, self::$user, self::$password, self::$options);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                exit("Error: " . $e->getMessage());
            }
        }

        return $conn;
    }
}


