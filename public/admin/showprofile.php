<?php
require '../../vendor/autoload.php';
$cfg = AppConfig::getInstance();
$conn = $cfg->connection;
$id = $_GET['id'];

$query = $conn->query("SELECT * FROM show_main_info where id = $id");
$query->execute();
$data = $query->fetch();
//Utils::showArrayInfo();

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
    <!--<script type="text/javascript" src="../../assets/js/main_script.js"></script>-->
    <!--TODO: Подумать как можно будет переделать isdis, ибо убирается значение-->
</head>
<script>
    //TODO: Add script adding name if input changed, so POST can has only needed values, check TODO in src/Utils.php
    $(() => {
        $("input").prop("autocomplete", "off"); //TODO: add it in every element manually
    });
</script>
<?php include $cfg->templatesPath["header.php"] ?>
<body>
<form id="form" method="post" action="../../includes/update_form_handler.php" name="sign-form"> <!--TODO: add action php to change, ajax-->
    <input name="id" value="<?=$id?>" hidden> <!--TODO: убрать этот костыль-->
    <div class="container-fluid text-left">
        <div class="row">
            <div class="col-md-12 text-center pt-3 pb-3"><b>ЛИЧНЫЕ ДАННЫЕ</b></div>
        </div>
        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Фамилия, имя, отчество</b> (полностью)</div>
            <div class="col-lg-7 col-md-7 col-sm-12 ">
                <div class="input-group">
                    <input outline="none" type="text" name="fio" class="form-control border-0" 
                           value="<?= $data['fio']; ?>">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Дата рождения</b></div>
            <div class="col-lg-2 col-md-3 col-sm-3">
                <div class="form-group">
                    <input type="date" name="birthday" class="form-control border-0" 
                           value="<?= $data['birthday']; ?>">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Гражданство</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <select class="form-select border-0" name="citizenship_id" aria-label="Small select example" >
                    <?php Utils::addOptions('citizenship', $data['citizenship']); ?>
                </select>
            </div>
        </div>
        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Место рождения</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" name="birthplace" class="form-control border-0" 
                           value="<?= $data['birthplace']; ?>">
                </div>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Адрес места жительства</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" name="address" class="form-control border-0" 
                           value="<?= $data['address']; ?>">
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
                        >
                    <?php Utils::addOptions('accommodations', $data['accommodations']); ?>
                </select>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Мобильный телефон:</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <input class=" container-fluid form-control border-0" name="phone" id="phone" type="tel"
                       pattern="(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?"
                       title="Введите номер телефона в формате +375 XX XXX XX XX" 
                       value="<?= $data['phone']; ?>">
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Семейное положение</b></div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <select class="form-select border-0" name="family_id" aria-label="Small select example" >
                    <?php Utils::addOptions('family', $data['family']); ?>
                    <option value="-1">Другое:</option>
                </select>
            </div>
        </div>

        <div class="row border-top border-bottom">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end">
                <b>Состав семьи: дети</b>(год рождения), <b>супруг(а) </b>(год рождения), живу <b>один(а)</b>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="input-group">
                    <input type="text" name="family_structure" class="form-control border-0" 
                           value="<?= $data['family_structure']; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Образование </b>(необхоимо выбрать)</div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <select class="form-select border-0" name="education_id" aria-label="Small select example" >
                    <?php Utils::addOptions('education', $data['education']); ?>
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
                            <input type="date" name="education_date" class="form-control border-0" 
                                   value="<?= $data['education_date']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row border-top border-bottom">
                    <div class="input-group">
                        <b>Учебное заведение:</b>
                        <input type="text" name="education_facility" class="form-control border-0" 
                               value="<?= $data['education_facility']; ?>">
                    </div>
                </div>
                <div class="row border-top border-bottom">
                    <div class="input-group">
                        <b>Факультет:</b>
                        <input type="text" name="education_faculty" class="form-control border-0" 
                               value="<?= $data['education_faculty']; ?>">
                    </div>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-md-12 text-center pt-3 pb-3"><b>РАБОТА В ПРОШЛОМ</b></div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Организация</b></div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="input-group">
                        <input type="text" name="organization" class="form-control border-0" 
                               value="<?= $data['organization']; ?>">
                    </div>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Должность</b></div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="input-group">
                        <input type="text" name="post" class="form-control border-0" 
                               value="<?= $data['post']; ?>">
                    </div>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Дата приема/увольнения</b></div>
                <div class="col-lg-2 col-md-3 col-sm-3">
                    <div class="form-group">
                        <input type="date" name="admission_date" class="form-control border-0" 
                               value="<?= $data['admission_date']; ?>">
                    </div>
                </div>
            </div>
            <!--TODO: Добавить сюда добавление ещё одной даты ака дата увольнения -->
            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Дата увольнения</b></div>
                <div class="col-lg-2 col-md-3 col-sm-3">
                    <div class="form-group">
                        <input type="date" id="dismissal_date" name="dismissal_date" class="form-control border-0"
                                value="<?= $data['dismissal_date']; ?>">
                    </div>
                </div>
            </div>
            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Причина увольнения</b></div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <select class="form-select border-0" id="dismissal_reason_id" name="dismissal_reason_id"
                            aria-label="Small select example">
                        <?php Utils::addOptions('dismissal_reason', $data['dismissal_reason']); ?>
                    </select>
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
                        <?php Utils::addOptions('applypost', $data['applypost']); ?>
                    </select>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Согласен ли на рабочую должность </b>(необходимо
                    выбрать)
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <select class="form-select border-0" name="isagree_position" aria-label="Small select example">
                        <option value="1" <?= $data['isagree_position'] == 1 ? 'selected' : '' ?>>Да</option> <!-- TODO Подумать как лучше сделать будет с Да Нет выводом -->
                        <option value="0" <?= $data['isagree_position'] == 0 ? 'selected' : '' ?>>Нет</option>
                    </select>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Согласен ли на переезд в другую местность </b>(необходимо
                    выбрать)
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <select class="form-select border-0" name="isagree_removal" aria-label="Small select example">
                        <option value="1" <?= $data['isagree_removal'] == 1 ? 'selected' : '' ?>>Да</option> <!-- TODO Подумать как лучше сделать будет с Да Нет выводом -->
                        <option value="0" <?= $data['isagree_removal'] == 0 ? 'selected' : '' ?>>Нет</option>
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
                    <select class="form-select border-0" name="pc_skills_id" aria-label="Small select example" >
                        <?php Utils::addOptions('pcskills', $data['pcskills']); ?>
                    </select>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="col-lg-5 col-md-5 col-sm-12 border-end"><b>Знание иностранных языков, степень владения</b>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="input-group">
                        <input type="text" name="languages" class="form-control border-0" 
                               value="<?= $data['languages']; ?>">
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
                        <input type="text" name="hobbies" class="form-control border-0" 
                               value="<?= $data['hobbies']; ?>">
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
                        <input type="text" name="advantages" class="form-control border-0" 
                               value="<?= $data['advantages']; ?>">
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
                                <pre type="date"
                                     class="form-control border-0"><?= $data['filling_date'];//H:i:s        ?></pre>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 row">
                    <div class="col-12">
                        <div class="text-end">
                            <input
                                    action="action"
                                    onclick="window.history.go(-1); return false;"
                                    type="submit"
                                    value="Отмена"
                                    class="btn btn-primary mt-3"
                                    name="close"
                            />
                        <button class="btn btn-primary mt-3" name="submit-btn" type="submit">Изменить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</body>

<?php include $cfg->templatesPath["footer.php"] ?>


<!--<script type="text/javascript" src="source/js/phone_input.js"></script>-->
<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</html>
