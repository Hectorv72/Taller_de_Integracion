<?php
    session_start();
    
    include "../api/obtener-datos-api.php";

    //--------------GET---------------------\\
    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $url = explode("/",$_GET['url']);
        $api = new Api();

        switch($url[0]){

            case 'consultas':
                print_r(json_encode($api->getConsultas()));
            break;
            
            case 'consulta':
                print_r($api->getConsulta(date("Y-m-d"))); 
            break;

            case 'cajas-libre':
                print_r($api->getCajasLibre());
            break;

            case 'ocupar-caja':
                $dato = $url[1];
                print_r($api->setCajaLibre($dato));
            break;
            
            case 'detalle-consulta'://usuario-consulta
                if(count($url) == 2){
                    $iduser = $url[1];
                    print_r($api->getUsuarioConsulta($iduser));
                }
            break;

            case 'consultas-anteriores':
                if(count($url) == 2){
                    print_r($api->getTurnosAnteriores($url[1]));
                }
            break;

            case 'turnos':
                if(count($url)==1){
                    print_r($api->getTurnos());
                }
            break;

            case 'pedir-consulta':
                $descripcion = "probamndo desde get";
                print_r($api->pedirTurno($descripcion));
            break;
        }

    }

    //--------------POST---------------------\\
    else if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $url = explode("/",$_GET['url']);
        $api = new Api();

        $body = file_get_contents("php://input");
        $decode = json_decode($body);

        //Realiza una consulta al servidor sobre la actualizacion de datos
        if($url[0] == 'actualizacion'){
            try{
                if($url[1] == 'turnos'){
                    $dato = $decode->dato;
                    print_r($api->consultarActualizacionTurnos($dato));
                }
                else if($url[1] == 'cliente'){
                    $id = $decode->idconsulta;
                    print_r($api->consultarActualizacionCliente($id));
                }
            }catch(Exception $e){
                print_r("error");
            }
            
        }
        else if($url[0] == "estado-consulta"){
            $id     = $decode->id;
            $estado = $decode->estado;
            $nro_turno = $decode->nroturno;
            print_r($api->setEstadoConsulta($id,$estado,$nro_turno));
        }
        else if($url[0] == 'ocupar-caja'){
            $dato = $decode->caja;
            
            print_r($api->setCajaLibre($dato));
        }
        else if($url[0] == 'cancelar-consulta'){
            $idcon = $decode->consulta;
            
            print_r($api->deleteConsulta($idcon));
        }
        else if($url[0] == "pedir-consulta"){
            
            $descripcion = $decode->descripcion;
            
            print_r($api->pedirTurno($descripcion));
        }
    }

?>