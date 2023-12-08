<?php
require_once '..\config\constants.php';
$cfg = AppConfig::getInstance();
require_once $cfg->includesPath["scripts.php"];
$conn = $cfg->connection;

if(!isset($_SESSION['uid']) or $_SESSION['uid'] == -1)
    header("location: login.php");

function getMainData(PDO $connection, array $columns)
{
    $sql = "SELECT " . implode(', ', $columns) . " FROM show_main_info";
    try {
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        /*$output = array();
        while($row = $stmt->fetch()){
            $output[] = $row[$column];
        }*/
        return $stmt->fetchAll();
    } catch (PDOException $pe) {
        trigger_error('Could not connect to MySQL database. ' . $pe->getMessage(), E_USER_ERROR);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='../node_modules/bootstrap/dist/css/bootstrap.min.css' integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script type="text/javascript" src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/elements_scripts.js"></script>
    <title>Опросник</title>
    <script type="text/javascript" src="../assets/js/main_script.js"></script>
    <script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</head>

<?php include $cfg->templatesPath["header.php"]?>

<body>
<?php

//print_r(getColumnNames($conn,"show_main_info"));
//print_r(getMainData($conn,["id","fio"]));
$fio = getMainData($conn,["id","fio"]);
foreach ($fio as $value)
{
    echo "<div><a href='showprofile.php?id='".$value['id']."'>".$value['fio']."</a></div>";
}

//print_r(array('fio','id'));


?>

</body>

<?php include $cfg->templatesPath["footer.php"]?>

<!--<script type="text/javascript" src="source/js/phone_input.js"></script>-->
</html>

