<?php
require_once '../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

//$_POST = unserialize(file_get_contents("post.log"));

if (isset($_POST['submit-btn']))
{
    $stmt = Utils::bindMultiply($conn,$_POST['person'],QueryType::INSERT,'person');
    $stmt->execute();
    $person_id = $conn->lastInsertId();


    $stmt = Utils::bindMultiply($conn,$_POST['skills'],QueryType::INSERT,'skills');
    $stmt->execute();
    $skills_id = $conn->lastInsertId();


    $stmt = Utils::bindMultiply($conn,$_POST['workorg'],QueryType::INSERT,'workorg');
    $stmt->execute();
    $workorg_id = $conn->lastInsertId();

    $main_query = "insert into main (person_id, skills_id, workorg_id, filling_date, update_date)
              values (:person_id, :skills_id, :workorg_id, now(), now());";

    $stmt = Utils::buildStatement($conn,$main_query,[$person_id,$skills_id,$workorg_id]);
    $stmt->execute();

    //TODO: Insert some page with Thank you for do this question, idk
}


