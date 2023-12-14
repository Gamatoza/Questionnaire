    <?php
require_once '../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

echo "<pre>".print_r($_POST, true)."</pre>";

//$_POST = unserialize(file_get_contents("post.log"));

try {
    $id = $_POST['id'];
    $main_info = $conn->query("select * from main where id = $id")->fetch();
    $person_id = $main_info['person_id'];
    $skills_id = $main_info['skills_id'];
    $workorg_id = $main_info['workorg_id'];

    $person_query = "update person set 
              fio = :fio,
              birthday = :birthday,
              citizenship_id = :citizenship_id,
              birthplace = :birthplace,
              address = :address,
              accommodations_id = :accommodations_id,
              phone = :phone,
              family_id = :family_id,
              family_structure = :family_structure,
              education_id = :education_id,
              education_date = :education_date,
              education_facility = :education_facility,
              education_faculty = :education_faculty
          where id = $person_id";

    $stmt = Utils::bindMultiplyValue_FromPOST($conn, $person_query);
    $stmt->execute();

    $skills_query = "update skills set 
              pc_skills_id = :pc_skills_id,
              languages = :languages,
              hobbies = :hobbies,
              advantages = :advantages
          where id = $skills_id";

    $stmt = Utils::bindMultiplyValue_FromPOST($conn, $skills_query);
    $stmt->execute();

    $workorg_query = "update workorg set 
               organization = :organization,
               post = :post,
               admission_date = :admission_date,
               dismissal_date = :dismissal_date,
               dismissal_reason_id = :dismissal_reason_id,
               applypost_id = :applypost_id,
               isagree_position = :isagree_position,
               isagree_removal = :isagree_removal
           where id = $workorg_id";
    $stmt = Utils::bindMultiplyValue_FromPOST($conn, $workorg_query);
    $stmt->execute();

    $main_query = "update main set update_date = now() where id = $id";

    $stmt = Utils::bindMultiplyValue($conn,$main_query,[$person_id,$skills_id,$workorg_id]);
    $stmt->execute();

    echo "Database update successfully";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}