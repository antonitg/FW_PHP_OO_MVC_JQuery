function load_brands(conditioncar = $(".select-condition-search").val()) {
    console.log("Dins de load_Brands");
    friendlyURL('?page=search&op=getBrandsSearch').then(function (data) {
        ajaxPromise(data, 'POST', 'JSON', { condition: conditioncar }).then(function (jsonSearch) {
            console.log(jsonSearch);
            $('.select-brand-search').empty();
            $("<option></option>").attr({ 'value': '%', 'disabled': 'disabled' }).append(document.createTextNode("Brand")).appendTo(".select-brand-search");
            $.each(jsonSearch, function (i, item) {
                $("<option></option>").attr({ 'value': jsonSearch[i]["brand"] }).append(document.createTextNode(jsonSearch[i]["brand"] + "  " + jsonSearch[i]["num"])).appendTo(".select-brand-search");
            });
        }).catch(function (error) {
            console.log('Fail when trying to get the information.'.error);
        });
    });
}
function load_autocomplete(keywordos) {
    friendlyURL('?page=search&op=getAutocompleteSearch').then(function (data) {
        ajaxPromise(data, 'POST', 'JSON', { keyword: keywordos, condition: $(".select-condition-search").val(), brand: $(".select-brand-search").val() }).then(function (jsonSearch) {
            $('#autocomplete-containter').empty();
            if (Array.isArray(jsonSearch)) {
                $.each(jsonSearch, function (i, item) {
                    // if (jsonSearch[i]['model'] != "undefined") {
                    $("<div></div>").attr({ 'id': jsonSearch[i]["model"], 'class': 'autocomplete-item' }).append(document.createTextNode(jsonSearch[i]['model'])).appendTo("#autocomplete-containter");
                });
            } else if (jsonSearch["model"].toString().length > 0) {
                $("<div></div>").attr({ 'id': jsonSearch["model"], 'class': 'autocomplete-item' }).append(document.createTextNode(jsonSearch['model'])).appendTo("#autocomplete-containter");
            }
        }).catch(function (error) {
            // console.log('Fail when trying to get the information.'.error);
        });
    });
}
$(document).ready(function () {
    $(document).on("change", ".select-condition-search", function () {
        load_brands();
    });
    $(document).on("click", ".autocomplete-item", function () {
        // alert(this.getAttribute("id"));
        $(".search-input").val(this.getAttribute("id"));
        // $(".search-input").append(document.createTextNode(this.getAttribute("id")));
    });
    $("body").click(function () {
        $("#autocomplete-containter").empty();
    });
    $(document).on("keyup", ".search-input", function (tecla) {
        load_autocomplete($(".search-input").val());
        if (tecla.keyCode == 13) {
            localStorage.setItem("op", "search");
            localStorage.setItem("value", "global");
            localStorage.setItem("brand", $(".select-brand-search").val());
            localStorage.setItem("condition", $(".select-condition-search").val());
            localStorage.setItem("keyword", $(".search-input").val());
            window.location.href = "index.php?page=shop&op=list";
        }

    });
});