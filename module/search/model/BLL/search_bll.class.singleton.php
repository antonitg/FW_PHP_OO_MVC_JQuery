<?php
//////
class search_bll {
    private $dao;
    static $_instance;

    function __construct() {
        $this -> dao = search_dao::getInstance();
    }// end_construct

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }// end_if
        return self::$_instance;
    }// end_getInstance

    public function getBrandsSearch($condition) {
        
        return $this -> dao -> load_brands($condition);
    }// end_getSlide_home_BLL
    public function getAutocompleteSearch($keyword,$condition,$brand) {
        return $this -> dao -> load_autocomplete($keyword,$condition,$brand);
    }
}// end_home_bll