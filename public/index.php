<?php
require '../vendor/autoload.php';
$cfg = AppConfig::getInstance();
?>

<!-- TODO: Add AJAX modal after push button with "thank you" or smth" -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='../node_modules/bootstrap/dist/css/bootstrap.min.css' integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script type="text/javascript" src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/elements_scripts.js"></script>
    <title>Опросник</title>
    <script type="text/javascript" src="../assets/js/main_script.js"></script>
</head>
<?php include $cfg->templatesPath["header.php"]?>
<body>
<form id="form" method="post" action="../includes/test_checker.php" name="sign-form">
    <div class="container-fluid text-left">
        <div class="row">
            <div class="col-md-12 text-center pt-3 pb-3"><b>ЛИЧНЫЕ ДАННЫЕ</b></div>
        </div>
        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Фамилия, имя, отчество</b> (полностью)</div>
            <div class="col-lg-7 col-md-7 col-sm-12 ">
                <div class="input-group">
                    <input outline="none" type="text" name="fio" class="form-control border-0" required>
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Дата рождения</b></div>
            <div class="col-lg-2 col-md-3 col-sm-3">
                <div class="form-group">
                    <input type="date" name="birthday" class="form-control border-0" required>
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Гражданство</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <select class="form-select border-0" name="citizenship_id" aria-label="Small select example" required>
                    <?php Utils::addOptions('citizenship'); ?> <!--TODO: Check how it works with AJAX-->
                </select>
            </div>
        </div>
        <!--
                    <p>
                    <input name="citizenship_id" list="character">
                    <datalist aria-label="Small select example" id="character">
                        <option selected></option>
                        <?php //addoptions($citizenship_options); ?>
                    </datalist>
                    </p> TODO: Check how it works with AJAX-->

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Место рождения</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" name="birthplace" class="form-control border-0" required>
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Адрес места жительства</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" name="address" class="form-control border-0" required>
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Условия проживания</b> (необходимо выбрать)</div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <!--<div class="input-group">
                    <input id="kit" type="text" class="form-control border-0">
                </div>-->
                <select class="form-select border-0" name="accommodations_id" aria-label="Small select example"
                        required>
                    <?php Utils::addOptions('accommodations'); ?>
                </select>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Мобильный телефон:</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <input class=" container-fluid form-control border-0" name="phone" id="phone" type="tel"
                       pattern="(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?"
                       title="Введите номер телефона в формате +375 XX XXX XX XX" required>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Семейное положение</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <select class="form-select border-0" name="family_id" aria-label="Small select example" required>
                    <?php Utils::addOptions('family');?>
                    <option value="-1">Другое: </option>
                </select>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end">
                <b>Состав семьи: дети</b>(год рождения), <b>супруг(а) </b>(год рождения), живу <b>один(а)</b>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" name="family_structure" class="form-control border-0" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Образование </b>(необхоимо выбрать)</div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <select class="form-select border-0" name="education_id" aria-label="Small select example" required>
                    <?php Utils::addOptions('education'); ?>
                </select>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Окончил </b>(когда, что, какой факультет)</div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="row border-top border-bottom">
                    <div class="input-group">
                        <b>Дата окончания:</b>
                        <div class="form-group">
                            <input type="date" name="education_date" class="form-control border-0" required>
                        </div>
                    </div>
                </div>
                <div class="row border-top border-bottom">
                    <div class="input-group">
                        <b>Учебное заведение:</b>
                        <input type="text" name="education_facility" class="form-control border-0" required>
                    </div>
                </div>
                <div class="row border-top border-bottom">
                    <div class="input-group">
                        <b>Факультет:</b>
                        <input type="text" name="education_faculty" class="form-control border-0" required>
                    </div>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-md-12 text-center pt-3 pb-3"><b>РАБОТА В ПРОШЛОМ</b></div>
            </div>

            <!--<div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b><u>Последнее место работы:</u></b></div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="input-group">
                        <input type="text" class="form-control border-0">
                    </div>
                </div>
            </div>-->

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Организация</b></div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="input-group">
                        <input type="text" name="organization" class="form-control border-0" required>
                    </div>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Должность</b></div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="input-group">
                        <input type="text" name="post" class="form-control border-0" required>
                    </div>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Дата приема/увольнения</b></div>
                <div class="col-lg-2 col-md-3 col-sm-3">
                    <div class="form-group">
                        <input type="date" name="admission_date" class="form-control border-0" required>
                    </div>
                </div>
            </div>
            <!--TODO: Добавить сюда добавление ещё одной даты ака дата увольнения -->
            <input type="button" class="button" id="dismissal_btn" value="Добавить дату увольнения"
                   onclick="disClick();">
            <!--Выводить следующий блок только в случае если дополнительная дата с увольнением есть-->
            <div id="dismissal_div" hidden>
                <div class="row border-top border-bottom">
                    <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Дата увольнения</b></div>
                    <div class="col-lg-2 col-md-3 col-sm-3">
                        <div class="form-group">
                            <input type="date" id="dismissal_date" name="dismissal_date" class="form-control border-0" required>
                        </div>
                    </div>
                </div>
                <div class="row border-top border-bottom">
                    <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Причина увольнения</b></div>
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <select class="form-select border-0" id="dismissal_reason_id" name="dismissal_reason_id" aria-label="Small select example">
                            <?php Utils::addOptions('dismissal_reason'); ?>
                        </select>
                    </div>
                </div>
            </div>


            <div class="row border-top border-bottom">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center pt-3 pb-3"><b>РАБОТА В БУДУЩЕМ</b></div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>На какую должность претендует</b></div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <!-- Допилить. Связь с БД -->
                    <select class="form-select border-0" name="applypost_id" aria-label="Small select example">
                        <?php Utils::addOptions('applypost'); ?>
                    </select>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Согласен ли на рабочую должность </b>(необходимо
                    выбрать)
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <select class="form-select border-0" name="isagree_position" aria-label="Small select example"
                            required>
                        <option selected></option>
                        <option value="True">Да</option>
                        <option value="False">Нет</option>
                    </select>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Согласен ли на переезд в другую местность </b>(необходимо
                    выбрать)
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <select class="form-select border-0" name="isagree_removal" aria-label="Small select example"
                            required>
                        <option selected></option>
                        <option value="True">Да</option>
                        <option value="False">Нет</option>
                    </select>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center pt-3 pb-3"><b>ЛИЧНЫЕ КАЧЕСТВА И НАВЫКИ</b></div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Навыки владения компьютером </b>(необходимое
                    выбрать)<br></div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <select class="form-select border-0" name="pc_skills_id" aria-label="Small select example" required>
                        <?php Utils::addOptions('pcskills'); ?>
                    </select>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Знание иностранных языков, степень владения</b>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="input-group">
                        <input type="text" name="languages" class="form-control border-0" required>
                    </div>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end">
                    <b>Личные увлечения (хобби): </b>(спорт - вид спорта, худ. самод. - танцы, вокал и др.)
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <!-- Допилить. Связь с БД -->
                    <div class="input-group">
                        <input type="text" name="hobbies" class="form-control border-0" required>
                    </div>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Преимущество Вашей кандидатуры </b>(сильные
                    стороны, положительные
                    качества и др.)
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <!-- Допилить. Связь с БД -->
                    <div class="input-group">
                        <input type="text" name="advantages" class="form-control border-0" required>
                    </div>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-12 col-md-12 col-sm-12"><br><b>Против проверки предоставленной мною информации не
                        возражаю.</b><br></div>
            </div>

            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 text-left">
                            <b><br>Дата заполнения</b>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group mt-3">
                                <pre type="date" class="form-control border-0"><?= date("d-m-Y");//H:i:s ?></pre>
                                <!--TODO: менять время по секундам js(?) -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                    <div class="col-12">
                        <div class="text-end">
                            <button class="btn btn-primary mt-3" name="submit-btn" type="submit" >Отправить тест</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>
</body>

<?php include $cfg->templatesPath["footer.php"]?>


<!--<script type="text/javascript" src="source/js/phone_input.js"></script>-->
<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</html>
