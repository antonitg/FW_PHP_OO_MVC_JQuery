<?php
class controller_shop {
    function list() {
        common::loadView('topPageShop.php', VIEW_PATH_SHOP . 'shop.html');
    }
    function getFiltersSearch() {
        // $algoo = parse_ini_file(__DIR__ . '/../where/config.ini');
        $ini_file = parse_ini_file('C:/localserver/Apache24/htdocs/cars/FW_3AVA/model/credentials/apis.ini');
        // $arrayret = (array) $_POST['object'];
        $info = json_decode($_POST['objenv'], true);        // 

        // echo json_decode($_POST["objenv"],true)["brand"];
        // echo $info["token"];
        echo common::accessModel('shop_model', 'getFiltersSearch', [$ini_file["secret"],$info['token'],$info['keyword'], $info['brand'], $info['condition'], $info['minprice'], $info['maxprice'], $info['showing'], $info['page']]) -> getResolve();

    }
    function getPagination() {
        echo common::accessModel('shop_model', 'getPagination', [$_POST['keyword'],$_POST['brand'],$_POST['condition'],$_POST['minprice'],$_POST['maxprice']]) -> getResolve();
    }
    function getMapShop() {
        echo common::accessModel('shop_model', 'getMapShop', [$_POST['lat'],$_POST['lon']]) -> getResolve();
    }
    function getSearchResults() {
        echo common::accessModel('shop_model', 'getSearchResults', $_POST['keyword']) -> getResolve();
    }
    function getDetails() {
        echo common::accessModel('shop_model', 'getDetails', $_POST['registration']) -> getResolve();
    }
    function loadFilters() {
        echo common::accessModel('shop_model', 'loadFilters') -> getResolve();
    }
    function addView() {
        echo common::accessModel('shop_model', 'addView', $_POST['registration']) -> getResolve();
    }
    function getCart() {
        $ini_file = parse_ini_file('/cars/FW_3AVA/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'getCart', [$ini_file["secret"],$_POST['token']]) -> getResolve();
    }
    function addItemCart() {
        $ini_file = parse_ini_file('/cars/FW_3AVA/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'addItemCart', [$ini_file["secret"],$_POST['token'], $_POST['registration']]) -> getResolve();
    }
    function rmItemCart() {
        $ini_file = parse_ini_file('/cars/FW_3AVA/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'rmItemCart', [$ini_file["secret"],$_POST['token'], $_POST['registration']]) -> getResolve();
    }
    function addItemFav() {
        $ini_file = parse_ini_file('/cars/FW_3AVA/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'addItemFav', [$ini_file["secret"],$_POST['token'], $_POST['registration']]) -> getResolve();
    }
    function rmItemFav() {
        $ini_file = parse_ini_file('/cars/FW_3AVA/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'rmItemFav', [$ini_file["secret"],$_POST['token'], $_POST['registration']]) -> getResolve();
    }
    function addItemIns() {
        $ini_file = parse_ini_file('/cars/FW_3AVA/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'addItemIns', [$ini_file["secret"],$_POST['token'], $_POST['registration']]) -> getResolve();
    }
    function rmItemIns() {
        $ini_file = parse_ini_file('/cars/FW_3AVA/model/credentials/apis.ini');
        echo common::accessModel('shop_model', 'rmItemIns', [$ini_file["secret"],$_POST['token'], $_POST['registration']]) -> getResolve();
    }
}