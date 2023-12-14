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

<?php include $cfg->templatesPath["header.php"] ?>

<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Search for users</h2>
            <input type="text" name="search" id="search" autocomplete="off" placeholder="search user name here....">
            <div id="output"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(()=>
    {
        getinfo();
    });

    function getinfo() {
        var query = $(this).val();
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
        $("#search").keyup(getinfo);
    });
</script>
</body>

<?php include $cfg->templatesPath["footer.php"] ?>
</html>

