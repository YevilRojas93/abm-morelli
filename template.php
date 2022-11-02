<?php
  // Si el usuario no esta logeado lo redirecciona al login.php
    if (!isset($_SESSION['idUsuario']) AND $_GET['action'] != "login" AND  $_GET['action'] != "registro" AND  $_GET['action'] != "primera_vez") {
      header("location:/login");
    }
    if (isset($_GET["action"]) AND $_GET["action"] != "login" AND $_GET["action"] != "primera_vez"){
      require_once($_SERVER["DOCUMENT_ROOT"]."/template/header.php");
    }
 $template = new templateController();
 $template->getPage();
?>