let IsDisClicked = false;
const buf = [];
function disClick(elem) { //TODO: допилить сохранение включённой и выключенной кнопки
    if (!IsDisClicked) {
        elem.value = 'Убрать дату увольнения';
        $('#dismisdiv').removeAttr('hidden');
        $("#dismissal_date").attr('required', true).val(buf[0]);
        $('#dismossal_reason_id').attr('required', true).val(buf[1]);
    } else {
        $('#dismisdiv').attr('hidden', true);
        elem.value = 'Добавить дату увольнения';
        buf[0] = $("#dismissal_date").val();
        buf[1] = $("#dismossal_reason_id").val();
        $("#dismissal_date").val('').removeAttr('required');
        $("#dismossal_reason_id").val('').removeAttr('required');
    }
    IsDisClicked = !IsDisClicked;
}