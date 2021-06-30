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
										<div class="card-title">Lista de clientes (fecha) - CAJA 1</div>
									</div>


									<div class="card-body">

                                        <form class="navbar-left navbar-form nav-search mr-md-3" action="">
                                            <div class="input-group">
                                                <input type="text" placeholder="Buscar usuario" class="form-control">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-search search-icon"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>


                                        <table id="tabla-clientes" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <td>Turno</td>
                                                    <td>Nombre</td>
                                                    <td>Categoria</td>
                                                    <td>Acciones</td>
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
<script src="../../script.js"></script>

<!--end-->
<?php include($absolute_include."templates/page/end.php") ?>