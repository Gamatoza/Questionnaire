<?php
declare(strict_types=1);
require_once '../vendor/autoload.php';
$cfg = AppConfig::getInstance();

$some = array();
$some['a'] = '1';
$some['somearray'] = ['2','3','4'];
$some[] = [['5'],'6'];

echo "<pre>";
print_r($some);
echo "</pre>";



//$cfg = AppConfig::getInstance();






/*$cssPath = $cfg->rootPath."\\assets\\css\\";
//var_dump(getFileConnections($cssPath));

$some = getFileConnections($cssPath);

var_dump($some);

function getFileConnections(string $rootPath): array
{
    $cfg = constants::getInstance();
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath));

    $paths = array();
    foreach ($rii as $file)
        if (!$file->isDir()) {
            $filename = explode($cfg->rootPath, $file->getPathname());
            $paths[] = 'Questionnaire'.end($filename);
        }//TODO: может быть можно сократить до $file->getFilename, хз, надо почитать про rii

    $result = [];
    foreach ($paths as $path) {
        $result[pathinfo($path, PATHINFO_FILENAME) . '.' . pathinfo($path, PATHINFO_EXTENSION)] = $path;
    }
    return $result;
}*/

//------------------------------------------------
//IDK этот код работает и он когда-то будет нужен

//получение названий колонок
/*function getColumnNames(PDO $connection, $table){
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = :table";
    try {
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':table', $table, PDO::PARAM_STR);
        $stmt->execute();
        $output = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $output[] = $row['COLUMN_NAME'];
        }
        return $output;
    }

    catch(PDOException $pe) {
        trigger_error('Could not connect to MySQL database. ' . $pe->getMessage() , E_USER_ERROR);
    }
}*/

//ajax, потом использовать его нужно в админке
/*$("#form").submit(function () {
    $.ajax({
        type: "POST",
        url: 'test_form_handler.php',
        data: $("#form").serialize(),
        beforeSend: function () {
            // Вывод текста в процессе отправки
            //$(formNm).html('<p style="text-align:center">Отправка...</p>');
        },
        success: function (data) {
            // Вывод текста результата отправки
            //$(formNm).html('<p style="text-align:center">'+data+'</p>');
            alert("success");
            alert(data);
        },
        error: function (jqXHR, text, error) {
            // Вывод текста ошибки отправки
            alert("error");

            //$(formNm).html(error);
        }
    });
    return false;
});*/

//выкачка $_POST в отдельный файл
//var_dump($_POST);
/*file_put_contents('post.log', serialize($_POST));
$data = unserialize(file_get_contents("post.log"));

print_r($data);*/



//TODO use classes PHP for saving values before refresh
//сохранение переменных через php, сейчас через js
/*example

html
<form id="formId" action="" method="post">
    <input type="hidden" id="hiddenAction" name="hiddenAction" value="" />
    <input type="text" id="firstName" name="firstName" value="" />
</form>

jquery
$("#formId #hiddenAction").val("refreshed") ;
$("#formId").submit() ;

php
$firstName = "";
if (isset($_POST["hiddenAction"]) && $_POST["hiddenAction"] == "refreshed") { //When the hidden action is set to "refreshed" then we know that this is coming from refreshing the page
    $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : ""; //Of course you have to escape the string and strip it from any pure html tags
}

html inputs replace or some try to jquery .prop add <?=$class.name(???????)?>
<input type="text" id="firstName" name="firstName" value="<?php echo $firstName ?>" />

 */

