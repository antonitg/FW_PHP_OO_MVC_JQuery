<?php
class controller_logreg {
    function list() {
        common::loadView('topPageLogreg.php', VIEW_PATH_LOGREG . 'logreg.html');
    
    }
    function register() {
        $ini_file = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/cars/FW_3AVA/FW_PHP_OO_MVC_JQuery/model/credentials/apis.ini');
        echo common::accessModel('logreg_model', 'register', [$_POST['passwd'],$ini_file["secret"],$_POST['fullname'], $_POST['username'], $_POST['email']]) -> getResolve();
    }
    function login() {
        $ini_file = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/cars/FW_3AVA/FW_PHP_OO_MVC_JQuery/model/credentials/apis.ini');
        // echo json_encode("brhu");
        echo common::accessModel('logreg_model', 'login', [$_POST['passwd'],$ini_file["secret"],$_POST['username']]);
    }
    function verify(){
        common::accessModel('logreg_model', 'verifyToken', $_GET['param']) -> getResolve();
        echo  "<script type='text/javascript'>";
        echo "window.close();";
        echo "</script>";

    }
    function sendVerifyEmail() {
        $result = common::accessModel('logreg_model', 'verifyUser', [$_POST['email']]);
        $email = [];
        if ($result != false) {
            $email = ['type' => 'verify', 'token' => $result['token'], 'toEmail' => $result['email'],'fromEmail' => "support@loreipsumcars.com", 'inputMessage' => 'Recover password link: '];
            $sendedEmail = mail::setEmail($email);
        }// end_if
        if (!empty($sendedEmail['token'])) {
            echo common::accessModel('logreg_model', 'setVerifyToken', [$sendedEmail["token"],$sendedEmail["email"]]) -> getResolve();
            // echo json_encode($sendedEmail);
            // return;
        } else {
            echo json_encode("Fail");
        }// end_if
        
    }//
}
