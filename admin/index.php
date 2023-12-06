<?php
require_once('../module/config.php');
global $conn;
require_once('../module/config.php');

if(!isset($_SESSION['uid']) or $_SESSION['uid'] == -1)
    header("location: login.php");

print_r(getColumnNames($conn,"main"));


function getColumnNames(PDO $connection, $table){
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = :table";
    try {
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':table', $table, PDO::PARAM_STR);
        $stmt->execute();
        $output = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $output[] = $row['COLUMN_NAME'];
        }
        return $output;
    }

    catch(PDOException $pe) {
        trigger_error('Could not connect to MySQL database. ' . $pe->getMessage() , E_USER_ERROR);
    }
}

