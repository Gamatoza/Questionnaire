<?php


try {
    // подключаемся к серверу
    $conn = new PDO("mysql:host=localhost;port=3306;dbname=questionnaire", "root", "");
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

//$conn = null;

?>