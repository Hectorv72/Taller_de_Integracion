<!--header-->
<?php include($absolute_include."templates/page/header.php") ?>

<body>

	<div class="wrapper">

		<div class="main-header">

            
            <!--Navbar-->
            <?php include($absolute_include."templates/page/navbar.php") ?>

            <!--Sidebar-->
            <?php include($absolute_include."templates/page/sidebar-cliente.php") ?>


			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Mi turno</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div id="datos-consulta-head" class="card-title"></div>
									</div>


									<div class="card-body">
                                        <input type="hidden" id="usuario-id" value="<?php echo $session_idusuario ?>">
                                        <div id="datos-consulta-body">
                                            
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

				<!--footer-->
                <?php include($absolute_include."templates/page/footer.php"); ?>
                
			</div>
		</div>
	</div>
    
</body>
<script src="<?php echo $absolute_include ?>resources/sweetalert2/dist/sweetalert2.all.js"></script>
<script src="<?php echo $absolute_include ?>resources/js/mostrar-datos-consulta.js"></script>

<!--end-->
<?php include($absolute_include."templates/page/end.php") ?>