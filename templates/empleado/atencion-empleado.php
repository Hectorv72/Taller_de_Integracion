<!--header-->
<?php include("templates/page/header.html") ?>

<body>

	<div class="wrapper">

		<div class="main-header">

            
            <!--Navbar-->
            <?php include("templates/page/navbar.html") ?>

            <!--Sidebar-->
            <?php include("templates/page/sidebar.html") ?>


			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Atencion al cliente</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Lista de clientes (fecha)</div>
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


                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <td>Turno</td>
                                                    <td>dni</td>
                                                    <td>Usuario</td>
                                                    <td>Categoria</td>
                                                    <td>Acciones</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>45</td>
                                                    <td>44556677</td>
                                                    <td>Hector Valdez</td>
                                                    <td>Cambio de pin</td>
                                                    <!-- <td> <span class="badge badge-primary">Fixed</span> </td> -->
                                                    <td>
                                                        <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="button" class="btn btn-outline-primary btn-rounded">Atendido</button>
                                                            <button type="button" class="btn btn-outline-danger btn-rounded">Ausente</button>
                                                        </div>
                                                        
                                                        </div>
                                                    </td>
                                                </tr>
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
                <?php include("templates/page/footer.html"); ?>
                
			</div>
		</div>
	</div>
    
</body>

<!--end-->
<?php include("templates/page/end.html") ?>