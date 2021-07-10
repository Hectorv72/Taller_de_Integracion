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
					<h4 class="page-title">BIENVENIDO (<?php echo $session_nombre; ?>)</h4>
						<div class="card">
							<div class="card-body">a</div>
						</div>
					
					</div>
				</div>


				<!--footer-->
                <?php include($absolute_include."templates/page/footer.php"); ?>
                
			</div>
		</div>
	</div>
    
</body>

<!--end-->
<?php include($absolute_include."templates/page/end.php") ?>