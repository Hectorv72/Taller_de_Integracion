<?php
    session_start();
    
    include "../api/obtener-datos-api.php";

    //--------------GET---------------------\\
    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $url = explode("/",$_GET['url']);
        $api = new Api();
        
        //traer array de los clientes a atender
        if($url[0] == 'clientes'){

            print_r($api->getClientes());

        }
        //Trae los turnos que las cajas estan atendiendo
        else if($url[0] == 'turnos'){

            if(count($url)==1){
                print_r($api->getTurnos());
            }
        }
        //Trae una consulta libre para atender
        else if($url[0] == 'consulta'){
            
            print_r($api->getConsulta(date("Y-m-d",strtotime("-1 day")))); 
        }
        else if($url[0] == 'cajas-libre'){
            print_r($api->getCajasLibre());
        }
        else if($url[0] == 'ocupar-caja'){
            $dato = $url[1];
            print_r($api->setCajaLibre($dato));

        }
        else if($url[0] == 'reset-sesion'){
            $_SESSION['nro_caja'] = 0;
            unset($_SESSION['ultima_consulta']);
        }
        else if($url[0] == "detalle-consulta"){

            if(count($url) == 2){
                $iduser = $url[1];
                print_r($api->getUsuarioConsulta($iduser));
            }
            
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
            }catch(Exception $e){
                header('location: ../../index.php');
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
    }

?>