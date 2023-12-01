<?php
global $conn;
require_once 'session.php';
require_once 'config.php';
if (isset($_POST['submit-btn']))
    echo 'cool';

print_r($_POST); //show all massive
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

