<?php
class controller_search {
    function getBrandsSearch() {
        // echo $_POST['condition'].'hola';
        echo common::accessModel('search_model', 'getBrandsSearch', $_POST['condition']) -> getResolve();
    }
    function getAutocompleteSearch() {
        echo common::accessModel('search_model', 'getAutocompleteSearch', [$_POST['keyword'],$_POST['condition'],$_POST['brand']]) -> getResolve();
    }
}

