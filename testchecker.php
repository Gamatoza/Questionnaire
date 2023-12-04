<?php
global $conn;
require_once 'session.php';
require_once 'config.php';


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

$_POST = array (
    'fio' => 'qwe',
    'birthday' => '2023-12-01',
    'citizenship_id' => '1',
    'birthplace' => 'qwe',
    'address' => 'qwe',
    'accommodations_id' => '1',
    'phone' => 'qwe',
    'family_id' => '1',
    'family_structure' => 'qwe',
    'education_id' => '1',
    'education_info' => 'qwe',
    'organization' => 'qwe',
    'post' => 'qwe',
    'admission_date' => '2024-01-03',
    'dismissal_reason' => 'qwe',
    'applypost' => 'qwe',
    'isagree_position' => 'True',
    'isagree_removal' => 'True',
    'pc_skills_id' => '1',
    'languages' => 'qwe',
    'hobbies' => 'qwe',
    'advantages' => 'qwe',
    'submit-btn' => '',
);

if (isset($_POST['submit-btn']))
{
    /*$person_query = "insert into person (fio, birthday, citizenship_id, birthplace, address, accommodations_id, phone, family_id,
                    family_structure, education_id, education_info) 
                    values (:fio, :birthday, :citizenship_id, :birthplace, :address, :accommodations_id, :phone, :family_id,
                    :family_structure, :education_id, :education_info);";

    //TODO: combine it in an array, mb regex with tablename_param and remove tablename_
    $stmt = bindMultiplyValue_FromPOST($conn,$person_query);
    $stmt->execute();
    $person_id = $conn->lastInsertId();
    $skills_query = "insert into skills (pc_skills_id, languages, hobbies, advantages)
                    values (:pc_skills_id, :languages, :hobbies, :advantages);";

    $stmt = bindMultiplyValue_FromPOST($conn,$skills_query);
    $stmt->execute();
    $skills_id = $conn->lastInsertId();


    $workorg_query = "insert into workorg (organization, post, admission_date, dismissal_date, dismissal_reason, applypost,
                     isagree_position, isagree_removal)
                     values (:organization, :post, :admission_date, :dismissal_date, :dismissal_reason, :applypost,
                     :isagree_position, :isagree_removal);";

    $stmt = bindMultiplyValue_FromPOST($conn,$workorg_query);
    $stmt->execute();
    $workorg_id = $conn->lastInsertId();*/
    $person_id = 1;
    $skills_id = 1;
    $workorg_id = 1;
    $main_query = "insert into main (person_id, skills_id, workorg_id, fillingdate)
                  values (:person_id, :skills_id, :workorg_id, now());";

    $stmt = bindMultiplyValue($conn,$main_query,[$person_id,$skills_id,$workorg_id]);
    $stmt->execute();

    echo "Success";

    //TODO: Insert some page with Thank you for do this question, idk

}

//print_r($_POST); //show all massive
/*
all data's

person
[fio] => qwe
[birthday] => 2023-12-02
[citizenship_id] => 0
[birthplace] => qwe
[address] => qwe
[accommodations_id] => 0
[phone] => qwe
[family_id] => 0
[family_structure] => qwe
[education_id] => 0
[education_info] => qwe

workorg
[organization] => qwe
[post] => qwe
[admission_date] => 2024-01-05
[dismissal_reason] => qwe
[applypost] => qwe
[isagree_position] => True
[isagree_removal] => True

skills
[pc_skills_id] => 0
[languages] => qwe
[hobbies] => qwe
[advantages] => qwe

not in db
[submit-btn] =>  //just checker for true input
 */

// TODO-LIST:
// insert into -> person, workorg, skills
// then get id's from their rows and insert into main
// for show use view
// for change... yeah
// for search use view too

