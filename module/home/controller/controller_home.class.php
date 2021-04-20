<?php
//////
// session_start();
class controller_home {

    function list() {
        common::loadView('topPageHome.php', VIEW_PATH_HOME . 'home.html');
    }// end_list

    function homeLoadCat() {
        echo common::accessModel('home_model', 'getCatHome') -> getResolve();
    }// end_homePageSlide

    function homeLoadSliderProd() {
        echo common::accessModel('home_model', 'homeLoadSliderProd') -> getResolve();
    }// end_homePageCat

    function incrementView() {
        echo common::accessModel('home_model', 'IncView_home', $_POST['brand']);
    }// end_incrementView

}// end_controller_home







?>