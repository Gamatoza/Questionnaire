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
<div class="container">
    <div class="col">
        <div class="row">
            <div class="col-lg-12 row">
                <h2>Поиск пользователей</h2>
                <input type="text" class="form-control mb-2" name="search" id="search" autocomplete="off"
                       placeholder="Поиск....">
            </div>
        </div>
        <!--TODO: перенести в блоки -->
        <div class="row">
            <div class="col-lg-12 row">
                <button class="btn btn-outline-primary active" type="button" data-bs-toggle="collapse"
                        data-bs-target="#ddd"
                        aria-expanded="false" aria-controls="collapseExample">
                    Расширенный поиск
                </button>
            </div>
        </div>
    </div>
    <div class="collapse" id="ddd">
        <div class="card card-body col-12 row">
            <div class="row">
                <div class="btn-group d-flex flex-column flex-md-row flex-lg-row" role="group"
                     aria-label="Basic mixed styles example">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1"
                           autocomplete="off" onchange="showMenu('personal_block')" checked>
                    <label class="btn btn-outline-primary" for="btnradio1">Личные данные</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2"
                           autocomplete="off" onchange="showMenu('workork_block')">
                    <label class="btn btn-outline-primary" for="btnradio2">Работа</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3"
                           autocomplete="off" onchange="showMenu('skills_block')">
                    <label class="btn btn-outline-primary" for="btnradio3">Качества</label>
                </div>
            </div>
            <div id="personal_block">
                <!--Upper-->
                <div class="row mt-2">
                    <!--Left-->
                    <div class="col">
                        <label class="form-label">Местоположение</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="address">
                            <label class="form-check-label" for="address" data-bs-toggle="collapse"
                                   data-bs-target="#XYI">Адрес</label>
                            <div class="collapse" id="XYI">
                                <label><input type="text" class="form-control"></label>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="citizenship">
                            <label class="form-check-label" for="citizenship" data-bs-toggle="collapse"
                                   data-bs-target="#XYI">Гражданство</label>
                            <div class="collapse" id="XYI">
                                <label><input type="text" class="form-control"></label>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="accommodations">
                            <label class="form-check-label" for="accommodations" data-bs-toggle="collapse"
                                   data-bs-target="#XYI">Условия проживания</label>
                            <div class="collapse" id="XYI">
                                <label><input type="text" class="form-control"></label>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="birthplace">
                            <label class="form-check-label" for="birthplace" data-bs-toggle="collapse"
                                   data-bs-target="#XYI">
                                Место рождения
                            </label>
                            <div class="collapse" id="XYI">
                                <label><input type="text" class="form-control"></label>
                            </div>
                        </div>
                    </div>
                    <!--Right-->
                    <div class="col">
                        <label class="form-label">Личные данные</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="phone">
                            <label class="form-check-label" for="phone" data-bs-toggle="collapse" data-bs-target="#XYI">
                                Мобильный телефон
                            </label>
                            <div class="collapse" id="XYI">
                                <label><input type="text" class="form-control"></label>
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="birthdate">
                            <label class="form-check-label" for="birthdate" data-bs-toggle="collapse"
                                   data-bs-target="#XYI">
                                Дата рождения
                            </label>
                            <div class="collapse" id="XYI">
                                <label><input type="text" class="form-control"></label>
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
                            <input class="form-check-input" type="checkbox" value="" id="child">
                            <label class="form-check-label" for="child" data-bs-toggle="collapse" data-bs-target="#XYI">
                                Дети
                            </label>
                            <div class="collapse" id="XYI">
                                <label><input type="text" class="form-control"></label>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="spouse">
                            <label class="form-check-label" for="spouse" data-bs-toggle="collapse"
                                   data-bs-target="#XYI">
                                Супруг(а)
                            </label>
                            <div class="collapse" id="XYI">
                                <label><input type="text" class="form-control"></label>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="solo">
                            <label class="form-check-label" for="solo" data-bs-toggle="collapse" data-bs-target="#XYI">
                                Один
                            </label>
                            <div class="collapse" id="XYI">
                                <label><input type="text" class="form-control"></label>
                            </div>
                        </div>
                    </div>
                    <!--Right-->
                    <div class="col">
                        <label class="form-label ">Образование</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="education_type">
                            <label class="form-check-label" for="education_type" data-bs-toggle="collapse"
                                   data-bs-target="#XYI">
                                Образование
                            </label>
                            <div class="collapse" id="XYI">
                                <label><input type="text" class="form-control"></label>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="education">
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
                        <button class="btn btn-primary">Прмиенить</button>
                    </div>
                </div>
            </div>
            <div id="workork_block" hidden="hidden">
                <div class="col">
                    text
                </div>
                <div class="col">
                    <p>some2</p>
                </div>
            </div>
            <div id="skills_block" hidden="hidden">
                <!--Upper-->
                <div class="row">
                    <!--Left-->
                    <div class="col">
                        <label class="form-label">Местоположение</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="address">
                            <label class="form-check-label" for="address">
                                Адрес
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="citizenship">
                            <label class="form-check-label" for="citizenship">
                                Гражданство
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="accommodations">
                            <label class="form-check-label" for="accommodations">
                                Условия проживания
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="birthplace">
                            <label class="form-check-label" for="birthplace">
                                Место рождения
                            </label>
                        </div>
                    </div>
                    <!--Right-->
                    <div class="col">
                        <label class="form-label">Личные данные</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="phone">
                            <label class="form-check-label" for="phone">
                                Мобильный телефон
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="birthdate">
                            <label class="form-check-label" for="birthdate">
                                Дата рождения
                            </label>
                        </div>
                    </div>
                </div>
                <!--Second-->
                <div class="row">
                    <!--Left-->
                    <div class="col">
                        <label class="form-label">Состав семьи</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="child">
                            <label class="form-check-label" for="child">
                                Дети
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="spouse">
                            <label class="form-check-label" for="spouse">
                                Супруг(а)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="solo">
                            <label class="form-check-label" for="solo">
                                Один
                            </label>
                        </div>
                    </div>
                    <!--Right-->
                    <div class="col">
                        <label class="form-label ">Образование</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="education_type">
                            <label class="form-check-label" for="education_type">
                                Образование
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="education">
                            <label class="form-check-label" for="education">
                                Окончил
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!--Bottom-->

        </div>
    </div>

    <div id="output"></div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Новое сообщение</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Получатель:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Сообщение:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Отправить сообщение</button>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

<?php include $cfg->templatesPath["footer.php"] ?>
</html>

