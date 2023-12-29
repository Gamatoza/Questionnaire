<?php
require_once '../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

//file_put_contents('post.log',serialize($_POST));
//$_POST = unserialize(file_get_contents('post.log'));

if (isset($_POST['data'])) {
    $data = $_POST['data'];
    $id = $_POST['id'];

    $stmt = $conn->prepare("select * from search_info where id = :id");
    $stmt->bindValue("id", $id);
    $stmt->execute();

    $info = $stmt->fetch();
    if (count($info) <= 0) {
        echo "<p style='color:red'>Прямых совпадений не найдено...</p>";
    } else {
        $prep = Utils::typeSplit($data);
        echo "</br>---------------Prep---------------</br>";
        echo "<pre>" . print_r($prep, true) . "</pre>";
        echo "</br>---------------Info---------------</br>";
        echo "<pre>" . print_r($info, true) . "</pre>";
        foreach ($prep as $type => $val_array) {
            foreach ($val_array as $key => $value) {
                if (isset($info[$key])) {
                    if ($type == "id" or $type == "choose") {
                        if(!str_contains($info[$key],$value))
                            continue;
                        $_pos = strrpos($key, "_");
                        $key = substr($key, 0, $_pos);
                    } else if ($type == "data") {
                        continue;
                    }
                    else {
                        if(!str_contains($info[$key],$value))
                            continue;
                    }



                    echo "<div>$info[$key]</div>"; //$real_id
                }
            }
            //TODO: stylize all id's to russian normal equal, output like education = 'Образование'

        }
    }
}

