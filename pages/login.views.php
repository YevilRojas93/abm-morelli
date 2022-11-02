
<!DOCTYPE html>
<html lang="en">
<head>
	<base href='http://morelli.local.com/'>
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
<section class="container bg-light border border-4  rounded-3 px-0 pb-3 mt-3" id="section-login">
		
	<h1 class="d-flex justify-content-center pb-2">Login</h1>
	<form method="post" action="php/login.php" class="px-5">
	<div class="mb-3">
		<label for="exampleInputEmail1" class="form-label d-flex justify-content-center "></label>
		<input type="email" name="email" class="form-control bg-abm-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email">

	</div>
	<div class="mb-3">
		<label for="exampleInputPassword1" class="form-label d-flex justify-content-center"></label>
		<input type="password" name="password" class="form-control bg-abm-1" id="exampleInputPassword1" placeholder="Password">
	</div>
	<div class="row ">
	  	<div class=" col-lg-12 d-flex justify-content-center " >
			<button type="submit" class="btn w-50 py-1" >Entrar</button>
		</div>
	</div>
	<div class="text-center">
		<a href="registro" class="link-success fs-5">¿No tienes cuenta?</a>
 	</div>
	</form>
	</section>
	
	<?php 
	//Si existe la variable id y id es == error
	if (isset($_GET["id"]) AND $_GET['id'] == "error"):?>
		<script>
			  Swal.fire({
			  icon: 'error',
			  title: 'Error registro',
			  text: 'Contraseña o email incorrectos.',
			  footer: '<a href="/registro">¿No tienes cuenta?</a>'
			})
		</script>
	
	<?php endif; ?>
</body>
</html>