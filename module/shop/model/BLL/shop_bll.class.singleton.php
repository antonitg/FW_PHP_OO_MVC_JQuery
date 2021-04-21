<?php
//////
class shop_bll {
    private $dao;
    static $_instance;

    function __construct() {
        $this -> dao = shop_dao::getInstance();
    }// end_construct

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }// end_if
        return self::$_instance;
    }// end_getInstance

    public function getFiltersSearch($args) {
        if ($args[1] == "null") {
            $user = "guest";
        } else {
            $user = json_decode(jwt_process::decode($args[1], $args[0]), true)['name'];
        }
        return $this -> dao -> getFiltersSearch($args[2],$args[3], $args[4], $args[5],$args[6], $args[7],$args[8],$user);
    }
    public function getPagination($args) {
        return $this -> dao -> getPagination($args[0],$args[1],$args[2],$args[3],$args[4]);
    }
    public function getMapShop($args) {
        return $this -> dao -> getMapShop($args[0],$args[1]);
    }
    public function getSearchResults($args) {
        return $this -> dao -> getSearchResults($args[0]);
    }
    public function loadFilters() {
        return $this -> dao -> loadFilters();
    }
    public function getDetails($args) {
        return $this -> dao -> getDetails($args[0]);
    }
    public function addView($args) {
        return $this -> dao -> addView($args[0]);
    }
    public function getCart($args) {
        if ($args[1] == "null") {
            $user = "guest";
        } else {
            $user = json_decode(jwt_process::decode($args[1], $args[0]), true)['name'];
        }
        return $this -> dao -> getCart($user);
    }
    public function addItemCart($args) {
        if ($args[1] == "null") {
            $user = "guest";
        } else {
            $user = json_decode(jwt_process::decode($args[1], $args[0]), true)['name'];
        }
        return $this -> dao -> addItemCart($user,$args[2]);
    }
    public function rmItemCart($args) {
        if ($args[1] == "null") {
            $user = "guest";
        } else {
            $user = json_decode(jwt_process::decode($args[1], $args[0]), true)['name'];
        }
        return $this -> dao -> rmItemCart($user,$args[2]);
    }
    public function addItemFav($args) {
        if ($args[1] == "null") {
            $user = "guest";
        } else {
            $user = json_decode(jwt_process::decode($args[1], $args[0]), true)['name'];
        }
        return $this -> dao -> addItemFav($user,$args[2]);
    }
    public function rmItemFav($args) {
        if ($args[1] == "null") {
            $user = "guest";
        } else {
            $user = json_decode(jwt_process::decode($args[1], $args[0]), true)['name'];
        }
        return $this -> dao -> rmItemFav($user,$args[2]);
    }
    public function addItemIns($args) {
        if ($args[1] == "null") {
            $user = "guest";
        } else {
            $user = json_decode(jwt_process::decode($args[1], $args[0]), true)['name'];
        }
        return $this -> dao -> addItemIns($user,$args[2]);
    }
    public function rmItemIns($args) {
        if ($args[1] == "null") {
            $user = "guest";
        } else {
            $user = json_decode(jwt_process::decode($args[1], $args[0]), true)['name'];
        }
        return $this -> dao -> rmItemIns($user, $args[2]);
    }  
}// end_home_bll