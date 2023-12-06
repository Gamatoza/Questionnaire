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

