<?php
define('ROOT_PATH',$_SERVER['DOCUMENT_ROOT'].'/Questionnaire');
require_once(ROOT_PATH.'/module/config.php');
global $conn;
require_once(ROOT_PATH.'/module/config.php');

if(!isset($_SESSION['uid']) or $_SESSION['uid'] == -1)
    header("location: ../login.php");

function getMainData(PDO $connection, array $columns)
{
    $sql = "SELECT ".implode(', ', $columns)." FROM show_main_info";
    try {
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        /*$output = array();
        while($row = $stmt->fetch()){
            $output[] = $row[$column];
        }*/
        return $stmt->fetchAll();
    }

    catch(PDOException $pe) {
        trigger_error('Could not connect to MySQL database. ' . $pe->getMessage() , E_USER_ERROR);
    }

}

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../source/css/style.css">
    <script type="text/javascript" src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../source/js/elements_scripts.js"></script>
    <title>Опросник</title>
    <script type="text/javascript" src="../source/js/main_script.js"></script>
    <script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <a class="navbar-brand container-fluid" href="#">Questionnaire</a>
    </nav>
</header>

<body>
<?php

//print_r(getColumnNames($conn,"show_main_info"));
//print_r(getMainData($conn,["id","fio"]));
foreach (getMainData($conn,["id","fio"]) as $fio)
{
    echo "<div><a href='showprofile.php?id='>$fio</a></div>";
}

//print_r(array('fio','id'));


?>

</body>


<footer class="container">
    <ul class="border-bottom pb-3 mb-3"></ul>
    <p class="text-center text-body-secondary">© 2023 Company, Inc</p>
</footer>

<!--<script type="text/javascript" src="source/js/phone_input.js"></script>-->
</html>

