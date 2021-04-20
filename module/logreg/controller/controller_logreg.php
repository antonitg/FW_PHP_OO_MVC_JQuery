<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/cars/FW_PHP_OO_MVC_JQuery/';
include($path . "module/logreg/model/DAOLogreg.php");
include($path . "model/credentials/credentials.php");
switch ($_GET['op']) {
    case 'register';
        try {
            $daologreg = new DAOLogreg();
            $rdo = $daologreg->register($_GET['passwd'], $secret, $_GET['fullname'], $_GET['username'], $_GET['email']);
        } catch (Exception $e) {
            echo json_encode("ERROR: Seems that our servers are not running properly, we're trying to fix it ASAP.");
            exit;
        }
        if (!$rdo) {
            echo json_encode("ERROR: There is another user with the same username/email as you! Try again.");
            // echo json_encode($rdo);

            exit;
        } else {
            echo json_encode("Succefully registered, now you can log in!");
            // echo json_encode($rdo);
            exit;
        }
        break;
    case 'login';
        try {
            $daologreg = new DAOLogreg();
            $rdo = $daologreg->login($_GET['passwd'],$secret,$_GET['username']);
        } catch (Exception $e) {
            echo json_encode("ERROR: Seems that our servers are not running properly, we're trying to fix it ASAP.");
            // echo json_encode($rdo);
            exit;
        }
        if (!$rdo) {
            // echo json_encode("ERROR: Your username and password don't match! Try again.");
            echo json_encode($rdo);
            exit;
        } else {
            // echo json_encode("Succefully loged");
            echo json_encode($rdo);
            exit;
        }
        break;
}
