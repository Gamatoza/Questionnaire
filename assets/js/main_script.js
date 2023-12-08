jQuery(document).ready(function () {
    $("input").prop("autocomplete", "off"); //TODO: add it in every element manually
    $("input, select").change(function ()
    {
        sessionStorage.setItem(this.name,this.value);
    });
    $("input[type='button']").click(function (){
        sessionStorage.setItem("isDis", IsDisClicked?"true":"false");
    });
});

document.addEventListener("DOMContentLoaded", function() { //analog $.ready
    document.querySelectorAll('select, input').forEach(function(e) {
        if(e.value === '') e.value = window.sessionStorage.getItem(e.name, e.value);
    })
    IsDisClicked = sessionStorage.getItem("isDis") === "true";
    disSet(IsDisClicked);
});