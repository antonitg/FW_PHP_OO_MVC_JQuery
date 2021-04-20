<?php
//////
class shop_model {
    private $bll;
    static $_instance;
    //////
    function __construct() {
        $this -> bll = shop_bll::getInstance();
    }// end_construct

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }// end_if
        return self::$_instance;
    }// end_getInstance

    public function getFiltersSearch($args) {
        return $this -> bll -> getFiltersSearch($args);
    }// end_getSlider_home
    public function getMapShop($args) {
        return $this -> bll -> getMapShop($args);
    }
    public function getSearchResults($args) {
        return $this -> bll -> getSearchResults($args);
    }
    public function getDetails($args) {
        return $this -> bll -> getDetails($args);
    }
    public function loadFilters() {
        return $this -> bll -> loadFilters();
    }
    public function addView($args) {
        return $this -> bll -> addView($args);
    }
    public function getCart($args) {
        return $this -> bll -> getCart($args);
    }
    public function addItemCart($args) {
        return $this -> bll -> addItemCart($args);
    }
    public function rmItemCart($args) {
        return $this -> bll -> rmItemCart($args);
    }
    public function addItemFav($args) {
        return $this -> bll -> addItemFav($args);
    }
    public function rmItemFav($args) {
        return $this -> bll -> rmItemFav($args);
    }
    public function addItemIns($args) {
        return $this -> bll -> addItemIns($args);
    }
    public function rmItemIns($args) {
        return $this -> bll -> rmItemIns($args);
    }


}// end_home_model