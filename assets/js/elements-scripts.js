let IsDisClicked = false;
const buf = [];

function disSet(bool_param) { //TODO: допилить сохранение включённой и выключенной кнопки
    if (!bool_param) {
        $('#dismissal_btn').val('Добавить дату увольнения');
        buf[0] = $("#dismissal_date").val();
        buf[1] = $("#dismissal_reason_id").val();
        $('#dismissal_div').attr('hidden', true);
        $("#dismissal_date").val('').removeAttr('required');
        $("#dismissal_reason_id").val('').removeAttr('required');
    } else {
        $('#dismissal_btn').val('Убрать дату увольнения');
        $('#dismissal_div').removeAttr('hidden');
        $("#dismissal_date").attr('required', true).val(buf[0]);
        $('#dismissal_reason_id').attr('required', true).val(buf[1]);
    }
}

function disClick() { //TODO: допилить сохранение включённой и выключенной кнопки
    sessionStorage.setItem("isDis", IsDisClicked?"true":"false");
    if (IsDisClicked) {
        $('#dismissal_btn').val('Добавить дату увольнения');
        buf[0] = $("#dismissal_date").val();
        buf[1] = $("#dismissal_reason_id").val();
        $('#dismissal_div').attr('hidden', true);
        $("#dismissal_date").val('').removeAttr('required');
        $("#dismissal_reason_id").val('').removeAttr('required');
    } else {
        $('#dismissal_btn').val('Убрать дату увольнения');
        $('#dismissal_div').removeAttr('hidden');
        $("#dismissal_date").attr('required', true).val(buf[0]);
        $('#dismissal_reason_id').attr('required', true).val(buf[1]);
    }
    IsDisClicked = !IsDisClicked;
}