<?php
	class connect{
		public static function con(){
			$host = 'localhost';  
    		$user = "root";                     
    		$pass = "antoni";                             
    		$db = "concesionario";                      
    		$port = 3306;                           
    		
    		$conexion = mysqli_connect($host, $user, $pass, $db, $port);
			return $conexion;
		}
		
		public static function close($conexion){
			mysqli_close($conexion);
		}
	}