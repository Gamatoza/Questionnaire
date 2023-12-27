<?php
require_once '../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;
if (isset($_POST['data'])) {
    $data = $_POST['data'];
    $limit = " LIMIT 100 ";
    //$page = $_POST['page_number'] * $limit;


    $result = Selection($data);

    $tough_query = "SELECT * FROM search_info WHERE $result";

    echo $tough_query;
    if (strlen($result) <= 0) {
        echo "<p style='color:red'>Не задано критериев поиска.</p>";
        return;
    }
    else{
        //TODO: Include there the line with "Производится прямая выборка" or smth
    }

    $info = $conn->query($tough_query.$limit)->fetchAll();
    if (count($info) <= 0) {
        echo "<p style='color:red'>Прямых совпадений не найдено...</p>";
    } else {
        foreach ($info as $value) {
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

    $result = Selection($data, false);
    $soft_query = "SELECT * FROM search_info WHERE $result"
        ." EXCEPT "
        .$tough_query;

    echo $soft_query;

    $info = $conn->query($soft_query.$limit)->fetchAll();
    if (count($info) <= 0) {
        echo "<p style='color:red'>Мягкая выборка ничего не нашла...</p>";
    } else {
        foreach ($info as $value) {
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

//soft??
function Selection(array $arr, bool $isTough = true): string
{
    $where = [];

    foreach ($arr as $id => $value) {
        $_pos = strrpos($id, "_");
        $type = substr($id, $_pos + 1);
        $real_id = substr($id, 0, $_pos);

        if ($value !== '') {
            switch ($type) {
                case "input":
                {
                    $btw = "=";
                    if (!$isTough)
                    {
                        $btw = "LIKE";
                        $value .='%';
                    }

                    $where [] = "$real_id $btw '$value'";
                    break;
                }
                case "date":
                {
                    foreach ($value as $date_period => $date_number) {
                        if ($date_number !== '') {
                            $where [] = strtoupper($date_period) . "($real_id) = $date_number";
                        }
                    }
                    break;
                }
                case "id":
                case "choose":
                {
                    $where [] = "$real_id = $value";
                    break;
                }
            }
        }
    }

    return implode($isTough ? " AND " : " OR ", $where);
}


echo "<pre>" . print_r($_POST, true) . "</pre>";
