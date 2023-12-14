<?php
declare(strict_types=1);
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

class Utils
{
    //TODO: add bind only by FromPOST has values
    public static function bindMultiplyValue(PDO $connection, $sql_query, array $params): false|PDOStatement
    {
        $matches = [];
        $regex = "\"(?<=:)\w*\"";

        $stmt = $connection->prepare($sql_query);
        preg_match_all($regex,$sql_query,$matches);
        for ($i = 0; $i < count($matches[0]); $i++)
        {
            $stmt->bindValue($matches[0][$i],$params[$i]);
        }
        return $stmt;
    }
    public static function bindMultiplyValue_FromPOST(PDO $connection, $sql_query): false|PDOStatement
    {
        $matches = [];
        $regex = "\"(?<=:)\w*\"";

        $stmt = $connection->prepare($sql_query);
        preg_match_all($regex,$sql_query,$matches);
        foreach ($matches[0] as $value)
        {
            $stmt->bindValue($value,$_POST[$value]);
        }
        return $stmt;
    }

    public static function addOptions(string $from, $selected_option = ''): void
    {
        if($selected_option === '')
            echo "<option selected></option>";
        $result = AppConfig::getInstance()->connection->query("SELECT * FROM questionnaire." . $from); //TODO обрамить SQLку
        while ($row = $result->fetch()) {
            $name = $row["name"];
            $id = $row["id"];
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