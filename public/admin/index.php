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
</script>

<?php include $cfg->templatesPath["header.php"] ?>

<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 row">
            <h2>Поиск пользователей</h2>
            <input type="text" name="search" id="search" autocomplete="off" placeholder="Поиск....">
        </div>
    </div>

    <div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"/>
            <label class="form-check-label" for="inlineCheckbox1">ФИО</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"/>
            <label class="form-check-label" for="inlineCheckbox2">Адрес</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled/>
            <label class="form-check-label" for="inlineCheckbox3"></label>
        </div>
    </div>

    <div id="output"></div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Открыть модальное окно для @mdo</button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Открыть модальное окно для @fat</button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Открыть модальное окно для @getbootstrap</button>

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

