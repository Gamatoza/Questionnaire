<?php
require_once '..\config\constants.php';
$cfg = AppConfig::getInstance();

$conn = $cfg->connection;

//relocate it to another script, just to be sure
function addOptions($options): void
{
    $options = AppConfig::getInstance()->connection->query("SELECT * FROM questionnaire.".$options); //TODO обрамить SQLку
    while ($row = $options->fetch()) {
        $name = $row["name"];
        $id = $row["id"];
        echo "<option value='$id'>$name</option>";
    }
}