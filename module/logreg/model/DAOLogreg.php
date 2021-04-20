<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/cars/FW_PHP_OO_MVC_JQuery/';
include($path . "model/connect.php");
include($path . "general/middleware/middleware.php");
require_once $path."/general/classes/JWT.php";

class DAOLogreg
{
    function register ($pass,$secret,$fullname,$username,$email){
        $pwd_peppered = hash_hmac("sha256", $pass, $secret);
        $pwd_hashed = password_hash($pwd_peppered, PASSWORD_DEFAULT);
        $grav_url = "https://www.gravatar.com/avatar/".md5( strtolower( trim( $email ) ) );
        $conexion = connect::con();
        $sql = "INSERT INTO `users` (`fullname`, `username`, `email`, `passwd`, `avatar`) VALUES ('{$fullname}', '{$username}', '{$email}', '{$pwd_hashed}', '{$grav_url}')";
        $res = mysqli_query($conexion, $sql);
        return $res;
    }
    function login ($pass,$secret,$username){
        $pwd_peppered = hash_hmac("sha256", $pass, $secret);
        $conexion = connect::con();
        $sql = "SELECT passwd FROM users WHERE username = '{$username}'";
        $res = mysqli_query($conexion, $sql);
        $result = $res->fetch_assoc();
        if(password_verify($pwd_peppered, $result["passwd"])){
            $header = '{"typ":"JWT", "alg":"HS256"}';
            $iat=time();
            $exp=time() + 3600;
            $payload = '{"iat":"'.$iat.'","exp":"'.$exp.'","name":"'.$username.'"}';
            
            $JWT = new JWT;
            $token = $JWT->encode($header, $payload, $secret); 
            // $token = tkencode($secret,$username);
            // return $token;
            $total = array("message"=>'Succefully loged in!', "token"=>$token, "page"=>'index.php');
            // return "{
            //     'message':'Succefully loged in!', 
            //     'token':'{$token}',
            //     'page':'index.php?page=hello'
            // }";
                return $total;
        }else{
            return "You username and password don't match, try again!";
        }
        return "You username and password don't match, try again!";

    }
    function load_autocomplete($keyword,$condition,$brand)
    {
        $sql = "SELECT model FROM cars 
                WHERE model LIKE '%{$keyword}%' AND carcondition LIKE '{$condition}' AND brand LIKE '{$brand}'";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $resArray[] = $row;
        }
        return $resArray;
    }
}
