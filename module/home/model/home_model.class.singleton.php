<?php
//////
class home_model {
    private $bll;
    static $_instance;
    //////
    function __construct() {
        $this -> bll = home_bll::getInstance();
    }// end_construct

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }// end_if
        return self::$_instance;
    }// end_getInstance

    public function getCatHome() {
        return $this -> bll -> getCatHome();
    }// end_getSlider_home
    public function homeLoadSliderProd() {
        return $this -> bll -> homeLoadSliderProd();
    }// end_getSlider_home
}// end_home_model