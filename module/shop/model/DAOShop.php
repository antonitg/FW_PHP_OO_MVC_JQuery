<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/cars/FW_PHP_OO_MVC_JQuery/';
include($path . "model/connect.php");
require_once $path . "/general/classes/JWT.php";


class DAOShop
{

    // function load_filters()
    // {
    //     $sql = "SELECT brand,count(brand) AS num FROM cars\n"

    //         . "GROUP BY brand\n"

    //         . "ORDER BY count(brand) DESC";
    //     $conexion = connect::con();
    //     $res = mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    //         $resArray[] = $row;
    //     }
    //     return $resArray;
    // }
    // function details($registration)
    // {
    //     $sql = "SELECT i.src AS srcimg,c.* FROM cars c
    //         RIGHT JOIN img i
    //         ON c.registration=i.id
    //         WHERE registration='$registration'";
    //     $conexion = connect::con();
    //     $res = mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     $result = $res->fetch_assoc();
    //     return $result;
    // }

    // function loadcart($user, $secret)
    // {
    //     $JWT = new JWT;
    //     $decoded = $JWT->decode($user, $secret);
    //     $final = json_decode($decoded, true);
    //     $user = $final['name'];
    //     $sql = "SELECT ca.*,c.cartuser,c.insurance,c.cartprice,i.src FROM cart c LEFT JOIN cars ca ON ca.registration=c.registration LEFT JOIN img i ON i.id=c.registration WHERE c.cartuser = '{$user}'";
    //     $conexion = connect::con();
    //     $res = mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    //         $resArray[] = $row;
    //     }
    //     return $resArray;
    // }

    // function addcart($user, $registration, $secret)
    // {
    //     $JWT = new JWT;
    //     $decoded = $JWT->decode($user, $secret);
    //     $final = json_decode($decoded, true);
    //     $user = $final['name'];
    //     $sql = "INSERT INTO `cart`(`cartuser`, `registration`) VALUES ('{$user}','{$registration}')";
    //     $conexion = connect::con();
    //     mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     return true;
    // }
    // function removecart($user, $registration, $secret)
    // {
    //     $JWT = new JWT;
    //     $decoded = $JWT->decode($user, $secret);
    //     $final = json_decode($decoded, true);
    //     $user = $final['name'];
    //     $sql = "DELETE FROM cart WHERE registration = '{$registration}' AND cartuser = '{$user}'";
    //     $conexion = connect::con();
    //     mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     return true;
    // }
    function checkout($user, $secret)
    {
        $JWT = new JWT;
        $decoded = $JWT->decode($user, $secret);
        $final = json_decode($decoded, true);
        $user = $final['name'];
        $sql = "SELECT * FROM cart WHERE cartuser = '{$user}'";
        $conexion = connect::con();
        $cartusu = mysqli_query($conexion, $sql);
        $sql = "SELECT orderid+1 AS num FROM histcompr ORDER BY orderid desc LIMIT 1";
        $numorder = mysqli_query($conexion, $sql);
        $numorderid = $numorder->fetch_array(MYSQLI_ASSOC);
        if ($numorderid["num"] == null){
            $num = 1;
        } else {
            $num = $numorderid["num"];
        }
        while ($row = $cartusu->fetch_array(MYSQLI_ASSOC)) {
           $sql="INSERT INTO histcompr (orderid,usercompr,regcompr,price,insurance,datecompr) VALUES ({$num},'{$row['cartuser']}','{$row['registration']}',{$row['cartprice']},{$row['insurance']},now())";
           mysqli_query($conexion, $sql);
           $sql="DELETE FROM cart WHERE registration = '{$row['registration']}'";
           mysqli_query($conexion, $sql);
           $sql="DELETE FROM cars WHERE registration = '{$row['registration']}'";
           mysqli_query($conexion, $sql);  
        }
        connect::close($conexion);
        return true;
    }
    // function addinsurance($user, $registration, $secret)
    // {
    //     $JWT = new JWT;
    //     $decoded = $JWT->decode($user, $secret);
    //     $final = json_decode($decoded, true);
    //     $user = $final['name'];
    //     $sql = "UPDATE cart SET insurance = 1 WHERE registration = '{$registration}' AND cartuser = '{$user}'";
    //     $conexion = connect::con();
    //     mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     return true;
    // }
    // function removeinsurance($user, $registration, $secret)
    // {
    //     $JWT = new JWT;
    //     $decoded = $JWT->decode($user, $secret);
    //     $final = json_decode($decoded, true);
    //     $user = $final['name'];
    //     $sql = "UPDATE cart SET insurance = 0 WHERE registration = '{$registration}' AND cartuser = '{$user}'";
    //     $conexion = connect::con();
    //     mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     return true;
    // }

