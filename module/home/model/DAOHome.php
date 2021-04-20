<?php
     $path = $_SERVER['DOCUMENT_ROOT'] . '/cars/';
     include($path . "model/connect.php");
     
     class DAOHome{

		
		function categories(){
            $sql = "SELECT * FROM `img` WHERE `tipo` = 'cat'";
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            while($row = $res->fetch_array(MYSQLI_ASSOC)) {
                $resArray[] = $row;
            }
            return $resArray;
		}
        
        function rand_prod(){
            $sql = "SELECT * FROM `cars` AS c LEFT JOIN `img` AS i ON c.registration = i.id ORDER BY RAND() LIMIT 10";
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            while($row = $res->fetch_array(MYSQLI_ASSOC)) {
                $resArray[] = $row;
            }
            return $resArray;
		}



		function check_key($value){
			$sql = "SELECT Registration FROM cars";
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
			connect::close($conexion);
			foreach ($res as $existentkey) {
				if ($existentkey["Registration"] == $value){
					return false;
				}
			}
			return true;
		}
	}