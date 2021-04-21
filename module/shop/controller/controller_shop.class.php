<?php
class controller_shop {
    function list() {
        common::loadView('topPageShop.php', VIEW_PATH_SHOP . 'shop.html');
    }
    function getFiltersSearch() {
        $ini_file = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/cars/FW_3AVA/FW_PHP_OO_MVC_JQuery/model/credentials/apis.ini');
        $info = json_decode($_POST['objenv'], true);
        echo common::accessModel('shop_model', 'getFiltersSearch', [$ini_file["secret"],$info['token'],$info['keyword'], $info['brand'], $info['condition'], $info['minprice'], $info['maxprice'], $info['showing'], $info['page']]) -> getResolve();
    }
    function getPagination() {
        $info = json_decode($_POST['objenv'], true);
        echo common::accessModel('shop_model', 'getPagination', [$info['keyword'],$info['brand'],$info['condition'],$info['minprice'],$info['maxprice']]) -> getResolve();
    }
    function getMapShop() {
        echo common::accessModel('shop_model', 'getMapShop', [$_POST['lat'],$_POST['lon']]) -> getResolve();
    }
    function getSearchResults() {
        echo common::accessModel('shop_model', 'getSearchResults', [$_POST['keyword']]) -> getResolve();
    }
    function getDetails() {
        echo common::accessModel('shop_model', 'getDetails', [$_POST['registration']]) -> getResolve();
    }
    function loadFilters() {
        echo common::accessModel('shop_model', 'loadFilters') -> getResolve();
    }
    function addView() {
        echo common::accessModel('shop_model', 'addView', [$_POST['registration']]) -> getResolve();
    }
    function getCart() {
        $ini_file = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/cars/FW_3AVA/FW_PHP_OO_MVC_JQuery/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'getCart', [$ini_file["secret"],$_POST['token']]) -> getResolve();
    }
    function addItemCart() {
        $ini_file = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/cars/FW_3AVA/FW_PHP_OO_MVC_JQuery/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'addItemCart', [$ini_file["secret"],$_POST['token'], $_POST['registration']]) -> getResolve();
    }
    function rmItemCart() {
        $ini_file = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/cars/FW_3AVA/FW_PHP_OO_MVC_JQuery/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'rmItemCart', [$ini_file["secret"],$_POST['token'], $_POST['registration']]) -> getResolve();
    }
    function addItemFav() {
        $ini_file = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/cars/FW_3AVA/FW_PHP_OO_MVC_JQuery/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'addItemFav', [$ini_file["secret"],$_POST['token'], $_POST['registration']]) -> getResolve();
    }
    function rmItemFav() {
        $ini_file = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/cars/FW_3AVA/FW_PHP_OO_MVC_JQuery/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'rmItemFav', [$ini_file["secret"],$_POST['token'], $_POST['registration']]) -> getResolve();
    }
    function addItemIns() {
        $ini_file = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/cars/FW_3AVA/FW_PHP_OO_MVC_JQuery/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'addItemIns', [$ini_file["secret"],$_POST['token'], $_POST['registration']]) -> getResolve();
    }
    function rmItemIns() {
        $ini_file = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/cars/FW_3AVA/FW_PHP_OO_MVC_JQuery/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'rmItemIns', [$ini_file["secret"],$_POST['token'], $_POST['registration']]) -> getResolve();
    }
}