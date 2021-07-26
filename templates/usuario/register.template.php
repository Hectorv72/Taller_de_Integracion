<!--header-->
<?php include($absolute_include."templates/page/header.php") ?>

<body>

	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-xl-9 mx-auto">
				<div class="card card-signin flex-row my-5">

					<div class="card-img-left d-none d-md-flex">
						<!-- Background image for card set in CSS! -->
						<div class="hover-background"><h1>Banco Graciela</h1></div>
					</div>

					<div class="card-body">
						<h5 class="card-title text-center text-uppercase text-success">Registrarse</h5>
						<form class="form-signin">
							<div class="form-label-group">
								<input type="text" id="inputUserame" class="form-control" placeholder="Username" required autofocus>
								<label for="inputUserame">Usuario</label>
							</div>

							<div class="form-label-group">
								<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
								<label for="inputEmail">Email</label>
							</div>
							
							<hr>

							<div class="form-label-group">
								<input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

								<div class="form-label-alert">
									<div id="alert-password" class="text-danger">
										<i class="la la-exclamation-circle"></i>
										Verifique la contraseña
									</div>
								</div>

								<label for="inputPassword">Contraseña</label>
							</div>
							
							<div class="form-label-group">
								<input type="password" id="inputConfirmPassword" class="form-control" placeholder="Password" required>
								<label for="inputConfirmPassword">Confirmar contraseña</label>
							</div>

							<button class="btn btn-lg btn-outline-success btn-block text-uppercase" type="submit">Registrarme</button>
							<!-- <a class="d-block text-center mt-2 small" href="#">Sign In</a>
							<hr class="my-4">
							<button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign up with Google</button>
							<button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign up with Facebook</button> -->
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid text-center">
		Proyecto Taller de Integracion - 2021</p>
	</div>
    
</body>

<!--end-->
<?php include($absolute_include."templates/page/end.php") ?>