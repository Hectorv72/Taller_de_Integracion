<!--header-->
<?php include($absolute_include."templates/page/header.php") ?>

<body>

	<div class="container">
		<div class="row">
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
						<h5 class="card-title text-center text-uppercase text-success">Registrarse</h5>
						<div id="alert-general">
							
						</div>
						<div class="form-signin">

							<div class="form-label-group">
								<input type="text" id="input-nya" class="form-control" placeholder="Nombre y apellido" required autofocus>
								<label for="input-nya">Apellido y Nombre</label>

								<div class="form-label-alert">
									<div id="alert-nya" class="text-danger">
										<!-- <i class="la la-exclamation-circle"></i>
										Verifique la contraseña -->
									</div>
								</div>
							</div>

							<div class="form-label-group">
								<input type="text" id="input-user" class="form-control" placeholder="Username" required autofocus>
								<label for="input-user">Usuario</label>

								<div class="form-label-alert">
									<div id="alert-user" class="text-danger">
										<!-- <i class="la la-exclamation-circle"></i>
										Verifique la contraseña -->
									</div>
								</div>
							</div>

							<div class="form-label-group">
								<input type="email" id="input-email" class="form-control" placeholder="Email address" required>
								<label for="input-email">Email</label>

								<div class="form-label-alert">
									<div id="alert-email" class="text-danger">
										
									</div>
								</div>
							</div>
							
							<!-- <hr> -->

							<div class="form-label-group">
								<input type="password" id="input-password" class="form-control" placeholder="Password" required>

								<label for="input-password">Contraseña</label>
								
								<div class="form-label-alert">
									<div id="alert-password" class="text-danger">
										
									</div>
								</div>
							</div>
							
							<div class="form-label-group">
								<input type="password" id="input-confirm-password" class="form-control" placeholder="Password" required>
								<label for="input-confirm-password">Confirmar contraseña</label>

							</div>

							<button id="button-register" class="btn btn-lg btn-outline-success btn-block text-uppercase">Registrarme</button>
							<a class="d-block text-center mt-2 small" href="<?php echo $absolute_include ?>pagina-principal">Volver al inicio</a>
							<!-- <a class="d-block text-center mt-2 small" href="#">Sign In</a>
							<hr class="my-4">
							<button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign up with Google</button>
							<button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign up with Facebook</button> -->
						</d>
					</div>

				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid text-center">
		Proyecto Taller de Integracion - 2021</p>
	</div>
    
</body>

<script src="<?php echo $absolute_include; ?>resources/js/user/register.js "></script>

<!--end-->
<?php include($absolute_include."templates/page/end.php") ?>