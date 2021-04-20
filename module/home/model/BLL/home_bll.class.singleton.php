<?php
//////
class home_bll {
    private $dao;
    static $_instance;

    function __construct() {
        $this -> dao = home_dao::getInstance();
    }// end_construct

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }// end_if
        return self::$_instance;
    }// end_getInstance

    public function getCatHome() {
        return $this -> dao -> categories();
    }// end_getSlide_home_BLL
    public function homeLoadSliderProd() {
        return $this -> dao -> homeLoadSliderProd();
    }
}// end_home_bll