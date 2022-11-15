<?php 
	//Clase conexion
	class Conexion
	{
		public static function conectar()
		{
			/*LOCALHOST*/
			$dbname = "yevilrojas_db";
			$userdb = "287668";
			$passdb = "asd123ASD@";
			$ip = "mysql-yevilrojas.alwaysdata.net";

			$link = new PDO ("mysql:host=".$ip.";dbname=".$dbname."",$userdb,$passdb);
			$link->exec("SET CHARACTER SET utf8");
			$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $link;
		}
	}
 ?>