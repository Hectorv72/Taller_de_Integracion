<?php
    //Sesion
    //---------------------------------------------------------------------------------------------
    session_start();

    /* $session_nombre   = "UNNAMED";
    $session_nro_caja = 0;

    if(!isset($_SESSION['idusuario'])){
        header("location: pagina-principal");
    }

    if(!isset($_SESSION['idempleado'])){
        header("location: cliente");
    }
    

    if (isset($_SESSION['nombre'])){
        $session_nombre = $_SESSION['nombre'];
    }

    if (isset($_SESSION['nro_caja'])){
        $session_nro_caja = $_SESSION['nro_caja'];
    } */
    //---------------------------------------------------------------------------------------------



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


    $page = "";

    if (isset($_REQUEST['page'])){
        $page = $_REQUEST['page'];
    }

    if($page == "login"){
        $ruta = "templates/usuario/login.template.php";
        redirecionarPagina($ruta);
    }
    else if($page == "register"){
        $ruta = "templates/usuario/register.template.php";
        redirecionarPagina($ruta);
    }


    function redirecionarPagina($ruta){
        $absolute_include = $GLOBALS['absolute_include'];
        $carpeta_trabajo  = $GLOBALS['carpeta_trabajo'];
    
        include($absolute_include.$ruta);
    }

?>