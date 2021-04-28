<?php
//////
class common {

    // function console_log( $data ){
    //     echo '<script>';
    //     echo 'console.log('. json_encode( $data ) .')';
    //     echo '</script>';
    //   }

    function loadError() {
        require_once (VIEW_PATH_INC . 'topPageHome.php');
        require_once (VIEW_PATH_INC . 'menu.html');
        require_once (VIEW_PATH_INC . 'error404.html');
        require_once (VIEW_PATH_INC . 'content.html');
    }// end_loadError
    
    static function loadView($topPage, $view) {
        $topPage = VIEW_PATH_INC . $topPage;
        //////
        if ((file_exists($topPage)) && (file_exists($view))) {
            require_once ($topPage);

            require_once (VIEW_PATH_INC . 'menu.html');
            require_once ($view);
            require_once (VIEW_PATH_INC . 'content.html');
        }else {
            self::loadError();
        }// end_else
    }// end_loadView
    
    static function accessModel($model, $function = null, $args = null) {
        $dir = explode('_', $model);
        $path = constant('MODEL_PATH_' . strtoupper($dir[0])) .  $model . '.class.singleton.php';

        if (file_exists($path)) {
            require_once ($path);

            if (method_exists($model, $function)) {


                $obj = $model::getInstance();
                if ($args != null) {

                    return call_user_func(array($obj, $function), $args);
                }// end_if
                return call_user_func(array($obj, $function));
            }// end_if
        }// end_if
        //////
        throw new Exception();
    }// end_accessModel

    static function generate_Token_secure($longitud){
        if ($longitud < 4) {
            $longitud = 4;
        }
        return bin2hex(openssl_random_pseudo_bytes(($longitud - ($longitud % 2)) / 2));
    }// end_generate_Token_securre

    static function friendlyURL($url) {
        $link = "";
        if (URL_FRIENDLY) {
            $url = explode("&", str_replace("?", "", $url));
            foreach ($url as $key => $value) {
                $aux = explode("=", $value);
                $link .=  $aux[1]."/";
            }
        } else {
            $link = "index.php?" . $url;
        }// end_else
        return SITE_PATH . $link;
    }// end_friendlyURL
}// end_common
