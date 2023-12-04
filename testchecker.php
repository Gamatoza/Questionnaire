<?php
global $conn;
require_once 'session.php';
require_once 'config.php';
if (isset($_POST['submit-btn']))
{
    $personquery = "insert into person (fio, birthday, citizenship_id, birthplace, address, accommodations_id, phone, family_id,
                    family_structure, education_id, education_info) 
                    values (:fio, :birthday, :citizenship_id, :birthplace, :address, :accommodations_id, :phone, :family_id,
                    :family_structure, :education_id, :education_info);";
    $stmt = $conn->prepare($personquery);

    //TODO: combine it in an array, mb regex with tablename_param and remove tablename_
    $stmt->bindValue("fio");
    $stmt->bindValue("birthday");
    $stmt->bindValue("citizenship_id");
    $stmt->bindValue("birthplace");
    $stmt->bindValue("address");
    $stmt->bindValue("accommodations_id");
    $stmt->bindValue("phone");
    $stmt->bindValue("family_id");
    $stmt->bindValue("family_structure");
    $stmt->bindValue("education_id");
    $stmt->bindValue("education_info");

    $skillsquery = "insert into skills (pc_skills_id, languages, hobbies, advantages)
                    values (:pc_skills_id, :languages, :hobbies, :advantages);";
    $workorgquery = "insert into workorg (organization, post, admission_date, dismissal_date, dismissal_reason, applypost,
                     isagree_position, isagree_removal)
                     values (:organization, :post, :admission_date, :dismissal_date, :dismissal_reason, :applypost,
                     :isagree_position, :isagree_removal);";



    $mainquery = "insert into main (person_id, skills_id, workorg_id, fillingdate)
                  values (:person_id, :skills_id, :workorg_id, :fillingdate);";
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

