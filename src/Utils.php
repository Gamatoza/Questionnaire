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

    public static function PrepareCondition(PDO $conn, string $query, array $arr): PDOStatement
    {
        $stmt = $conn->prepare($query);
        foreach ($arr as $key => $value)
        {
            $stmt->bindValue($key,$value);
        }
        return $stmt;
    }

    public static function CreateSelectionCondition(array $arr, array &$prepare_values, bool $isTough = true): string
    {
        $where = [];

        foreach ($arr as $type => $val_array) {
            foreach ($val_array as $key => $value) {
                $pv_key = ($isTough?"t_":"s_").$key.'_'.$type;
                switch ($type) {
                    case "input":
                    {
                        $btw = "=";
                        if (!$isTough) {
                            $btw = "LIKE";
                            $value .= '%';
                        }
                        $where [] = "$key $btw :".$pv_key;
                        $prepare_values[$pv_key] = $value;
                        break;
                    }
                    case "date":
                    {
                        if(isset($value['from']))
                        {
                            $where [] = "DATE($key) > :".$pv_key."_from";
                            $prepare_values[$pv_key."_from"] = $value['from'];
                        }
                        if(isset($value['to']))
                        {
                            $where [] = "DATE($key) < ".$pv_key."_to";
                            $prepare_values[$pv_key."_to"] = $value['to'];
                        }

                        break;
                    }
                    case "id":
                    case "choose":
                    {
                        $where [] = "$key = :".$pv_key;
                        $prepare_values[$pv_key] = $value;
                        break;
                    }
                }


            }
        }

        return implode($isTough ? " AND " : " OR ", $where);
    }

    public static function interpolateQuery($query, $params): string
    {
        $keys = array();
        $values = $params;

        # build a regular expression for each parameter
        foreach ($params as $key => $value) {
            if (is_string($key)) {
                $keys[] = '/:'.$key.'/';
            } else {
                $keys[] = '/[?]/';
            }

            if (is_string($value))
                $values[$key] = "'" . $value . "'";

            if (is_array($value))
                $values[$key] = "'" . implode("','", $value) . "'";

            if (is_null($value))
                $values[$key] = 'NULL';
        }

        $query = preg_replace($keys, $values, $query);

        return $query;
    }

    public static function isArrayEmpty(array $arr):bool
    {
        if(count($arr) <= 0)
        {
            return true;
        }

        foreach ($arr as $value)
        {
            if(!empty($value))
               return false;
        }

        return true;
    }
}