    // function fav($user, $registration, $secret)
    // {
    //     $JWT = new JWT;
    //     $decoded = $JWT->decode($user, $secret);
    //     $final = json_decode($decoded, true);
    //     $user = $final['name'];
    //     $sql = "INSERT INTO `favs`(`userfav`, `registrationfav`) VALUES ('{$user}','{$registration}')";
    //     $conexion = connect::con();
    //     mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     return true;
    // }
    // function unfav($user, $registration, $secret)
    // {
    //     $JWT = new JWT;
    //     $decoded = $JWT->decode($user, $secret);
    //     $final = json_decode($decoded, true);
    //     $user = $final['name'];
    //     $sql = "DELETE FROM favs
    //     WHERE registrationfav = '{$registration}' AND userfav = '{$user}'";
    //     $conexion = connect::con();
    //     mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     return true;
    // }

    // function getmap($lat, $lon)
    // {
    //     $sql = "SELECT price,carcondition,brand,model,src,lat,lon,registration,ABS(ABS({$lat} - lat)) + ABS(ABS({$lon} - lon)) AS diftotal from cars c
    //                 LEFT JOIN img i
    //                 ON i.id=c.registration
    //                 ORDER BY diftotal 
    //                 LIMIT 5";
    //     $conexion = connect::con();
    //     $res = mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    //         $resArray[] = $row;
    //     }
    //     return $resArray;
    // }
    // function search($keyword)
    // {
    //     $sql = "SELECT * FROM `cars` WHERE `brand` LIKE '%{$keyword}%' OR `model` LIKE '%{$keyword}%' OR `category` LIKE '%{$keyword}%'";
    //     $conexion = connect::con();
    //     $res = mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    //         $resArray[] = $row;
    //     }
    //     return $resArray;
    // }

    // function addview($registration)
    // {
    //     $sql = "UPDATE cars SET views = views + 1 WHERE registration = '{$registration}'";
    //     $conexion = connect::con();
    //     mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    // }

    // function filter($keyword, $brand, $condition, $minprice, $maxprice, $showing, $page, $user, $secret)
    // {
    //     if ($user == "null") {
    //         $user = "guest";
    //     } else {
    //         $JWT = new JWT;
    //         $decoded = $JWT->decode($user, $secret);
    //         $final = json_decode($decoded, true);
    //         $user = $final['name'];
    //     }

    //     if ($minprice == "null") {
    //         $minprice = 100;
    //     }
    //     if ($maxprice == "null") {
    //         $maxprice = 99999999;
    //     }

    //     $from = $showing * ($page - 1);

    //     $sql = "SELECT c.*,v.registrationfav FROM `cars` c LEFT JOIN `favs` v ON v.userfav = '{$user}' AND v.registrationfav=c.registration WHERE `brand` LIKE '{$brand}' AND `carcondition` LIKE '{$condition}' AND `model` LIKE '%{$keyword}%' AND `price` BETWEEN '{$minprice}' AND '{$maxprice}' ORDER BY views desc LIMIT {$from},{$showing}";
    //     $conexion = connect::con();
    //     $res = mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    //         $resArray[] = $row;
    //     }
    //     return $resArray;
    // }
    // function pagination($keyword, $brand, $condition, $minprice, $maxprice, $showing, $page)
    // {
    //     if ($minprice == "null") {
    //         $minprice = 100;
    //     }
    //     if ($maxprice == "null") {
    //         $maxprice = 99999999;
    //     }

    //     $sql = "SELECT * FROM `cars`
    //     WHERE `brand` LIKE '{$brand}' AND `carcondition` LIKE '{$condition}' AND `model` LIKE '%{$keyword}%' AND `price` BETWEEN '{$minprice}' AND '{$maxprice}'";
    //     $conexion = connect::con();
    //     $res = mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    //         $resArray[] = $row;
    //     }

    //     return $resArray;
    // }


    // function search_brand($keyword)
    // {
    //     $sql = "SELECT * FROM `cars` WHERE `brand` LIKE '{$keyword}'";
    //     $conexion = connect::con();
    //     $res = mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    //         $resArray[] = $row;
    //     }
    //     return $resArray;
    // }



    // function check_key($value)
    // {
    //     $sql = "SELECT Registration FROM cars";
    //     $conexion = connect::con();
    //     $res = mysqli_query($conexion, $sql);
    //     connect::close($conexion);
    //     foreach ($res as $existentkey) {
    //         if ($existentkey["Registration"] == $value) {
    //             return false;
    //         }
    //     }
    //     return true;
    // }
}
