<?php

session_start();
include_once "database/conexion.php";
include_once "api/class_api.php";
include_once "api/class_usuarios.php";
include_once "api/class_cajas.php";
include_once "api/class_consultas.php";
include_once "api/class_atenciones.php";

/* $w = new Cajas();
print_r($w->getCaja(3)); */

echo $_SESSION['nro_caja'];
/* $variable = "aaaabb";
$mas = "bb";

$array = ["aaa","bbb","bb"];

switch ($variable) {
    case 'aaaa'.$array[2]:
        echo $variable.$array[2];
        break;
    
    default:
        echo "naquehacer";
    break;
}
 */
//header("Location: pagina-principal");
	
?>

