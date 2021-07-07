<?php
    
    include "../api/obtener-datos-api.php";


    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $url = explode("/",$_GET['url']);
        $api = new Api();
        
        if($url[0] == 'clientes'){

            echo $api->getClientes();

        }
        else if($url[0] == 'turnos'){

            if(count($url)==2){
                
            }else{
                echo $api->getTurnos();
            }

        }
        else if($url[0] == 'actualizacion'){
            try{
                if($url[1] == 'turnos'){
                    echo $api->consultarActualizacionTurnos($url[2]);
                }
            }catch(Exception $e){
                header('location: ../../index.php');
            }
            
        }

    }
    else if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $url = explode("/",$_GET['url']);
        $api = new Api();
    }

?>