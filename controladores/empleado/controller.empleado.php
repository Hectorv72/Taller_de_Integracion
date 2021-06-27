<?php
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


    $action = "";

    if (isset($_REQUEST['action'])){
        $action = $_REQUEST['action'];
    }

    if($action == "" or $action == "home"){
        pageHome();
    }else if($action == "atencion"){
        pageListData($_POST);
    }


    function pageHome(){
        $absolute_include = $GLOBALS['absolute_include'];
        $carpeta_trabajo  = $GLOBALS['carpeta_trabajo'];
        
        include($absolute_include."templates/empleado/menu-empleado.template.php");
    }

    function pageListData($post){
        $absolute_include = $GLOBALS['absolute_include'];
        $carpeta_trabajo  = $GLOBALS['carpeta_trabajo'];
        
        include($absolute_include."templates/empleado/atencion-empleado.template.php");
    }

?>