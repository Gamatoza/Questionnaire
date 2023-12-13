<?php
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;


class Utils
{
    public static function addOptions($options): void
    {
        $options = AppConfig::getInstance()->connection->query("SELECT * FROM questionnaire." . $options); //TODO обрамить SQLку
        while ($row = $options->fetch()) {
            $name = $row["name"];
            $id = $row["id"];
            echo "<option value='$id'>$name</option>";
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