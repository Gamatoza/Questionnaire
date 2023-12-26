<?php
declare(strict_types=1);
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

class Utils
{
    //TODO: where state need to prepare too
    //TODO: \ check diff values before that, if has similar - return false
    public static function bindMultiply(PDO $connection, array $params, int $query_type, string $table, string $where = ""): false|PDOStatement //TODO: feature need for insert/delete
    {
        $keys = array_keys($params);
        $values = array_values($params);
        switch ($query_type) {

            case QueryType::INSERT:
            {
                $insert_values = implode(", ", $keys);
                $implements = implode(", ", array_map(fn($item) => ':' . $item, $keys));
                $query = "insert into $table($insert_values) values ($implements)";
                break;
            }
            case QueryType::UPDATE:
            {
                $set_statement = array_map(fn($elem) => "$elem = :$elem", $keys);
                $query = "update $table set "
                    . implode(", ", $set_statement)
                    . " where " . $where;
                break;
            }
            default:
                return false;
        }


        return self::buildStatement($connection, $query, $values);
    }

    public static function buildStatement(PDO $connection, $sql_query, array $params): false|PDOStatement
    {
        $matches = [];
        $regex = "\"(?<=:)\w*\"";

        $stmt = $connection->prepare($sql_query);
        preg_match_all($regex, $sql_query, $matches);
        for ($i = 0; $i < count($matches[0]); $i++) {
            $stmt->bindValue($matches[0][$i], $params[$i]);
        }
        return $stmt;
    }

    public static function addOptions(string $from, $selected_option = ''): void
    {
        if ($selected_option === '')
            echo "<option selected></option>";
        else echo "<option></option>";
        $result = AppConfig::getInstance()->connection->query("SELECT * FROM questionnaire." . $from); //TODO обрамить SQLку
        while ($row = $result->fetch()) {
            $name = $row["name"];
            $id = $row["id"];
            $selected = $name == $selected_option ? 'selected' : '';
            echo "<option value='$id' $selected>$name</option>";
        }
    }

    public static function showArrayInfo($array): void
    {
        echo "<pre>";
        echo print_r($array, true);
        echo "</pre>";
    }

    public static function getMainData(PDO $connection, array $columns)
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