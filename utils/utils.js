function generateMenu() {
    var token = localStorage.getItem("token");
    if (token != null) {
        $("<li></li>").attr({ 'class': 'nav-item', 'id': 'limenuprofile' }).appendTo('.navbar-nav');
        $("<a></a>").attr({ 'class': 'navbar-brand', 'id': 'menuprofile','href':'index.php?page=profile' }).append(document.createTextNode(tkdecode("name"))).appendTo('#limenuprofile');
    } else {
        $("<li></li>").attr({ 'class': 'nav-item', 'id': 'lilogreg' }).appendTo('.navbar-nav');
        $("<a></a>").attr({ 'class': 'navbar-brand', 'id': 'logreg','href':'index.php?page=logreg' }).append(document.createTextNode('Login/Register')).appendTo('#lilogreg');
    }
}
$(document).ready(function () {
    generateMenu();
    $(document).on("click", "#btlogout", function () {
        // logout();
    });
    
    // console.log(tkdecode("name"));
});