<script>
    let array = ['personal_block','workork_block','skills_block']
    function showMenu(menu_id) {
        $('#'+menu_id).removeAttr('hidden');
        let intersection = array.filter(x=> x!== menu_id);
        intersection.forEach((el)=>{
            $('#'+el).attr('hidden', true);
        });
    }
    function addFieldNearby(field_id)
    {
        if(this.checked())
        {
            $('#'+field_id).removeAttr('hidden');
        }
        else
        {
            let value = $('#'+field_id).attr('hidden', true).val('');
            sessionStorage.setItem(field_id,value);
        }
    }
</script>

<div class="collapse" id="ddd">
    <div class="card card-body">
        <div id="personal_block">
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
        <div id="workork_block" hidden="true">
            <p>Some replacer for workcork_block</p>
        </div>
        <div id="skills_block" hidden="hidden">
            <p>Some replacer for skills_block</p>
            <input type="text" placeholder="type something to test">
        </div>
        <!--Bottom-->
        <div class="row">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
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
    </div>
</div>


<!-- need bootstrap js, bootstrap 5.1 css -->
<!-- include it in form -->