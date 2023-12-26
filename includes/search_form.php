<?php
require_once '../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;
if (isset($_POST['data'])) {
    $data = $_POST['data'];

    $result = Selection($data);

    $query = "SELECT * FROM show_main_info WHERE $result LIMIT 100";

    //echo $query;
    if (strlen($result) <= 0) {
        echo "<p style='color:red'>Не задано критериев поиска.</p>";
        return;
    }
    $info = $conn->query($query)->fetchAll();
    if (count($info) <= 0) {
        echo "<p style='color:red'>Пользователь не найден...</p>";
    } else {
        foreach ($info as $value) {
            echo "<div class='container-fluid'>
                <div class='row'>
                    <a class='form-control text-decoration-none mt-2 ms-1 shadow' href='showprofile.php?id={$value['id']}'>" . $value['fio'] . "
                        <span class='float-end ps-2'><img src='../../assets/img/pencil-square.svg' width='20' height='20' alt=''></span>
                        <span class='float-end'><img src='../../assets/img/printer.svg' width='20' height='20' alt=''></span>
                    </a>  
                </div>
            </div>";
        }
    }

}

function AddFounded()
{

}

//soft??
function Selection(array $arr, bool $isTough = false): string
{
    $where = [];

    foreach ($_POST['data'] as $id => $value) {
        $_pos = strrpos($id, "_");
        $type = substr($id, $_pos + 1);
        $real_id = substr($id, 0, $_pos);

        if ($value !== '') {
            switch ($type) {
                case "input":
                {
                    $btw = "LIKE";
                    if ($isTough)
                        $btw = "=";

                    $where [] = "$real_id $btw '$value%'";
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
