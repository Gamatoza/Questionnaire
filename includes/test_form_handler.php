<?php
require_once '../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

//$_POST = unserialize(file_get_contents("post.log"));

if (isset($_POST['submit-btn']))
{
    $person_query = "insert into person (fio, birthday, citizenship_id, birthplace, address, accommodations_id, phone, family_id,
                family_structure, education_id, education_date, education_facility, education_faculty) 
                values (:fio, :birthday, :citizenship_id, :birthplace, :address, :accommodations_id, :phone, :family_id,
                :family_structure, :education_id, :education_date, :education_facility, :education_faculty);";

    //TODO: combine it in an array, mb regex with tablename_param and remove tablename_
    $stmt = Utils::bindMultiplyValue_FromPOST($conn,$person_query);
    $stmt->execute();
    $person_id = $conn->lastInsertId();
    $skills_query = "insert into skills (pc_skills_id, languages, hobbies, advantages)
                values (:pc_skills_id, :languages, :hobbies, :advantages);";

    $stmt = Utils::bindMultiplyValue_FromPOST($conn,$skills_query);
    $stmt->execute();
    $skills_id = $conn->lastInsertId();


    $workorg_query = "insert into workorg (organization, post, admission_date, dismissal_date, dismossal_reason_id, applypost_id,
                 isagree_position, isagree_removal)
                 values (:organization, :post, :admission_date, :dismissal_date, :dismossal_reason_id, :applypost_id,
                 :isagree_position, :isagree_removal);";

    $stmt = Utils::bindMultiplyValue_FromPOST($conn,$workorg_query);
    $stmt->execute();
    $workorg_id = $conn->lastInsertId();

    $main_query = "insert into main (person_id, skills_id, workorg_id, filling_date, update_date)
              values (:person_id, :skills_id, :workorg_id, now(), now());";

    $stmt = Utils::bindMultiplyValue($conn,$main_query,[$person_id,$skills_id,$workorg_id]);
    $stmt->execute();

    //TODO: Insert some page with Thank you for do this question, idk

}


