<?php
    session_start();
    
    //include "../api/obtener-datos-api.php";
    include_once "../database/conexion.php";
    include_once "../api/class_api.php";
    include_once "../api/class_usuarios.php";
    include_once "../api/class_cajas.php";
    include_once "../api/class_consultas.php";
    include_once "../api/class_atenciones.php";

    //--------------GET---------------------\\
    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $get_url = $_GET['url'];
        $url = explode("/",$_GET['url']);
        //$api = new Api();


        switch ($get_url) {
            case 'consultas':
                //print_r(json_encode($api->getConsultas()));
            break;

            case 'consulta/horario':
                //print_r(json_encode($api->getConsultasHorario())); 
            break;

            case 'consulta/usuario/'.$url[2]:
                $iduser = $url[2];
                //echo $iduser;
                $obj_consultas = new Consultas();
                print_r(json_encode($obj_consultas->getUsuarioConsulta($iduser)));
            break;

            case 'consulta/turnos/'.$url[2]:
                echo $url[2];
                //print_r(json_encode($api->getTurnosAnteriores($url[1])));
            break;

            case 'cajas':
                $obj_cajas = new Cajas();
                print_r(json_encode($obj_cajas->getCajas()));
            break;
                
            default:
                print_r("nada");
            break;
        }

    }

    //--------------POST---------------------\\
    else if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $get_url = $_GET['url'];
        $url = explode("/",$get_url);
        //$api = new Api();

        $body = file_get_contents("php://input");
        $post = json_decode($body);

        switch ($get_url) {

            case 'actualizacion/turnos':
                $dato = $post->dato;
                print_r($api->consultarActualizacionTurnos($dato));
            break;

            case 'actualizacion/cliente':
                $obj_consultas = new Consultas();
                $id = $post->idconsulta;
                print_r($obj_consultas->consultarActualizacionCliente($id));
            break;

            case 'consulta/estado':
                $id     = $post->id;
                $estado = $post->estado;
                $nro_turno = $post->nroturno;
                //print_r($api->setEstadoConsulta($id,$estado,$nro_turno));
            break;

            case 'consulta/agregar':

                $obj_consultas = new Consultas();
                $descripcion = $post->descripcion;
                print_r(json_encode($obj_consultas->insertConsulta($descripcion)));
            break;
            
            case 'consulta/cancelar':

                $obj_consultas = new Consultas();
                $idcon = $post->consulta;
                print_r(json_encode($obj_consultas->deleteConsulta($idcon)));
            break;

            case 'caja/usar':
                $dato = $post->caja;
            
                //print_r($api->updateCaja($id,["estado" => '1'])));
            break;

            case 'usuario/login':
                $obj_usuarios = new Usuarios();
                $user = $post->user;
                $pass = $post->pass;
                print_r(json_encode($obj_usuarios->loginUsuario($user,$pass)));
            break;
            
            default:
                print_r(json_encode(["status"=>"error","message"=>"no existe esta instruccion"]));
            break;
        }
    }

?>