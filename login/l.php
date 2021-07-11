<?php
session_start();
//coneccion

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taller_de_integracion";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username,$password
                   
                , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));        
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);      

} catch(PDOException $e){
    echo "La conexión falló: " . $e->getMessage();  
    exit;      
}



//capturamos los datos


$usu=$_POST['usu'];
$contra=$_POST['contra'];

//echo $contra;

//validar



if (empty( $usu )){

    echo json_encode("campo vacio");
    exit;
}else if (!preg_match_all("/^[a-zA-Z0-9\_\-]{4,16}$/", $usu)){

    echo json_encode('usuario invalido');
exit;

}
if (empty( $contra )){

    echo json_encode("campo vacio");
    exit;
}else if (!preg_match_all("/(\w){6,}$/", $contra)){

    echo json_encode('contraseña invalido');
exit;

}

try {

    $sql= "SELECT * FROM usuarios WHERE nombre_usuario='$usu' AND usu_password='$contra'";
    $query = $conn->query($sql);
    $datos = $query->fetch(PDO::FETCH_ASSOC);
    $ver = $query->rowCount();

if (($ver > 0)) {

    $idus = $datos['id_usuario'];

    $sql= "SELECT * FROM empleados WHERE id_usuario = $idus";
    $query = $conn->query($sql);

    $datosempleado = $query->fetch(PDO::FETCH_ASSOC);
    $isempleado = $query->rowCount();
    


     //echo json_encode("puede iniciar sesion");
     $_SESSION['idusuario'] = $datos['id_usuario'];
     $_SESSION['nombre'] = $datos['apellido_y_nombre'];

     if($isempleado > 0){
        $_SESSION['idempleado'] = $datosempleado['id_empleado'];
        $_SESSION['horario'] = $datosempleado['horario_salida'];
        echo json_encode('empleado');
     }else{
        echo json_encode('cliente');
     }

     
     //exit;
}else {
    echo json_encode("registro");
}
} catch(PDOException $e){
    echo json_encode("error").$e->getMessage();  
    exit;      
}

//EMITIR MENSAJE
 

?>