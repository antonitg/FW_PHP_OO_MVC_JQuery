function tkdecode(datavalue) {
    var stringfinal = '';
    token=localStorage.getItem('token');
    $.ajax({
        async: false,
        type: 'GET',
        dataType: 'JSON',
        url: 'general/middleware/middleware.php?op=decode&token='+token,
      }).done(function (jsonSearchPre) {
        jsonSearch = $.parseJSON(`${jsonSearchPre}`);
        algo = $.parseJSON(`${jsonSearchPre}`);
        if (datavalue == "name"){
            // console.log("per asi pasa name");
            stringfinal=jsonSearch['name'].toString();
        } else if (datavalue === "exp") {
            stringfinal=jsonSearch['exp'];
        } else {
            // return jsonSearch;
        }
      }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Error");
        // window.location.href = "index.php?page=logreg";

    });
    tkchecktime(jsonSearch["iat"]);
    return stringfinal;
}

function tkchecktime(timeexp) {
    if (Math.floor(Date.now() / 1000) > timeexp) {
        // logout();
        console.log("logout per temps");
    }
}