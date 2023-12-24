<?php
require '../../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

if (!isset($_SESSION['uid']) or $_SESSION['uid'] == -1)
    header("location: login.php");

?>

<?php
/*$fio = Utils::getMainData($conn, ["id", "fio"]);
foreach ($fio as $value) {
    echo "<div><a href='showprofile.php?id={$value['id']}'>" . $value['fio'] . "</a></div>";
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='../../node_modules/bootstrap/dist/css/bootstrap.min.css'
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script type="text/javascript" src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../../assets/js/elements_scripts.js"></script>
    <title>Опросник</title>
    <script type="text/javascript" src="../../assets/js/cachepage_script.js"></script>
    <script type="text/javascript" src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</head>
<script type="text/javascript">
    function getinfo() {
        var query = $("#search").val();
        if (query != "") {
            $.ajax({
                url: '../../includes/search_form.php',
                method: 'POST',
                data: {query: query},
                success: function (data) {
                    $('#output').html(data);
                    $('#output').css('display', 'block');
                }
            });
        } else {
            $('#output').css('display', 'none');
        }
    }

    $(document).ready(function () {
        getinfo();
        $("#search").keyup(getinfo);
        $("form-check-input").onchange(getinfo);

    });

    let array = ['personal_block', 'workork_block', 'skills_block']

    function showMenu(menu_id) {
        $('#' + menu_id).removeAttr('hidden');
        let intersection = array.filter(x => x !== menu_id);
        intersection.forEach((el) => {
            $('#' + el).attr('hidden', true);
        });
    }

    function addFieldNearby(field_id) {
        if (this.checked()) {
            $('#' + field_id).removeAttr('hidden');
        } else {
            let value = $('#' + field_id).attr('hidden', true).val('');
            sessionStorage.setItem(field_id, value);
        }
    }
</script>

<?php include $cfg->templatesPath["header.php"] ?>

<body>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2">
            <ul class="nav flex-column">
                <li class="nav-item shadow">
                    <a class="btn btn-outline-primary text-start mt-2 active text-dark" style="width: 100%" href="#">
                        <span class="align-top">
                            <img src="../../assets/img/search.svg" width="16" height="16" alt="image description">
                            Поиск
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary text-start mt-2 text-dark" style="width: 100%" href="#">
                        <span class="align-top">
                            <img src="../../assets/img/pencil-square.svg" width="16" height="16" alt="image description">
                            Изменение таблиц
                        </span>
                    </a>

                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary text-start mt-2 text-dark" style="width: 100%" href="#">
                        <span class="align-top">
                            <img src="../../assets/img/printer.svg" width="16" height="16" alt="image description">
                            Печать
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-lg-10 col-md-10 col-sm-10">
            <div class="row">
                <div class="col-lg-12 row ms-1 me-1">
                    <h2>Поиск пользователей</h2>
                    <input type="text" class="form-control mb-2" name="search" id="search" autocomplete="off"
                           placeholder="Поиск....">
                </div>
            </div>
            <!--TODO: перенести в блоки -->
            <div class="row">
                <div class="col-lg-12 row ms-1 me-1">
                    <button class="btn btn-outline-primary active text-dark" type="button" data-bs-toggle="collapse"
                            data-bs-target="#ddd"
                            aria-expanded="false" aria-controls="collapseExample">
                        Расширенный поиск
                    </button>
                </div>
            </div>
            <div class="collapse" id="ddd">
                <div class="card card-body col-12 row ms-1 ">
                    <div class="row">
                        <div class="btn-group d-flex flex-column flex-md-row flex-lg-row" role="group"
                             aria-label="Basic mixed styles example">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1"
                                   autocomplete="off" onchange="showMenu('personal_block')" checked>
                            <label class="btn btn-outline-primary text-dark" for="btnradio1">Личные данные</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2"
                                   autocomplete="off" onchange="showMenu('workork_block')">
                            <label class="btn btn-outline-primary text-dark" for="btnradio2">Работа</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3"
                                   autocomplete="off" onchange="showMenu('skills_block')">
                            <label class="btn btn-outline-primary text-dark" for="btnradio3">Качества</label>
                        </div>
                    </div>
                    <div id="personal_block">
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <label class="form-label">Местоположение</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="address"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="address" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Адрес</label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="citizenship"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="citizenship" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Гражданство</label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="accommodations"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="accommodations" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Условия проживания</label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="birthplace"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="birthplace" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">
                                        Место рождения
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <label class="form-label">Состав семьи</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="child"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="child" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">
                                        Дети
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="spouse"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="spouse" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">
                                        Супруг(а)
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="solo"
                                           data-bs-toggle="collapse"
                                           data-bs-target="#XYI">
                                    <label class="form-check-label" for="solo" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">
                                        Один
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Личные данные</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="phone"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="phone" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">
                                        Мобильный телефон
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="birthdate"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="birthdate" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">
                                        Дата рождения
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <label class="form-label ">Образование</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="education_type"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="education_type" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">
                                        Образование
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="education"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="education" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">
                                        Окончил
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12 row">
                                <button class="btn btn-outline-primary active text-dark">Применить</button>
                            </div>
                        </div>
                    </div>
                    <div id="workork_block" hidden="hidden">
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <label class="form-label">Работы в прошлом</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="address"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="address" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Организация</label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="citizenship"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="citizenship" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Должность</label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="accommodations"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="accommodations" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Дата приема/увольнения</label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="birthplace"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="birthplace" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Дата увольнения
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="child"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="child" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Причина уовльнения
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Работа в будущем</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="phone"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="phone" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">На какую должность претендует
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="birthdate"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="birthdate" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Согласен ли на рабочую должность
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="education_type"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="education_type" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Согласен ли на переезд
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12 row">
                                <button class="btn btn-outline-primary active text-dark">Применить</button>
                            </div>
                        </div>
                    </div>
                    <div id="skills_block" hidden="hidden">
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <label class="form-label">Личные качества и навыки</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="address"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="address" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Навыки владения компьютером</label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="citizenship"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="citizenship" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Знание иностранных языков, степень владения</label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="accommodations"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="accommodations" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Личные увлечения (хобби)</label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="birthplace"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="birthplace" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Преимущества Вашей кандидатуры
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="child"
                                           data-bs-toggle="collapse" data-bs-target="#XYI">
                                    <label class="form-check-label" for="child" data-bs-toggle="collapse"
                                           data-bs-target="#XYI">Причина уовльнения
                                    </label>
                                    <div class="collapse" id="XYI">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12 row">
                                <button class="btn btn-outline-primary active text-dark">Применить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="output">

            </div>


        </div>
    </div>


</div>

</body>

<?php include $cfg->templatesPath["footer.php"] ?>
</html>

