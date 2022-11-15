<?php 

class templateController
{
	
	public function getTemplate()
	{
		require_once("../template.php");
	}
	public function getPage()
	{
		$array = ["home","login","registraragencia","registro","cargarcobros","listadoagencia","listadocobros","listadousuarios","editaragencia","editarcobro","resumendia","cobrospendientes","logout","primera_vez","pdf","editarusuario","borrarusuario","borraragencia","borrarcobro"];
		if (!isset($_GET["action"])) {
			$page = "pages/home.views.php";
		}
		elseif(in_array($_GET["action"],$array)){
			$page = "pages/".$_GET['action'].".views.php";
		}
		else{
			$page = "pages/error.views.php";
		}
		require_once($page);
	}
}
 ?>