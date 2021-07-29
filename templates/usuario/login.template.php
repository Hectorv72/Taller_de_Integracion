<!--header-->
<?php include($absolute_include."templates/page/header.php") ?>

<body>

	<div class="container">
		<div class="row top-padding">
			<div class="col-lg-10 col-xl-9 mx-auto">
				<div class="card card-signin flex-row my-5">

					<div class="card-img-left d-none d-md-flex">
						<!-- Background image for card set in CSS! -->
						<div class="hover-background justify-content-center">
							<img src="<?php echo $absolute_include ?>resources/logo-white.png" width="200" class="img-fluid mx-auto d-block" alt="">	
							<h3 class=" text-center font-weight-bold">Banco Graciela</h3>
						</div>
					</div>

					<div class="card-body">
						<h5 class="card-title text-center text-uppercase text-success">Iniciar Sesion</h5>

						<!-- <form class="form-signin"> -->
						<div class="form-signin">

							<div class="form-label-group">
								<input type="text" id="input-username" class="form-control" placeholder="Username" required >
								<!-- data-toggle="tooltip" data-custom-class="text-danger" data-placement="right" title="El usuario debe contener al menos 6 caracteres y no debe superar los 15 caracteres" -->
								
								<label for="input-username">Usuario</label>
							</div>


							<div class="form-label-group">
								<input type="password" id="input-password" class="form-control" placeholder="Password">
								<!-- required data-toggle="tooltip" data-placement="right" title="La contraseña debe contener almenos 1 letra mayuscula, minuscula y numerica, debe contener almenos 6 caracteres y no debe superar los 15 caracteres" -->
								<label for="input-password">Contraseña</label>
							</div>

							<div class="">
								<div class="form-label-alert">
									<div id="alert-login" class="text-danger">
									</div>
								</div>
							</div>
							
							
							<button class="btn btn-lg btn-outline-success btn-block text-uppercase" type="submit" id="button-login">Iniciar sesion</button>
							
							<a class="d-block text-center mt-2 small" href="<?php echo $absolute_include ?>pagina-principal">Volver al inicio</a>
							<!-- <hr class="my-4"> -->

							<!--<button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign up with Google</button>
							<button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign up with Facebook</button> -->
						</div>
						<!-- </form> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid text-center">
		Proyecto Taller de Integracion - 2021</p>
	</div>
    
</body>
<script src="<?php echo $absolute_include ?>resources/js/user/login.js"></script>
<!--end-->
<?php include($absolute_include."templates/page/end.php") ?>