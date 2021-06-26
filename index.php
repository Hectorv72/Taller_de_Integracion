<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Notifications - Ready Bootstrap Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="design/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="design/assets/css/ready.css">
	<link rel="stylesheet" href="design/assets/css/demo.css">
</head>

<body>

	<div class="wrapper">

		<div class="main-header">

			<div class="logo-header">
				<a href="index.html" class="logo">
					Ready Dashboard
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			
            
            <!--Navbar-->
            <?php include("templates/page/navbar.html") ?>

            <!--Sidebar-->
            <?php include("templates/page/sidebar.html") ?>

			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Big tittle</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Card Tittle</div>
									</div>


									<div class="card-body">
                                        Card body
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


	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">									
					<p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
					<p>
					<b>We'll let you know when it's done</b></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

    
</body>
<script src="design/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="design/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="design/assets/js/core/popper.min.js"></script>
<script src="design/assets/js/core/bootstrap.min.js"></script>
<script src="design/assets/js/plugin/chartist/chartist.min.js"></script>
<script src="design/assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="design/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="design/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="design/assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="design/assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="design/assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="design/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="design/assets/js/ready.min.js"></script>
<script>
	$('#displayNotif').on('click', function(){
		var placementFrom = $('#notify_placement_from option:selected').val();
		var placementAlign = $('#notify_placement_align option:selected').val();
		var state = $('#notify_state option:selected').val();
		var style = $('#notify_style option:selected').val();
		var content = {};

		content.message = 'Turning standard Bootstrap alerts into "notify" like notifications';
		content.title = 'Bootstrap notify';
		if (style == "withicon") {
			content.icon = 'la la-bell';
		} else {
			content.icon = 'none';
		}
		content.url = 'index.html';
		content.target = '_blank';

		$.notify(content,{
			type: state,
			placement: {
				from: placementFrom,
				align: placementAlign
			},
			time: 1000,
		});
	});
</script>
</html>