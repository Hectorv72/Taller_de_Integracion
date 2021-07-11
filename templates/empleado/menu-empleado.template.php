<!--header-->
<?php include($absolute_include."templates/page/header.php") ?>
<head>

<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style type="text/css">

.page-title{
	text-align: center;
	color: black;
	font-family: Georgia, 'Times New Roman', Times, serif;
	

}
.titulo{
	text-align: center;
	color: white;
}
.main-panel{
	background-color: white;

}
.edicion{
	background: #1489cce3;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #2b32b2e5, #1488CC);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #2b32b2e8, #1488CC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}

</style>
</head>
<body>

	<div class="wrapper">

		<div class="main-header">

            
            <!--Navbar-->
            <?php include($absolute_include."templates/page/navbar.php") ?>

            <!--Sidebar-->
            <?php include($absolute_include."templates/page/sidebar.php") ?>


		<div class="main-panel">
				<div class="content">
					<div class="container-fluid ">
					
					<h1 class="page-title"><i class="fas fa-hand-holding-usd" style="color: gold;"></i> BANCO GRACIELA</h1>
					<img src="<?php echo $absolute_include ?>templates/empleado/imgempleados/empleado.jpg" alt="" class="w-100" >
					<br>
					<br>
					<br>
					<h2 class="page-title">BIENVENIDO <?php echo $session_nombre; ?> </h2>
					<img style="display:block;margin-left: auto;margin-right: auto;" src="<?php echo $absolute_include ?>templates/cliente/imgcliente/welcome.png" alt="" width="300" height="100"><br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<h5 class="titulo" style="color: black;font-family:Verdana, Geneva, Tahoma, sans-serif"> Servicios:</h5>
					<div class="edicion row">
                    <div class="col-5">
					
					<h5 class="titulo">Administra a los empleados</h5>
					<img style="display:block;margin-left: auto;margin-right: auto;" src="<?php echo $absolute_include ?>templates/empleado/imgempleados/facil.jpg" alt="" width="400" height="300"><br>
					</div>
					<div class="col-6 ">
					<h5 class="titulo">Todo es online </h5>
			        <img style="display:block;margin-left: auto;margin-right: auto;" src="<?php echo $absolute_include ?>templates/empleado/imgempleados/emple.jpg" alt="" width="400" height="200"><br>
					
					</div>
					
					
					</div>
					<br>
					<br>
					<br>
					</div>
					</div>
				
				

				<!--footer-->
                <?php include($absolute_include."templates/page/footer.php"); ?>
                
			</div>
	</div>
    
</body>

<!--end-->
<?php include($absolute_include."templates/page/end.php") ?>