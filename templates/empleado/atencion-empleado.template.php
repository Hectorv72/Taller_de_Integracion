<!--header-->
<?php include($absolute_include."templates/page/header.php") ?>

<body>

	<div class="wrapper">

		<div class="main-header">

            
            <!--Navbar-->
            <?php include($absolute_include."templates/page/navbar.php") ?>

            <!--Sidebar-->
            <?php include($absolute_include."templates/page/sidebar.php") ?>


			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title text-center">Atencion al cliente</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
									<button data-toggle="modal" data-target="#modalManual" class="btn btn-outline-info justify-content-center"><i class="fas fa-info"></i></button>
										<div id="dato-turno" class="card-title h5 text-center"></div>
									</div>


									<div class="card-body">
										<input type="hidden" id="session_nro_caja" value="<?php echo $session_nro_caja ?>">

                                        
										<div id="datos-atencion">

										</div>
									</div>



									<!-- <div class="card-footer">
										<div class="form">
											<div class="form-group from-show-notify row">
												<div class="col-lg-3 col-md-3 col-sm-12">

												</div>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<button id="displayNotif" class="btn btn-success">Display</button>
												</div>
											</div>
										</div>
									</div> -->


								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Modal -->
				<div class="modal fade" id="modalManual" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Guía de usuario</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							En esta seccion deberas elegir una caja a la cual estaras atendiendo.
							<img class="img-fluid" src="<?php echo $absolute_include ?>resources/images/manual/atencion-cliente-1.png" alt="">
							<hr>

							Luego veras el turno que debes atender a la hora que tiene que llegar el cliente.
							<img class="img-fluid" src="<?php echo $absolute_include ?>resources/images/manual/atencion-cliente-2.png" alt="">
						</div>
					<!-- <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div> -->
					</div>
				</div>
				</div>

				<!--footer-->
                <?php include($absolute_include."templates/page/footer.php"); ?>
                
			</div>
		</div>
	</div>
    
</body>
<script src="<?php echo $absolute_include ?>resources/sweetalert2/dist/sweetalert2.all.js"></script>
<script src="../resources/js/datos_cliente.js"></script>

<!--end-->
<?php include($absolute_include."templates/page/end.php") ?>