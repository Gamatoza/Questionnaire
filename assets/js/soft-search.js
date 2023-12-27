let _data = {};

function getinfo() {
    _data = setdata();
    _data['fio_input'] = $("#search").val();
    if (Object.keys(_data).length) {
        $.ajax({
            url: '../../includes/search_form.php',
            method: 'POST',
            cache: false,
            data: {data: _data}, //mb send just _data but... idk
            success: function (data) {
                $('#output').html(data);
                $('#output').css('display', 'block');
            }
        });
    } else {
        $('#output').css('display', 'none');
    }
}

function setdata() {
    var all_data = {};
    $('input.form-check-input[data-bs-target]').each(function () {
        if ($(this).is(':checked')) {
            var name = $(this).attr("data-bs-target").replace('#', '');
            var inputs = $('#' + name).find('input');
            if (inputs.length <= 0) {
                inputs = $('#' + name).find('select');
            }

            if (inputs.length === 1) {
                all_data[name] = inputs[0].value;
            } else { //add method to add un all_data, recursive
                var buf = {};
                var array = Array.from(inputs);
                for (let i = 0; i < array.length; i++) {
                    buf[array[i].name] = array[i].value;
                }
                all_data[name] = buf;
            }
            console.log(inputs[0].value)
        }
    });
    return all_data;
}

function softSearch() {
    $.ajax({
        url: '../../includes/soft_search.php',
        method: 'POST',
        cache: false,
        data: {data: _data, id: this.id}, //mb send just _data but... idk
        success: function (data) {
            $('#some_modal_output').html(data);
            $('#some_modal_output').css('display', 'block');
        }
    });
}