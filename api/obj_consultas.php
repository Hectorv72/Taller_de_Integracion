<?php
//Continacion de la clase api

    //Trae todas las consultas de la fecha
    //-------------------------------------------------------------------------------------------------
    public function getConsultas(){

        $fecha = $this->fecha_local;

        $consultas = $this->select_table_all(['consultas'],"WHERE fecha = '$fecha' ORDER BY nro_turno ASC",'array');

        if( count($consultas) > 0 ){
            $list = [];

            foreach ($clientes as $cliente){

                if($cliente['descripcion'] == null){
                    $cliente['descripcion'] = "";
                }

                array_push($list,[
                    'id'          => $cliente['id_consulta'],
                    'turno'       => $cliente['nro_turno'],
                    'descripcion' => $cliente['descripcion'],
                    'hora' => $cliente['hora']
                ]);
            }

            return $this->jsonConvert("correcto",["clientes" => $list]);
        }else{
            return $this->jsonConvert("error",["message" => "no hay consultas"]);
        }
    }
    //-------------------------------------------------------------------------------------------------




    //-------------------------------------------------------------------------------------------------
    public function updateConsulta($idconsulta,$array){

        $this->update_table($array,'consultas'," WHERE id_consulta = $idconsulta");

        return true;
    }
    //-------------------------------------------------------------------------------------------------



    
    //-------------------------------------------------------------------------------------------------
    public function deleteConsulta($id){
        $this->delete_table('consultas',"WHERE id_consulta = $id");
        return $this->jsonConvert("correct",[ "message" => "Consulta eliminada" ]);
    }
    //-------------------------------------------------------------------------------------------------




    //-------------------------------------------------------------------------------------------------
    public function getConsultasHorario(){

        $consulta = "";
        $fecha    = $this->fecha_local;
        $hora     = $this->hora_local;

        //Verifica si hay una consulta no atendida
        if(isset($_SESSION['ultima_consulta'])){
            $idult = $_SESSION['ultima_consulta'];
            $consulta = $this->select_table_all(['consultas'],"WHERE id_consulta = $idult ","element");
        }
        
        if($consulta == ""){
            $consulta = $this->select_table_all(['consultas'],"WHERE fecha = '$fecha' AND estado = 0 AND hora = '$hora' ORDER BY nro_turno ASC ","element");
        }
        
        //Trae el id de la caja que se asigno al seleccionar caja
        $id_caja = $_SESSION['nro_caja'];
        
        //Verifica si la consulta no devuelve un registro vacio
        if ($consulta != ""){

            $date = date_create($consulta['fecha']);

            $json = [
                'id'          => $consulta['id_consulta'],
                'descripcion' => $consulta['descripcion'],
                'fecha'       => date_format($date,"d-m-Y"),
                'turno'       => $consulta['nro_turno'],
                'hora'        => $consulta['hora']
            ];

            
            $id_consulta = $consulta['id_consulta'];
            
            $this->update_table(["nro_turno" => $consulta['nro_turno'], "habilitado" => "1" ],'cajas'," WHERE id_caja = $id_caja");


            $this->updateConsulta($id_consulta,[ "estado" => '1' ]);


            //Guarda el id de la consulta para un posterior uso
            $_SESSION['ultima_consulta'] = $id_consulta;


            return $this->jsonConvert("correcto",$json);
        }
        else{

            unset($_SESSION['ultima_consulta']);
            
            $this->update_table(["nro_turno" => 0 ],'cajas'," WHERE id_caja = $id_caja");

            return $this->jsonConvert("error",[ "message" => "No hay consultas" ]);
        }
    }
    //-------------------------------------------------------------------------------------------------
    



    //-------------------------------------------------------------------------------------------------
    public function getUsuarioConsulta($idusuario){

        $consulta = $this->select_table_all(['consultas'],"WHERE id_usuario = $iduser ","element");
            
        if ($consulta != ""){

            $date = date_create($consulta['fecha']);

            //$isnow = $consulta['fecha'] == $this->fecha_local;
            //$ahora = $consulta['hora']  == $this->hora_local;

            $json = [ "state" => "correcto", "content" => [
                'id'          => $consulta['id_consulta'],
                'descripcion' => $consulta['descripcion'],
                'fecha'       => date_format($date,"d-m-Y"),
                //'isnow'       => $isnow,
                //'isahora'     => $ahora,
                'hora'        => $consulta['hora'],
                'turno'       => $consulta['nro_turno'],
            ]];

            return $this->jsonConvert("correcto",$json);
        }
        else{
            return $this->jsonConvert("error",[ "message" => "No realizo una consulta" ]);
        }
    }
    //-------------------------------------------------------------------------------------------------




    //-------------------------------------------------------------------------------------------------
    public getConsultasAnteriores($nro_turno){
        
        $fecha = $this->getDateNow();

        $anteriores = $this->select_table_all(['consultas']," WHERE fecha = '$fecha' AND nro_turno < $nro_turno ","rowcount");
        
        return $this->jsonConvert("correcto",["turnos" => $anteriores]);
    }
    //-------------------------------------------------------------------------------------------------


//Fin
?>