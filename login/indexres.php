<?php
    // seccion que permite resolver problemas de inclusion de archivos
    $carpeta_trabajo="";
    $seccion_trabajo="/login";

    if (strpos($_SERVER["PHP_SELF"] , $seccion_trabajo) >1 ) {
        $carpeta_trabajo=substr($_SERVER["PHP_SELF"],1, strpos($_SERVER["PHP_SELF"] , $seccion_trabajo)-1);  // saca la carpeta de trabajo del sistema
    }

  
    $absolute_include = str_repeat("../",substr_count($_SERVER["PHP_SELF"] , "/")-1).$carpeta_trabajo; //resuelve problemas de profundidad de carpetas

    

    if (!empty($carpeta_trabajo)) {
        $absolute_include = $absolute_include."/";
        $carpeta_trabajo = "/".$carpeta_trabajo;
    }
    // fin seccion
?>

<!DOCTYPE html>

<html lang="es">

<head>
	<meta charset="utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>registro</title>
	<link rel="shortcut icon" href=../images/i1.png">

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	
	<link type="text/css" rel="stylesheet" href="<?php echo $absolute_include ?>login/css/bootstrap.min.css" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="<?php echo $absolute_include ?>login/ryl.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	
</head>

<body>

	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<div class="form-header">
							<h1>REGISTRARSE</h1>
						</div>
						<form action="<?php echo $absolute_include ?>pagina-principal/register-user" method="POST" id="formulario">
							<div class="form-group">
								<input class="form-control" type="text" name="nombre" id="nombre">
								<span class="form-label">Apellido y Nombre:</span>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="usu" id="usu">
								<span class="form-label">Usuario:</span>
							</div>
							<div class="form-group">
								<input class="form-control" type="text"  name="email" id="correo">
								<span class="form-label">Correo Electrónico:</span>
							</div>							
							<div class="form-group">
								<input class="form-control" type="password"  name="contra" id="contra">
								<span class="form-label">contraseña:</span>
							</div>	
							<div class="mt-3" id="respuesta">

							</div>
							<div class="form-btn">
								<input type="submit" class="button" class="btn btn-block btn-black rm-border"> </div>
								<!-- <button id="inscripcion" type="submit" class="button" name="buttondatos" >Inscribirse</button> -->
							</div>
							<div class="mt-3" id="respuesta">

							</div>
						</form>
						<div class="alert alert-primary" role="alert" name="alerttarea" hidden></div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	
	
	
	<script src="<?php echo $absolute_include ?>login/js/jquery.min.js"></script>  
       <script>
		$('.form-control').each(function () {
			floatedLabel($(this));
		});

		$('.form-control').on('input', function () {
			floatedLabel($(this));
		});

		function floatedLabel(input) {
			var $field = input.closest('.form-group');
			if (input.val()) {
				$field.addClass('input-not-empty');
			} else {
				$field.removeClass('input-not-empty');
			}
		}
	</script> 
 
<script src="<?php echo $absolute_include ?>login/regis.js"></script>


</body>

</html>