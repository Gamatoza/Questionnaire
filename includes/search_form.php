<?php
require_once '../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

//file_put_contents('post.log',serialize($_POST));
//$_POST = unserialize(file_get_contents('post.log'));

if (isset($_POST['data'])) {
    $data = $_POST['data'];
    $limit = " LIMIT 100";
    $prep_arr = [];
    //$page = $_POST['page_number'] * $limit;

    if (Utils::isArrayEmpty($data)) {
        echo "<p style='color:red'>Не задано критериев поиска.</p>";
        return;
    } else {
        //TODO: Include there the line with "Производится прямая выборка..." or smth
    }

    $arr = Utils::typeSplit($data);
   /* echo "</br>---------------arr---------------</br>";

    echo "<pre>" . print_r($arr, true) . "</pre>";*/

    $tough_where = Utils::CreateSelectionCondition($arr,$prep_arr);
    $tough_select = "SELECT * FROM search_info WHERE ";
    $stmt = Utils::PrepareCondition($conn,$tough_select.$tough_where.$limit,$prep_arr);
    $stmt->execute();
    $tough_info = $stmt->fetchAll();

    echo $stmt->queryString;

    if (count($tough_info) <= 0) {
        echo "<p style='color:red'>Прямых совпадений не найдено...</p>";
    } else {
        foreach ($tough_info as $value) {
            echo "<div class='container-fluid'>
                <div class='row'>
                    <div class='form-control text-decoration-none mt-2 ms-1 shadow' >
                    <a href='showprofile.php?id={$value['id']}'>" . $value['fio'] . "</a>
                        <span class='float-end ps-2'><img src='../../assets/img/pencil-square.svg' width='20' height='20' alt=''></span>
                        <span class='float-end'><img src='../../assets/img/printer.svg' width='20' height='20' alt=''></span>
                        <span class='float-end' style='margin-right: 50px; fill: #ed6866'>Полное совпадение <img src='../../assets/img/fullfinded.svg' width='20' height='20' alt=''></span>
                    </div>  
                </div>
            </div>";
        }
    }

    $soft_where = Utils::CreateSelectionCondition($arr,$prep_arr,false);
    $soft_select = "SELECT * FROM search_info WHERE ";
    $stmt = Utils::PrepareCondition($conn,$soft_select.$soft_where." EXCEPT ".$tough_select.$tough_where.$limit,$prep_arr);
    $stmt->execute();
    $soft_info = $stmt->fetchAll();

    echo $stmt->queryString;

    if (count($soft_info) <= 0) {
        echo "<p style='color:red'>Мягкая выборка ничего не нашла...</p>";
    } else {
        foreach ($soft_info as $value) {
            echo "<div class='container-fluid'>
                <div class='row'>
                    <div class='form-control text-decoration-none mt-2 ms-1 shadow' >
                    <a href='showprofile.php?id={$value['id']}'>" . $value['fio'] . "</a>
                        <span class='float-end ps-2'><img src='../../assets/img/pencil-square.svg' width='20' height='20' alt=''></span>
                        <span class='float-end'><img src='../../assets/img/printer.svg' width='20' height='20' alt=''></span>
                        
                            <span class='float-end' style='margin-right: 50px; fill: #ed6866; cursor:pointer;' onclick='softSearch({$value['id']})' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                            Частичное совпадние 
                            <img src='../../assets/img/halffinded.svg' width='20' height='20' alt='' title='Раскрыть список'>
                            </span>
                        </div>
                    </div>  
                </div>
            </div>";
        }
    }
}

echo "</br>---------------POST---------------</br>";

echo "<pre>" . print_r($_POST, true) . "</pre>";


