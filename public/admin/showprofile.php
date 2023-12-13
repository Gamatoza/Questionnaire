<?php
require '../../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;
$id = $_GET['id'];

$query = $conn->query("SELECT * FROM show_main_info where id = $id");
$query->execute();
Utils::showArrayInfo($query->fetch());

?>

<input
    action="action"
    onclick="window.history.go(-1); return false;"
    type="submit"
    value="Cancel"
/>
