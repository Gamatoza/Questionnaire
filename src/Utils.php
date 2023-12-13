<?php
declare(strict_types=1);
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

class Utils
{
    public static function addOptions(string $options,$selected_option = '', $isyesno = false): void
    {
        if($selected_option === '')
            echo "<option selected></option>";
        $result = AppConfig::getInstance()->connection->query("SELECT * FROM questionnaire." . $options); //TODO обрамить SQLку
        while ($row = $result->fetch()) {
            $name = $row["name"];
            $id = $row["id"];
            if($isyesno) {
                if ($row["name"])
                    $name = "True";
                else $name = "False";
            }
            $selected = $name==$selected_option?'selected':'';
            echo "<option value='$id' $selected>$name</option>";
        }
    }

    public static function showArrayInfo($array): void
    {
        echo "<pre>";
        echo print_r($array, true);
        echo "</pre>";
    }

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
}