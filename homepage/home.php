<?php
    // seccion que permite resolver problemas de inclusion de archivos
    $carpeta_trabajo="";
    $seccion_trabajo="/homepage";

    if (strpos($_SERVER["PHP_SELF"] , $seccion_trabajo) >1 ) {
        $carpeta_trabajo=substr($_SERVER["PHP_SELF"],1, strpos($_SERVER["PHP_SELF"] , $seccion_trabajo)-1);  // saca la carpeta de trabajo del sistema
    }

  
    $absolute_include = str_repeat("../",substr_count($_SERVER["PHP_SELF"] , "/")-1).$carpeta_trabajo; //resuelve problemas de profundidad de carpetas

    

    if (!empty($carpeta_trabajo)) {
        $absolute_include = $absolute_include."/";
        $carpeta_trabajo = "/".$carpeta_trabajo;
    }
    // fin seccion
?>



<!DOCTYPE html>
<!--
	Bonativo by TEMPLATE STOCK
	templatestock.co @templatestock
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pagina principal</title>

        <!-- Bootstrap -->
        <link href="<?php echo $absolute_include ?>homepage/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $absolute_include ?>homepage/css/style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $absolute_include ?>homepage/css/flexslider.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $absolute_include ?>homepage/icons/css/ionicons.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $absolute_include ?>homepage/icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
       
        <!--revolution slider setting css-->
        <link href="<?php echo $absolute_include ?>homepage/rs-plugin/css/settings.css" rel="stylesheet">
        <link href="<?php echo $absolute_include ?>homepage/css/prettyPhoto.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body data-spy="scroll" data-target=".navbar" data-offset="80">


        <!-- Static navbar -->
        <nav class="navbar navbar-default navbar-fixed-top before-color">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand alo" href="index.html"><strong>Banco Graciela</strong></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right scroll-to">

                        <li class="active"><a href="#home">Home</a></li>
                        <li><a href="#services">Services</a></li>                  
                        <li><a href="#turnos">Turnos</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Usuario <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $absolute_include ?>pagina-principal/login">Login</a></li>
                                <li><a href="<?php echo $absolute_include ?>pagina-principal/register">Register</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>


        <div class="fullwidthbanner" id="home">
            <div class="tp-banner">
                <ul>
                    <!-- SLIDE 1 -->
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="1500">
                        <!-- MAIN IMAGE -->
                        <img src="<?php echo $absolute_include ?>homepage/images/bg-1.jpg" alt="desk" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->

                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption slider-title" data-x="center" data-y="center"  data-voffset="-30" data-speed="500" data-start="1200" data-easing="Power4.easeInOut">
                            <span>Bienvenido</span>
                        </div> <!-- /tp-caption -->

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption slider-caption" data-x="center" data-y="center" data-voffset="40" data-speed="500" data-start="1800" data-easing="Power4.easeInOut" data-captionhidden="on">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit aute irure
                        </div> <!-- /tp-caption -->

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption slider-button scroll-to" data-x="center" data-y="center" data-voffset="120" data-speed="500" data-start="2400" data-easing="Power4.easeInOut" data-captionhidden="on">
                            <a class="btn btn-white" href="#about">Registrarme</a>
                        </div> <!-- /tp-caption -->

                    </li>

                    <!-- SLIDE 2 -->
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="1500">
                        <!-- MAIN IMAGE -->
                        <img src="<?php echo $absolute_include ?>homepage/images/bg-3.jpg" alt="desk" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                        <!-- LAYERS -->
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption slider-title" data-x="center" data-y="center"  data-voffset="-30" data-speed="500" data-start="1200" data-easing="Power4.easeInOut">
                            Pide tu <span>turno</span> aqui
                        </div> <!-- /tp-caption -->

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption slider-caption" data-x="center" data-y="center" data-voffset="40" data-speed="500" data-start="1800" data-easing="Power4.easeInOut" data-captionhidden="on">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit aute irure
                        </div> <!-- /tp-caption -->

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption slider-button scroll-to" data-x="center" data-y="center" data-voffset="120" data-speed="500" data-start="2400" data-easing="Power4.easeInOut" data-captionhidden="on">
                            <a class="btn btn-white" href="#about">Iniciar Sesion</a>
                        </div> <!-- /tp-caption -->
                    </li>
                    <!-- SLIDE 3 -->
                   
                </ul>
            </div>
        </div><!--full width banner-->


        <section id="services" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text-center">
                        <div class="section-title">
                            <h1><span class="colored-text">¿Quienes somos?</span></h1> 
                            <span class="border-line"></span>
                            <p class="lead subtitle-caption">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque nostrum blanditiis aliquid quam voluptatem doloribus alias fuga, quisquam aperiam quibusdam mollitia laudantium debitis distinctio deleniti eos minus nihil atque praesentium? <span class="colored-text">Banco Graciela</span>?
                            </p>
                        </div>
                    </div>
                </div><!-- title row end-->
            </div>
        </section>



        <div class="funfacts parallax-1">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>

        

        <section id="services" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text-center">
                        <div class="section-title">
                            <h1><span class="colored-text">Nuestros Servicios</span></h1> 
                            <span class="border-line"></span>
                            <p class="lead subtitle-caption">
                                ¿Por que elegir <span class="colored-text">Banco Graciela</span>?
                            </p>
                        </div>
                    </div>
                </div><!-- title row end-->
                <div class="row">
                    <div class="col-sm-6 margin-bottom30">
                        <div class="feature-icon-wrap services-icons clearfix">
                            <div class="left-side-icon">
                                <i class="fas fa-calendar-check front-icon"></i>
                            </div>
                            <div class="features-text-right">
                                <h3>Pedir turnos</h3>                         
                                <p>
                                    Vivamus congue diam vitae tortor imperdiet congue. Nullam sagittis, tristique diam, ut ullamcorper tellus. Cras porttitor massa.
                                </p>
                            </div>
                        </div>
                    </div><!--services col-->
                    <div class="col-sm-6 margin-bottom30">
                        <div class="feature-icon-wrap services-icons clearfix">
                            <div class="left-side-icon">
                                <i class="fas fa-address-card front-icon"></i>
                            </div>
                            <div class="features-text-right">
                                <h3>Tarjeta</h3>                         
                                <p>
                                    Vivamus congue diam vitae tortor imperdiet congue. Nullam sagittis, tristique diam, ut ullamcorper tellus. Cras porttitor massa.
                                </p>
                            </div>
                        </div>
                    </div><!--services col-->
                </div><!--services row-->
                
            </div>
        </section><!--services section end-->





        <div class="funfacts parallax-1">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>


        <section id="turnos" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text-center">
                        <div class="section-title">
                            <h1>Turnos <span class="colored-text">Banco</span></h1> 
                            <span class="border-line"></span>
                            <p class="lead subtitle-caption">
                                Aqui puedes ver los <span class="colored-text">turnos</span> que estan siendo atentidos
                            </p>
                        </div>
                    </div>
                </div><!-- title row end-->

                <div class="row" id="secciones">

                </div><!--services row-->
            </div>
        </section><!--services section end-->
        

        <footer class="footer">
            <div class="container text-center">
                <!-- <span class="alo">Bonativo</span>
                <ul class="social list-inline">
                    <li><a href="#"><i class="icon icon-social-twitter"></i></a></li>
                    <li><a href="#"><i class="icon icon-social-facebook"></i></a></li>
                    <li><a href="#"><i class="icon icon-social-dribbble"></i></a></li>
                </ul> -->
                <span class="copyright">&copy; Proyecto Taller de Integracion - 2021 </span>
            </div>
        </footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo $absolute_include ?>homepage/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo $absolute_include ?>homepage/js/moderniz.min.js" type="text/javascript"></script>
        <script src="<?php echo $absolute_include ?>homepage/js/jquery.easing.1.3.js" type="text/javascript"></script>
        <!-- bootstrap js-->
        <script src="<?php echo $absolute_include ?>homepage/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="<?php echo $absolute_include ?>homepage/text/javascript" src="js/jquery.flexslider-min.js"></script>
        <script type="<?php echo $absolute_include ?>homepage/text/javascript" src="js/parallax.min.js"></script> 
        <script type="<?php echo $absolute_include ?>homepage/text/javascript" src="js/jquery.prettyPhoto.js"></script>	       
        <script type="<?php echo $absolute_include ?>homepage/text/javascript" src="js/jqBootstrapValidation.js"></script>
        <!--revolution slider scripts-->
        <script src="<?php echo $absolute_include ?>homepage/rs-plugin/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
        <script src="<?php echo $absolute_include ?>homepage/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>  
        <script src="<?php echo $absolute_include ?>homepage/js/template.js" type="text/javascript"></script>
        <script src="<?php echo $absolute_include ?>resources/js/listar_turnos.js" type="text/javascript"></script>

    </body>
</html>
