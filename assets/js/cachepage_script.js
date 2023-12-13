jQuery(document).ready(function () {
    //no autocomplete
    $("input").prop("autocomplete", "off"); //TODO: add it in every element manually

    //save changes
    $("input, select").change(function ()
    {
        sessionStorage.setItem(this.name,this.value);
    });

    document.querySelectorAll('select, input').forEach(function(e) {
        if(e.value === '') e.value = window.sessionStorage.getItem(e.name, e.value);
    })
});

/*
document.addEventListener("DOMContentLoaded", function() { //analog $.ready

});*/
