<?php
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

$nombre=$_POST['nombre'];
$usu=$_POST['usu'];
$email=$_POST['email'];
$contra=$_POST['contra'];

//validar


if (empty($nombre )){

    echo json_encode("campo vacio");
    exit;
}else if (!preg_match_all("/^[a-zA-Z]+\s+[a-zA-Z]+\D/", $nombre)){

    echo json_encode('nombre invalido');
exit;

}
if (empty( $usu )){

    echo json_encode("campo vacio");
    exit;
}else if (!preg_match_all("/^[a-zA-Z0-9\_\-]{4,16}$/", $usu)){

    echo json_encode('usuario invalido');
exit;

}
if (empty( $email)){

    echo json_encode("campo vacio");
    exit;
}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    echo json_encode("correo incorrecto");
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

    $sql= "SELECT * FROM usuarios WHERE email='$email'";
    $verificar= $conn->query($sql)->rowCount();

if (($verificar) > 0) {
     echo json_encode("exisregis");
     exit;
}

    $sql="INSERT INTO `usuarios`(`apellido_y_nombre`,`nombre_usuario`,`email`,`usu_password`) VALUES ('$nombre','$usu','$email','$contra')";
    $conn->query($sql);
    echo json_encode("registrado");
} catch(PDOException $e){
    echo json_encode("error").$e->getMessage();  
    exit;      
}

//EMITIR MENSAJE
 

?>