<?php
//////
class controller_aboutus {
    function list() {
        common::loadView('topPageAboutus.php', VIEW_PATH_ABOUTUS . 'aboutus.html');
    }// end_list
    function sendEmail() {
        $messageAdmin = ['type' => 'admin', 
                            'inputName' => $_POST['name'], 
                            'fromEmail' => $_POST['email'], 
                            'inputMatter' => $_POST['matter'], 
                            'inputMessage' => $_POST['message']];
        $messageClient = ['type' => 'contact', 
                            'toEmail' => $_POST['email'], 
                            'inputMatter' => '', 
                            'inputMessage' => ''];
        $emailAdmin = json_decode(mail::setEmail($messageAdmin), true);
        //////
        if (!empty($emailAdmin)) {
            $emailClient = json_decode(mail::setEmail($messageClient), true);
            if (!empty($emailClient['id'])) {
                echo json_encode('Done!');
                //////
                return;
            }// end_if
        }// end_if
        echo 'error';
    }// end_sendEmail
}// end_controller_contact