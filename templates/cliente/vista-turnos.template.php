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
						<h4 class="page-title">Turnos</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Lista de turnos (fecha)</div>
									</div>


									<div class="card-body">

                                        <div id="secciones">
                                            <div id="seccion 1">
                                                
                                                <strong>Caja 1</strong>
												<h5>Turno: 5</h5>
                                            </div>
                                        </div>
										<br>

										<div id="secciones">
                                            <div id="seccion 2">
                                                
                                                <strong>Caja 2</strong>
												<h5>Turno: 24</h5>
                                            </div>
                                        </div>
										<br>

										<div id="secciones">
                                            <div id="seccion 3">
                                                
                                                <strong>Caja 3</strong>
												<h5>Turno: 45</h5>
                                            </div>
                                        </div>
										<br>

										<div id="secciones">
                                            <div id="seccion 4">
                                                
                                                <strong>Caja 4</strong>
												<h5>Turno: 90</h5>
                                            </div>
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
<script src="../../script.js"></script>

<!--end-->
<?php include($absolute_include."templates/page/end.php") ?>