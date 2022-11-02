<?php 
	unset($_SESSION['idUsuario']);
	unset($_SESSION['nombre_completo']);
	unset($_SESSION['tipo']);
	unset($_SESSION['idAgencia']);
	header("location:login");
?>