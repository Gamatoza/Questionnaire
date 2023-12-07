<?php





//------------------------------------------------
//IDK этот код работает и он когда-то будет нужен

//ajax, потом использовать его нужно в админке
/*$("#form").submit(function () {
    $.ajax({
        type: "POST",
        url: 'testchecker.php',
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

