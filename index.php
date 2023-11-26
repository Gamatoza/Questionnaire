<?php
global $conn;
include_once 'connection.php';

$education_options = $conn->query("SELECT * FROM questionnaire.education;");
$citizenship_options = $conn->query("SELECT * FROM questionnaire.citizenship;");
$accommodations_options = $conn->query("SELECT * FROM questionnaire.accommodations;");
$family_options = $conn->query("SELECT * FROM questionnaire.family;");
$pcskills = $conn->query("SELECT * FROM questionnaire.pcskills;");

function addoptions($options)
{
    $i = 0;
    while($row = $options->fetch()){
        $name = $row["Name"];
        echo "<option value='$i'>$name</option>";
        $i++;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/source/css/style.css">
    <title>Main</title>
</head>

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <a class="navbar-brand container-fluid" href="#">Questionnaire</a>
    </nav>
</header>

<body>
    <div class="container-fluid text-left">
        <div class="row">
            <div class="col-md-12 text-center pt-3 pb-3"><b>ЛИЧНЫЕ ДАННЫЕ</b></div>
        </div>
        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Фамилия, имя, отчество</b> (полностью)</div>
            <div class="col-lg-7 col-md-7 col-sm-12 ">
                <div class="input-group">
                    <input outline="none" type="text" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Дата рождения</b></div>
            <div class="col-lg-2 col-md-3 col-sm-3">
                <div class="form-group">
                    <input type="date" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Гражданство</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <select class="form-select border-0" aria-label="Small select example">
                    <option selected></option>
                    <?php addoptions($citizenship_options); ?>

                </select>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Место рождения</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Адрес места жительства</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Условия проживания</b> (необходимо выбрать)</div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <select class="form-select border-0" aria-label="Small select example">
                    <option selected></option>
                    <?php addoptions($accommodations_options); ?>
                </select>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Мобильный телефон:</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <input class=" container-fluid form-control border-0" id="phone" type="tel" pattern="(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?"
                        title="Введите номер телефона в формате +375 XX XXX XX XX" required>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Семейное положение</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <select class="form-select border-0" aria-label="Small select example">
                    <option selected></option>
                    <?php addoptions($family_options); ?>
                </select>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end">
                <b>Состав семьи: дети</b>(год рождения), <b>супруг(а) </b>(год рождения), живу <b>один(а)</b>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Образование </b>(необхоимо выбрать)</div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <select class="form-select border-0" aria-label="Small select example">
                        <option selected></option>
                    <?php addoptions($education_options); ?>
                    </select>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Окончил </b>(когда, что, какой факультет) </div>
            <div class="col-lg-2 col-md-3 col-sm-3">
                <div class="input-group">
                    <input type="text" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-md-12 text-center pt-3 pb-3"><b>РАБОТА В ПРОШЛОМ</b></div>
        </div>

        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b><u>Последнее место работы:</u></b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Организация</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Должность</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Дата приема/увольнения</b></div>
            <div class="col-lg-2 col-md-3 col-sm-3">
                <div class="form-group">
                    <input type="date" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Причина увольнения</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-12 col-md-12 col-sm-12 text-center pt-3 pb-3"><b>РАБОТА В БУДУЩЕМ</b></div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>На какую должность претендует</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Согласен ли на рабочую должность </b>(необходимо выбрать)</div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <select class="form-select border-0" aria-label="Small select example">
                    <option selected></option>
                    <option value="1">Да</option>
                    <option value="2">Нет</option>
                </select>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Согласен ли на переезд в другую местность </b>(необходимо выбрать)</div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <select class="form-select border-0" aria-label="Small select example">
                    <option selected></option>
                    <option value="1">Да</option>
                    <option value="2">Нет</option>
                </select>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-12 col-md-12 col-sm-12 text-center pt-3 pb-3"><b>ЛИЧНЫЕ КАЧЕСТВА И НАВЫКИ</b></div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Навыки владения компьютером </b>(необходимое выбрать)<br></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <select class="form-select border-0" aria-label="Small select example">
                    <option selected></option>
                    <?php addoptions($pcskills); ?>
                </select>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Знание иностранных языков, степень владения</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end">
                <b>Личные увлечения (хобби): </b>(спорт - вид спорта, худ. самод. - танцы, вокал и др.)
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Преимущество Вашей кандидатуры </b>(сильные стороны, положительные
                качества и др.)</div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control border-0">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-12 col-md-12 col-sm-12"><br><b>Против проверки предоставленной мною информации не возражаю.</b><br></div>
        </div>

        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-left border-bottom">
                        <b><br>Дата заполнения</b>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 border-bottom">
                        <div class="form-group mt-3" >
                            <input type="date" class="form-control border-0">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 text-left">
                <div class="col-12">
                    <div class="text-center">
                        <button class="btn btn-primary mt-3" type="submit">Отправить форму</button>
                    </div>
                </div>

            </div>

</body>

<footer class="container">
    <ul class="border-bottom pb-3 mb-3"></ul>
    <p class="text-center text-body-secondary">© 2023 Company, Inc</p>
</footer>

<script src="/source/js/phoneinput.js"></script>

</html>
