hoy a las 23:44
<?php
    // https://github.com/mailgun/mailgun-php
    // Authorized Recipients -> afegir a 'yomogan@gmail.com'
    const EMAIL_KEY = "key-b03ea382234234234a5c77561991d0b0";
    const EMAIL_URL = "https://api.mailgun.net/v3/sandbox8d976a9e55b2343423aadb33c7a22.mailgun.org/messages";
    function send_mailgun($email){
        $config = array();
        $config['api_key'] =EMAIL_KEY; //API Key
        $config['api_url'] = EMAIL_URL ; //API Base URL

        $message = array();
        $message['from'] = "gineraantoni@gmail.com";
        $message['to'] = $email;
        $message['h:Reply-To'] = "gineraantoni@gmail.com";
        $message['subject'] = "Hello, this is a test";
        $message['html'] = 'Hello ' . $email . ',</br></br> This is a test';

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
        curl_close($ch);
        return $result;
    }

    $json = send_mailgun('antonitormo@gmail.com');
    print_r($json);