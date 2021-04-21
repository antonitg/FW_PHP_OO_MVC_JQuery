<?php
//////
define ('PROJECT', '/cars/FW_3AVA/FW_PHP_OO_MVC_Jquery/'); // Project Path
define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . PROJECT); // Site Root
define ('SITE_PATH', 'http://' . $_SERVER['HTTP_HOST'] . PROJECT); // Site Path
define ('CSS_PATH', SITE_PATH . 'view/css/'); // Css Path
define ('JS_PATH', SITE_PATH . 'view/js/'); // JS Path
define ('IMG_PATH', SITE_PATH . 'view/img/'); // IMG Path  //
define ('PRODUCTION', true);
define ('MODEL_PATH', SITE_ROOT . 'model/'); // Model Path
define ('MODULES_PATH', SITE_ROOT . 'module/'); // Modules Path
define ('VIEW_PATH_INC', SITE_ROOT . 'view/inc/'); // View Path Inc
define ('RESOURCES', SITE_ROOT . 'general/resources/'); // Resources Path
define ('UTILS', SITE_ROOT . 'general/utils/'); // Utils Path
//////
// Contact
define ('MODEL_PATH_ABOUTUS', SITE_ROOT . 'module/aboutus/model/');
define ('VIEW_PATH_ABOUTUS', SITE_ROOT . 'module/aboutus/view/');

//Home
define ('VIEW_PATH_HOME', SITE_ROOT . 'module/home/view/');
define ('MODEL_PATH_HOME', SITE_ROOT . 'module/home/model/');
// --------------- Intentar hasta asi -----------------
//Shop
define ('VIEW_PATH_SHOP', SITE_ROOT . 'module/shop/view/');
define ('MODEL_PATH_SHOP', SITE_ROOT . 'module/shop/model/');

//Search
define ('MODEL_PATH_SEARCH', SITE_ROOT . 'module/search/model/');

//Login
define('VIEW_PATH_LOGIN', SITE_ROOT . 'module/login/view/');
define ('MODEL_PATH_LOGIN', SITE_ROOT . '/module/login/model/model/');

//Cart
define('VIEW_PATH_CART', SITE_ROOT . 'module/cart/view/');
define ('MODEL_PATH_CART', SITE_ROOT . '/module/cart/model/model/');

//Menu
define('VIEW_PATH_MENU', SITE_ROOT . 'module/menu/view/');
define ('MODEL_PATH_MENU', SITE_ROOT . '/module/menu/model/');

//Profile
define('VIEW_PATH_PROFILE', SITE_ROOT . 'module/profile/view/');
define ('MODEL_PATH_PROFILE', SITE_ROOT . '/module/profile/model/model/');

// Friendly
define('URL_FRIENDLY', TRUE);

if ($_GET['op'] == 'get') {
    echo json_encode(URL_FRIENDLY);
}
