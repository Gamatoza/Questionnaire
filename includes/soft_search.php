<?php
require_once '../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

if (isset($_POST['data'])) {
    $data = $_POST['data'];
    $id = $_POST['id'];

    $info = $conn->query("select * from show_main_info where id = $id")->fetch();
    if (count($info) <= 0) {
        echo "<p style='color:red'>Прямых совпадений не найдено...</p>";
    }
    else{

        //echo "<pre>".print_r($data, true)."</pre>";

        foreach ($data as $key => $param) {
            $_pos = strrpos($key, "_");
            $real_id = substr($key, 0, $_pos);

            /*echo $real_id."<br>";
            echo $param."<br>";
            echo "-------"."<br>";*/

            if(isset($info[$real_id])){
                echo "<div>$info[$real_id]</div>"; //$real_id =
            }

            //TODO: stylize all id's to russian normal equal, output like education = 'Образование'

        }
    }
}

