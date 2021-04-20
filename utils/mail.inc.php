<?php
//////
class mail {
    static function setEmail($email) {
        $content = "";
        //////
        switch ($email['type']) {
            case 'contact';
                $email['fromEmail'] = 'support@getyourcar.com';
                $email['inputMatter'] = 'Your request has been sended.';
                $content .= "<h2>Thank test you for sending us an email</h2><br>";
                $content .= "<p>You will recive an email soon answering your request.</p><br>";
                break;
                //////
            case 'admin';
                $email['toEmail'] = 'antonitormogar@gmail.com';
                break;
                //////
            case 'recover';
                $email['fromEmail'] = 'support@getyourcar.com';
                $email['inputMatter'] = 'Recover Password.';
                $content .= "<h2>Thanks for contacting us.</h2>";
                $content .= "<a href = '" . common::friendlyURL('?page=login&op=recover&param=' . $email['token']) ."'>Click here for recover your password.</a>";
                break;
                //////
            case 'validate';
                $email['fromEmail'] = 'support@getyourcar.com';
                $email['inputMatter'] = 'Email verification.';
                $content .= '<h2>Email verification.</h2>';
                $content .= '<a href = "' . common::friendlyURL('?page=login&op=verify&param=' . $email['token']) . '">Click here for verify your email.</a>';
                break;
                //////
        }// end_switch
        //////
        $content .= "<br><a Mira esto pareix que haja enviat el correu desde el teu propi correu pero no jaja</a>";
        $email['inputMessage'] .= $content;
        //////
        return self::sendMailGun($email);
    }// end_setEmail
    
    static function sendMailGun($values) {
        $ini_file = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/cars/FW_3AVA/model/credentials/apis.ini');
        $config = array();
        //////
        $config['api_key'] = $ini_file['mailGunKey'];
        $config['api_url'] = $ini_file['mailGunURL'];
        $message = array();
        $message['from'] = $values['fromEmail'];
        $message['to'] = $values['toEmail'];
        // $message['h:Reply-To'] = $values['inputEmail'];
        $message['subject'] = $values['inputMatter'];
        $message['html'] = $values['inputMessage'];

        //////
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $config['api_url']);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "api:{$config['api_key']}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POST, true); 
        curl_setopt($ch, CURLOPT_POSTFIELDS,$message);
        $result = curl_exec($ch);
        // echo '<script>';
        // echo 'console.log('. json_encode( $config ) .')';
        // echo '</script>';
        curl_close($ch);
        //////
        return $result;
    }// end_sendMailGun
}// end_mal
