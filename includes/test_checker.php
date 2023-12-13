<?php
require_once '../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

//$_POST = unserialize(file_get_contents("post.log"));

main($conn);

function bindMultiplyValue(PDO $connection, $sql_query, array $params): false|PDOStatement
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
function bindMultiplyValue_FromPOST(PDO $connection, $sql_query): false|PDOStatement
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

function main(PDO $conn)
{
    if (isset($_POST['submit-btn']))
    {
        $person_query = "insert into person (fio, birthday, citizenship_id, birthplace, address, accommodations_id, phone, family_id,
                    family_structure, education_id, education_date, education_facility, education_faculty) 
                    values (:fio, :birthday, :citizenship_id, :birthplace, :address, :accommodations_id, :phone, :family_id,
                    :family_structure, :education_id, :education_date, :education_facility, :education_faculty);";

        //TODO: combine it in an array, mb regex with tablename_param and remove tablename_
        $stmt = bindMultiplyValue_FromPOST($conn,$person_query);
        $stmt->execute();
        $person_id = $conn->lastInsertId();
        $skills_query = "insert into skills (pc_skills_id, languages, hobbies, advantages)
                    values (:pc_skills_id, :languages, :hobbies, :advantages);";

        $stmt = bindMultiplyValue_FromPOST($conn,$skills_query);
        $stmt->execute();
        $skills_id = $conn->lastInsertId();


        $workorg_query = "insert into workorg (organization, post, admission_date, dismissal_date, dismossal_reason_id, applypost_id,
                     isagree_position, isagree_removal)
                     values (:organization, :post, :admission_date, :dismissal_date, :dismossal_reason_id, :applypost_id,
                     :isagree_position, :isagree_removal);";

        $stmt = bindMultiplyValue_FromPOST($conn,$workorg_query);
        $stmt->execute();
        $workorg_id = $conn->lastInsertId();

        $main_query = "insert into main (person_id, skills_id, workorg_id, fillingdate)
                  values (:person_id, :skills_id, :workorg_id, now());";

        $stmt = bindMultiplyValue($conn,$main_query,[$person_id,$skills_id,$workorg_id]);
        $stmt->execute();

        //TODO: Insert some page with Thank you for do this question, idk

    }
}


