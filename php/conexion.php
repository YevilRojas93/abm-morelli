<?php 
	//Clase conexion
	class Conexion
	{
		public static function conectar()
		{
			/*LOCALHOST*/
			$dbname = "abm_morelli";
			$userdb = "root";
			$passdb = "";
			$ip = "localhost";

			$link = new PDO ("mysql:host=".$ip.";dbname=".$dbname."",$userdb,$passdb);
			$link->exec("SET CHARACTER SET utf8");
			return $link;
		}
	}
 ?>