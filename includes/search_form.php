<?php
require_once '../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;
if (isset($_POST['query'])) {
    $query = "SELECT * FROM show_main_info WHERE fio LIKE '{$_POST['query']}%' LIMIT 100";
    $info = $conn->query($query)->fetchAll();
    if(count($info) > 0)
    foreach ($info as $value) {
        echo "
           <div class='container-fluid'>
                <div class='row'>
                    <a class='form-control text-decoration-none mt-2 ms-1 shadow' href='showprofile.php?id={$value['id']}'>" . $value['fio'] . "
                        <span class='float-end ps-2'><img src='../../assets/img/search.svg' width='20' height='20' alt=''></span>
                        <span class='float-end'><img src='../../assets/img/printer.svg' width='20' height='20' alt=''></span>
                    </a>  
                </div>
            </div>";
    }
    else {
        echo "<p style='color:red'>Пользователь не найден...</p>";
    }
}