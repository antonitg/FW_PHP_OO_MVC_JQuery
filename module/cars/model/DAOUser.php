<?php
     $path = $_SERVER['DOCUMENT_ROOT'] . '/cars/';
	 include($path . "model/connect.php");
    
	class DAOUser{
		function insert_user($datos){
			$registration=$datos["Registration"];
        	$brand=$datos["Brand"];
        	$model=$datos["Model"];
        	$regdate=$datos["RegistrationDate"];
        	$carcondition=$datos["Condition"];
			$preupgrades=$datos["Upgrade"];
			$category=$datos["Category"];
			$price=$datos["Price"];
			$upgrades = "";
        	foreach ($preupgrades as $indice) {
        	     $upgrades.=$indice.":";
        	 }
        	$sql = " INSERT INTO cars (registration, brand, model, regdate, carcondition, upgrades, category, price) VALUES ('$registration', '$brand', '$model', STR_TO_DATE('$regdate', '%m/%d/%Y'), '$carcondition', '$upgrades', '$category', '$price')";
			$img = "https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg";
			$tipo = "car";
			$sqldos = "INSERT INTO img (id,src,tipo) VALUES ('$registration','$img','$tipo')";
            $conexion = connect::con();
			$res = mysqli_query($conexion, $sql);
			$resdos = mysqli_query($conexion, $sqldos);

			return $res;
		}
		
		function select_all_user(){
			$sql = "SELECT * FROM cars ORDER BY registration ASC";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
		}
		
		function select_user($registration){
			$sql = "SELECT * FROM cars WHERE registration='$registration'";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql)->fetch_object();
			connect::close($conexion);
			//echo '<script> alert("'.$res.'")</script>';
            return $res;
		}
		
		function update_user($datos){
			$registration=$datos["Registration"];
        	$brand=$datos["Brand"];
        	$model=$datos["Model"];
        	$regdate=$datos["RegDate"];
        	$carcondition=$datos["Condition"];
			$preupgrades=$datos["Upgrade"];
			
			$updatedupgrades="";
        	foreach ($preupgrades as $indice) {

        	     $updatedupgrades.=$indice.":";
        	 }

        	$sql = "UPDATE cars SET registration='$registration', brand='$brand', model='$model', regdate=STR_TO_DATE('$regdate', '%Y-%m-%d'), carcondition='$carcondition', upgrades='$updatedupgrades' WHERE registration='$registration'";

            $conexion = connect::con();
			$res = mysqli_query($conexion, $sql);
			echo '<script> alert("'.$sql.'")</script>';
			//echo '<script> alert("'.$res.'")</script>';
            connect::close($conexion);
			return $res;
		}
		
		function delete_user($registration){
			$sql = "DELETE FROM cars WHERE registration='$registration'";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
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