<?php
    //Sesion
    session_start();

    // seccion que permite resolver problemas de inclusion de archivos
    $carpeta_trabajo="";
    $seccion_trabajo="/controladores";

    if (strpos($_SERVER["PHP_SELF"] , $seccion_trabajo) >1 ) {
        $carpeta_trabajo=substr($_SERVER["PHP_SELF"],1, strpos($_SERVER["PHP_SELF"] , $seccion_trabajo)-1);  // saca la carpeta de trabajo del sistema
    }

  
    $absolute_include = str_repeat("../",substr_count($_SERVER["PHP_SELF"] , "/")-1).$carpeta_trabajo; //resuelve problemas de profundidad de carpetas

    

    if (!empty($carpeta_trabajo)) {
        $absolute_include = $absolute_include."/";
        $carpeta_trabajo = "/".$carpeta_trabajo;
    }
    // fin seccion


    //---------------------------------------------------------------------------------------------

    $session_nombre   = "UNNAMED";
    $session_nro_caja = 0;

    if(!isset($_SESSION['idempleado'])){
        header("location: ".$absolute_include."cliente");
    }

    if(!isset($_SESSION['idusuario'])){
        header("location: ".$absolute_include."pagina-principal");
    }
    

    if (isset($_SESSION['nombre'])){
        $session_nombre = $_SESSION['nombre'];
    }

    if (isset($_SESSION['nro_caja'])){
        $session_nro_caja = $_SESSION['nro_caja'];
    }
    //---------------------------------------------------------------------------------------------


    $page = "";
    $ruta = "";

    if (isset($_REQUEST['page'])){
        $page = $_REQUEST['page'];
    }


    if($page == "" or $page == "inicio"){
        $ruta = "templates/empleado/menu-empleado.template.php";
    }
    else if($page == "lista"){
        $ruta = "templates/empleado/lista-turnos.template.php";
    }
    else if($page == "turnos"){
        $ruta = "templates/cliente/vista-turnos.template.php";
    }
    else if($page == "atencion"){
        $ruta = "templates/empleado/atencion-empleado.template.php";
    }else{

    }

    $absolute_include = $GLOBALS['absolute_include'];
    $carpeta_trabajo  = $GLOBALS['carpeta_trabajo'];

    include($absolute_include.$ruta);

?>