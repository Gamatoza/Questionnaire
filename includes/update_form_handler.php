<?php
require_once '../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

//echo "<pre>".print_r($_POST, true)."</pre>";
//file_put_contents('post.log',serialize($_POST));
//$_POST = unserialize(file_get_contents("post.log"));

try {
    $id = $_POST['id'];
    $main_info = $conn->query("select * from main where id = $id")->fetch();
    $person_id = $main_info['person_id'];
    $skills_id = $main_info['skills_id'];
    $workorg_id = $main_info['workorg_id'];

    if(isset($_POST['person']))
    {
        $stmt = Utils::bindMultiply($conn,$_POST['person'],
            QueryType::UPDATE,
            'person',
            "id = $person_id");
        $stmt->execute();
    }
    if(isset($_POST['skills']))
    {
        $stmt = Utils::bindMultiply($conn, $_POST['skills'],
            QueryType::UPDATE,
            'skills',
            "id = $skills_id");
        $stmt->execute();
    }
    if(isset($_POST['workorg']))
    {
        $stmt = Utils::bindMultiply($conn, $_POST['workorg'],
            QueryType::UPDATE,
            'workorg',
            "id = $workorg_id");
        $stmt->execute();
    }


    $main_query = $conn->query("update main set update_date = now() where id = $id");
    $main_query->execute();

    echo "Database update successfully";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}