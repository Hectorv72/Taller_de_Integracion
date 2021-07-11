<?php
    session_start();
    include_once "database/conexion.php";

    $bd = new ConexionDB();

    if(isset($_SESSION['idempleado'])){
        $idcaja = $_SESSION['nro_caja'];

        $cajas = $bd->update_table(["habilitado" => 0,'nro_turno' => 0],'cajas',"WHERE id_caja = $idcaja ");

    
        $idult = $_SESSION['ultima_consulta'];
        $bd->update_table(["estado" => 0],'consultas',"WHERE id_consulta = $idult ");
    }

    session_unset();

    header("Location: pagina-principal ")

?>