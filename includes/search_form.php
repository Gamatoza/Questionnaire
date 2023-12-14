<?php
require_once '../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;
if (isset($_POST['query'])) {
    $query = "SELECT * FROM show_main_info WHERE fio LIKE '{$_POST['query']}%' LIMIT 100";
    $info = $conn->query($query)->fetchAll();
    if(count($info) > 0)
    foreach ($info as $value) {
        echo "<div><a href='showprofile.php?id={$value['id']}'>" . $value['fio'] . "</a></div>";
    }
    else {
        echo "<p style='color:red'>Пользователь не найден...</p>";
    }
}
