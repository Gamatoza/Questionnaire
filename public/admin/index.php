<?php
require '../../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;

if (!isset($_SESSION['uid']) or $_SESSION['uid'] == -1)
    header("location: login.php");
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
    <script type="text/javascript" src="../../assets/js/elements-scripts.js"></script>
    <title>Опросник</title>
    <script type="text/javascript" src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/soft-search.js"></script>

</head>
<script type="text/javascript">

    let array = ['personal_block', 'workorg_block', 'skills_block']

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

    $(document).ready(function () {
        //getinfo();
        //$("#search").keyup(getinfo);
        //$("input").keyup(getinfo);
        $("input").keyup(function (event) {
            if (event.keyCode === 13) {
                getinfo();
            }
        });

        $.fn.disableSelection = function() {
            return this
                .attr('unselectable', 'on')
                .css('user-select', 'none')
                .on('selectstart', false);
        };

        //$(".form-check-input").change(setdata);
    });
</script>

<?php include $cfg->templatesPath["header.php"] ?>

<body>

<div class="container-fluid">
    <div class="row">

        <!--Menu-->
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
                            <img src="../../assets/img/pencil-square.svg" width="16" height="16"
                                 alt="image description">
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

        <!--Search-->
        <div class="col-lg-10 col-md-10 col-sm-10">
            <h2>Поиск пользователей</h2>
            <div class="row">
                <div class="col-lg-10 col-md row ms-1 me-1">
                    <input type="text" class="form-control mb-2" name="search" id="search" autocomplete="off"
                           placeholder="Поиск....">
                </div>
                <button type="button" class="btn btn-primary col-lg" style="margin-bottom: 10px;margin-right: 20px"
                        id="btn_search" onclick="getinfo()">Найти
                </button>
            </div>
            <!--TODO: перенести в блоки -->
            <div class="row">
                <div class="col-lg-12 row ms-1 me-1">
                    <button class="btn btn-outline-primary active text-dark" type="button" data-bs-toggle="collapse"
                            data-bs-target="#form_output"
                            aria-expanded="false" aria-controls="collapseExample">
                        Расширенный поиск
                    </button>
                </div>
            </div>
            <div class="collapse" id="form_output">
                <div class="card card-body col-12 row ms-1 ">
                    <div class="row">
                        <div class="btn-group d-flex flex-column flex-md-row flex-lg-row" role="group"
                             aria-label="Basic mixed styles example">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1"
                                   autocomplete="off" onchange="showMenu('personal_block')" checked>
                            <label class="btn btn-outline-primary text-dark" for="btnradio1">Личные данные</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2"
                                   autocomplete="off" onchange="showMenu('workorg_block')">
                            <label class="btn btn-outline-primary text-dark" for="btnradio2">Работа</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3"
                                   autocomplete="off" onchange="showMenu('skills_block')">
                            <label class="btn btn-outline-primary text-dark" for="btnradio3">Качества</label>
                        </div>
                    </div>
                    <div id="personal_block">
                        <!--Upper-->
                        <div class="row mt-2">
                            <!--Left-->
                            <div class="col">
                                <label class="form-label">Местоположение</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="address"
                                           data-bs-toggle="collapse" data-bs-target="#address_input">
                                    <label class="form-check-label" for="address" data-bs-toggle="collapse"
                                           data-bs-target="#address_input">Адрес</label>
                                    <div class="collapse" id="address_input">
                                        <input type="text" name="address_input" class="form-control">
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="citizenship"
                                           data-bs-toggle="collapse" data-bs-target="#citizenship_id_id">
                                    <label class="form-check-label" for="citizenship" data-bs-toggle="collapse"
                                           data-bs-target="#citizenship_id">Гражданство</label>
                                    <div class="collapse" id="citizenship_id_id">
                                        <select class="form-select" name="citizenship_id"
                                                aria-label="Small select example">
                                            <?php Utils::addOptions('citizenship'); ?>
                                            <!--TODO: Check how it works with AJAX-->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="accommodations"
                                           data-bs-toggle="collapse" data-bs-target="#accommodations_id_id">
                                    <label class="form-check-label" for="accommodations" data-bs-toggle="collapse"
                                           data-bs-target="#accommodations_id">Условия проживания</label>
                                    <div class="form-check-label  collapse" id="accommodations_id_id">
                                        <select class="form-select"
                                                aria-label="Small select example">
                                            <?php Utils::addOptions('accommodations'); ?>
                                            <!--TODO: Check how it works with AJAX-->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="birthplace"
                                           data-bs-toggle="collapse" data-bs-target="#birthplace_input">
                                    <label class="form-check-label" for="birthplace" data-bs-toggle="collapse"
                                           data-bs-target="#birthplace_input">
                                        Место рождения
                                    </label>
                                    <div class="collapse" id="birthplace_input">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!--Right-->
                            <div class="col">
                                <label class="form-label">Личные данные</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="phone"
                                           data-bs-toggle="collapse" data-bs-target="#phone_input">
                                    <label class="form-check-label" for="phone" data-bs-toggle="collapse"
                                           data-bs-target="#phone_input">
                                        Мобильный телефон
                                    </label>
                                    <div class="collapse" id="phone_input">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="birthday"
                                           data-bs-toggle="collapse" data-bs-target="#birthday_date">
                                    <label class="form-check-label" for="birthday" data-bs-toggle="collapse"
                                           data-bs-target="#birthday_date">
                                        Дата рождения
                                    </label>
                                    <div class="collapse row" id="birthday_date">
                                        <div class="col-lg-3">
                                            <label class="form-check-label" >От</label>
                                            <input type="date" name="from" class="form-control" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-check-label" >До</label>
                                            <input type="date" name="to" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Second-->
                        <div class="row">
                            <!--Left-->
                            <div class="col">
                                <label class="form-label">Состав семьи</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="child"
                                           data-bs-toggle="collapse" data-bs-target="#child_input">
                                    <label class="form-check-label" for="child" data-bs-toggle="collapse"
                                           data-bs-target="#child_input">
                                        Дети
                                    </label>
                                    <div class="collapse" id="child_input">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="spouse"
                                           data-bs-toggle="collapse" data-bs-target="#spouse_input">
                                    <label class="form-check-label" for="spouse" data-bs-toggle="collapse"
                                           data-bs-target="#spouse_input">
                                        Супруг(а)
                                    </label>
                                    <div class="collapse" id="spouse_input">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="solo"
                                           data-bs-toggle="collapse"
                                           data-bs-target="#solo_input">
                                    <label class="form-check-label" for="solo" data-bs-toggle="collapse"
                                           data-bs-target="#solo_input">
                                        Один
                                    </label>
                                    <div class="collapse" id="solo_input">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                            </div>
                            <!--Right-->
                            <div class="col">
                                <label class="form-label ">Образование</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="education"
                                           data-bs-toggle="collapse" data-bs-target="#education_id_id">
                                    <label class="form-check-label" for="education" data-bs-toggle="collapse"
                                           data-bs-target="#education_id">
                                        Образование
                                    </label>
                                    <div class="collapse" id="education_id_id">
                                        <select class="form-select"
                                                aria-label="Small select example">
                                            <?php Utils::addOptions('education'); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="education"
                                           data-bs-toggle="collapse" data-bs-target="#education_input">
                                    <label class="form-check-label" for="education" data-bs-toggle="collapse"
                                           data-bs-target="#education_input">
                                        Окончил
                                    </label>
                                    <div class="collapse" id="education_input">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="workorg_block" hidden="hidden">
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <label class="form-label">Работы в прошлом</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="organization"
                                           data-bs-toggle="collapse" data-bs-target="#organization_input">
                                    <label class="form-check-label" for="organization" data-bs-toggle="collapse"
                                           data-bs-target="#organization_input">Организация</label>
                                    <div class="collapse" id="organization_input">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="post"
                                           data-bs-toggle="collapse" data-bs-target="#post_input">
                                    <label class="form-check-label" for="post" data-bs-toggle="collapse"
                                           data-bs-target="#post_input">Должность</label>
                                    <div class="collapse" id="post_input">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="admission"
                                           data-bs-toggle="collapse" data-bs-target="#admission_date">
                                    <label class="form-check-label" for="admission" data-bs-toggle="collapse"
                                           data-bs-target="#admission_date">Дата приема/увольнения</label>
                                    <div class="collapse row" id="admission_date">
                                        <div class="col-lg-3">
                                            <label class="form-check-label" >От</label>
                                            <input type="date" name="from" class="form-control" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-check-label" >До</label>
                                            <input type="date" name="to" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="dismissal"
                                           data-bs-toggle="collapse" data-bs-target="#dismissal_date">
                                    <label class="form-check-label" for="dismissal" data-bs-toggle="collapse"
                                           data-bs-target="#dismissal_date">Дата увольнения
                                    </label>
                                    <div class="collapse row" id="dismissal_date">
                                        <div class="col-lg-3">
                                            <label class="form-check-label" >От</label>
                                            <input type="date" name="from" class="form-control" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-check-label" >До</label>
                                            <input type="date" name="to" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="dismissal_reason_id"
                                           data-bs-toggle="collapse" data-bs-target="#dismissal_reason_id_id">
                                    <label class="form-check-label" for="dismissal_reason_id" data-bs-toggle="collapse"
                                           data-bs-target="#dismissal_reason_id_id">Причина уовльнения
                                    </label>
                                    <div class="collapse" id="dismissal_reason_id_id">
                                        <select class="form-select"
                                                aria-label="Small select example">
                                            <?php Utils::addOptions('dismissal_reason'); ?>
                                            <!--TODO: Check how it works with AJAX-->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Работа в будущем</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="applypost_id"
                                           data-bs-toggle="collapse" data-bs-target="#applypost_id_id">
                                    <label class="form-check-label" for="applypost_id" data-bs-toggle="collapse"
                                           data-bs-target="#applypost_id_id">На какую должность претендует
                                    </label>
                                    <div class="collapse" id="applypost_id_id">
                                        <select class="form-select"
                                                aria-label="Small select example">
                                            <?php Utils::addOptions('applypost'); ?>
                                            <!--TODO: Check how it works with AJAX-->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-check" id="isagree_position_choose">
                                    <input class="form-check-input" type="checkbox"  onchange="this.value = +this.checked" data-bs-target="#isagree_position_choose" >
                                    <label class="form-check-label" for="isagree_position" data-bs-target="#isagree_removal_choose">Согласен ли на рабочую
                                        должность</label>
                                </div>
                                <div class="form-check" id="isagree_removal_choose">
                                    <input class="form-check-input" type="checkbox"  onchange="this.value = +this.checked" data-bs-target="#isagree_removal_choose" >
                                    <label class="form-check-label" for="isagree_removal" data-bs-target="#isagree_removal_choose">Согласен ли на переезд</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="skills_block" hidden="hidden">
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <label class="form-label">Личные качества и навыки</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pc_skills_id"
                                           data-bs-toggle="collapse" data-bs-target="#pc_skills_id_input">
                                    <label class="form-check-label" for="pc_skills_id" data-bs-toggle="collapse"
                                           data-bs-target="#pc_skills_id_input">Навыки владения компьютером</label>
                                    <div class="collapse" id="pc_skills_id_input">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="languages"
                                           data-bs-toggle="collapse" data-bs-target="#languages_input">
                                    <label class="form-check-label" for="languages" data-bs-toggle="collapse"
                                           data-bs-target="#languages_input">Знание иностранных языков, степень
                                        владения</label>
                                    <div class="collapse" id="languages_input">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="hobbies"
                                           data-bs-toggle="collapse" data-bs-target="#hobbies_input">
                                    <label class="form-check-label" for="hobbies" data-bs-toggle="collapse"
                                           data-bs-target="#hobbies_input">Личные увлечения (хобби)</label>
                                    <div class="collapse" id="hobbies_input">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="advantages"
                                           data-bs-toggle="collapse" data-bs-target="#advantages_input">
                                    <label class="form-check-label" for="advantages" data-bs-toggle="collapse"
                                           data-bs-target="#advantages_input">Преимущества Вашей кандидатуры
                                    </label>
                                    <div class="collapse" id="advantages_input">
                                        <label><input type="text" class="form-control"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--<div class="row mt-3">
                        <div class="col-lg-12 row">
                            <button class="btn btn-primary">Применить</button>
                        </div>
                    </div>-->
                </div>
            </div>
            <div id="output">

            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Заголовок модального окна</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body" id="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

</body>

<?php include $cfg->templatesPath["footer.php"] ?>
</html>

