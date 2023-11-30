<?php
require_once 'session.php';

$conn = null;

define('USER', 'root');
define('PASSWORD', '');
define('HOST', 'localhost');
define('DATABASE', 'questionnaire');
try {
    $conn = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}



?>