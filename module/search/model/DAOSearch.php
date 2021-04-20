<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/cars/FW_PHP_OO_MVC_JQuery/';
include($path . "model/connect.php");
class DAOSearch
{
    function load_brands($condition)
    {
        $sql = "SELECT brand,count(brand) AS num FROM cars 
                WHERE carcondition LIKE '{$condition}' 
                GROUP BY brand 
                ORDER BY count(brand) DESC";
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $resArray[] = $row;
        }
        return $resArray;
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
