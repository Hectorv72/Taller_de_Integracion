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
						<h4 class="page-title">Atencion al cliente</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Lista de clientes</div>
									</div>


									<div class="card-body">


                                        <table id="tabla-clientes" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <td>Turno</td>
                                                    <td>Descripcion</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>

                                        </table>
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
<script src="<?php echo $absolute_include ?>resources/js/listar_clientes.js"></script>

<!--end-->
<?php include($absolute_include."templates/page/end.php") ?>