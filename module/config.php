<?php
require_once 'session.php';

$conn = null;

$user = 'root';
$password = '';
$host = 'localhost';
$database = 'questionnaire';
$options = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
try {
    $conn = new PDO("mysql:host=".$host.";dbname=".$database, $user, $password, $options);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

