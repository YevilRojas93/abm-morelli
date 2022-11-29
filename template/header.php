<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href='http://abm-morelli.herokuapp.com/'>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ABM MORELLI</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script defer="" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style.css">
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="js/jqueryui/external/jquery/jquery.js" defer></script>
	<link rel="stylesheet" href="js/jqueryui/jquery-ui.min.css">
	<script src="js/jqueryui/jquery-ui.min.js" defer></script>
	<script src="js/jqueryui/datepicker.js" defer></script>
</head>
<body>
	<!-- A grey horizontal navbar that becomes vertical on small screens -->
<nav class="navbar navbar-expand-sm border-bottom border-2 border-secondary pb-2 mb-4" style="background-color: #D0D0D0;">
  <div class="container-fluid">
    <!-- Links -->
    <ul class="navbar-nav">
      <li class="nav-item me-2">
        <div class="dropdown">
		  <button class="btn btn-success fw-bold dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		    AGENCIA
		  </button>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
		  	<?php if(isset($_SESSION["tipo"]) AND $_SESSION["tipo"] == "administrador"):?>
		    	<li><a class="dropdown-item" href="registraragencia">REGISTRAR AGENCIA</a></li>
		  	<?php endif;?>
		    <li><a class="dropdown-item" href="listadoagencia">LISTADO AGENCIA</a></li>
		  </ul>
		</div>
      </li>
      <li class="nav-item me-2">
      	<div class="dropdown">
				  <button class="btn btn-success fw-bold dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
				    COBROS
				  </button>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
				  	<?php if ($_SESSION["tipo"] == "agenciero"){
				     echo '<li><a class="dropdown-item" href="cargarcobros">CARGAR COBROS</a></li>';
				    }
				    ?>
				    
				    <li><a class="dropdown-item" href="listadocobros">LISTADO COBROS</a></li>
				 	</ul>
				</div>
      </li>
      <li class="nav-item me-2">
        <div class="dropdown">
				  <button class="btn btn-warning text-light fw-bold dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
				    REPORTES
				  </button>
				  <ul class="dropdown-menu w-100" style="min-width: 18rem;" aria-labelledby="dropdownMenuButton1">
				    <li><a class="dropdown-item" href="resumendia">VER RESUMEN DE COBROS DEL DIA</a></li>
				    <li><a class="dropdown-item" href="cobrospendientes">VER COBROS PENDIENTES</a></li>
				  </ul>
				</div>
      </li>
      <?php if ($_SESSION["tipo"] == "administrador"):?>
	      <li class="nav-item">
	        <div class="dropdown">
					  <button class="btn btn-primary text-light fw-bold dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
					    USUARIOS
					  </button>
					  <ul class="dropdown-menu w-100" style="min-width: 18rem;" aria-labelledby="dropdownMenuButton1">
					    <li><a class="dropdown-item" href="listadousuarios">VER LISTADO</a></li>
					    <li><a class="dropdown-item" href="registro">CREAR USUARIOS</a></li>
					  </ul>
					</div>
	      </li>
    	<?php endif; ?>
    </ul>
    <div>
    		<div class="btn-group">
    			<a class="btn btn-warning fw-bold text-light" href="Manual_Basico_PHP.pdf" download="manual.pdf" target="_blank">Descargar Manual</a>
				  <button class="btn btn-success fw-bold dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
				    <?= $_SESSION["nombre_completo"]  ?><i class="fas fa-chevron-down"></i>
				  </button>
				  <ul class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
				    <li><a href="editarusuario/<?= $_SESSION["idUsuario"] ?>" class="dropdown-item  text-primary fw-bold">Editar</a></li>
				    <li><a href="logout" class="dropdown-item text-danger fw-bold">Cerrar sesion</a></li>
				 	</ul>
				</div>
    	
    </div>
  </div>
</nav>
