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

    public static function typeSplit(array $arr): array
    {
        $result = [];

        foreach ($arr as $id => $value) {
            $_pos = strrpos($id, "_");
            $type = substr($id, $_pos + 1);
            $real_id = substr($id, 0, $_pos);

            if ($value !== '') {
                switch ($type) {
                    case "date":
                    {
                        foreach ($value as $date_period => $date_number) {
                            if ($date_number !== '') {
                                $result ["date"][$real_id][$date_period] = $date_number;
                            }
                        }
                        break;
                    }
                    case "id":
                    case "choose":
                    case "input":
                    {
                        $result [$type][$real_id] = $value;
                        break;
                    }
                }
            }
        }

        return $result;
    }

    public static function SearchExecute(PDO $conn, string $select, array $arr, bool $isTough = true, int $from = 0, int $limit = 100): PDOStatement
    {
        $where = [];
        $i = 0;
        $prepare_values = [];

        foreach ($arr as $type => $val_array) {
            switch ($type) {
                case "input":
                {
                    foreach ($val_array as $key => $value) {

                        $btw = "=";
                        if (!$isTough) {
                            $btw = "LIKE";
                            $value .= '%';
                        }

                        $where [] = "$key $btw :_$i";
                        $prepare_values["_$i"] = $value;
                        $i++;
                    }
                    break;
                }
                case "date":
                {
                    foreach ($val_array as $key => $value) {
                        foreach ($value as $date_period => $date_number) {
                            if ($date_number !== '') {
                                $where [] = strtoupper($date_period) . "($key) = :_$i";
                                $prepare_values["_$i"] = $value;
                                $i++;
                            }
                        }
                    }
                    break;
                }
                case "id":
                case "choose":
                {
                    foreach ($val_array as $key => $value) {
                        $where [] = "$key = :_$i";
                        $prepare_values["_$i"] = $value;
                        $i++;
                    }
                    break;
                }
            }
        }

        $result_query = $select." WHERE ".implode($isTough ? " AND " : " OR ", $where);
        if($from > 0)
        {
            $result_query.=" AND id >= ".$from; //???? TODO: what's id, mb set that
        }
        if($limit > 0)
        {
            $result_query.= " LIMIT ".$limit;
        }

        echo $result_query;

        $stmt = $conn->prepare($result_query);
        $stmt->execute($prepare_values);
        return $stmt;
    }

    public static function SearchSelection(array $arr, bool $isTough = true): string
    {
        $where = [];

        foreach ($arr as $type => $val_array) {
            switch ($type) {
                case "input":
                {
                    foreach ($val_array as $key => $value) {

                        $btw = "=";
                        if (!$isTough) {
                            $btw = "LIKE";
                            $value .= '%';
                        }

                        $where [] = "$key $btw '$value'";
                    }
                    break;
                }
                case "date":
                {
                    foreach ($val_array as $key => $value) {
                        foreach ($value as $date_period => $date_number) {
                            if ($date_number !== '') {
                                $where [] = strtoupper($date_period) . "($key) = $date_number";
                            }
                        }
                    }
                    break;
                }
                case "id":
                case "choose":
                {
                    foreach ($val_array as $key => $value) {
                        $where [] = "$key = $value";
                    }
                    break;
                }
            }
        }

        return implode($isTough ? " AND " : " OR ", $where);
    }

}