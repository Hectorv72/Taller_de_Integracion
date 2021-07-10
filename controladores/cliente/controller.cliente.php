<?php
    session_start();


    $session_nombre    = "UNNAMED";

    if(!isset($_SESSION['idusuario'])){
        $_SESSION['idusuario'] = 1;
    }
    

    $session_idusuario = $_SESSION['idusuario'];

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
    $ruta = "";

    if (isset($_REQUEST['page'])){
        $page = $_REQUEST['page'];
    }

    if($page == "" or $page == "home"){
        $ruta = "templates/cliente/menu-cliente.template.php";
    }
    else if($page == "vista-turnos"){
        $ruta = "templates/cliente/vista-turnos.template.php";
    }
    else if($page == "turno"){
        $ruta = "templates/cliente/turno-cliente.template.php";
    }
    else{
        header("location: index.php");
    }

    $absolute_include = $GLOBALS['absolute_include'];
    $carpeta_trabajo  = $GLOBALS['carpeta_trabajo'];

    include($absolute_include.$ruta);

?>