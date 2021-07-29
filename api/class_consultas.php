<?php
//Continacion de la clase api
class Consultas extends Api{

    //Trae todas las consultas de la fecha
    //-------------------------------------------------------------------------------------------------
    public function getConsultas(){

        $this->deleteConsultasViejas();

        $fecha = $this->fecha_local;

        $clientes = $this->select_table_all(['consultas'],"WHERE fecha = '$fecha' ORDER BY nro_turno ASC",'array');

        
        if( count($clientes) > 0 ){
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
    public function getConsulta($id){

        $fecha = $this->fecha_local;

        $consulta = $this->select_table_all(['consultas'],"WHERE id_consulta = $id ",'element');

        
        if( $consulta != "" ){
            
            if($consulta['descripcion'] == null){
                $consulta['descripcion'] = "";
            }

            $list = [
                'id'          => $consulta['id_consulta'],
                'turno'       => $consulta['nro_turno'],
                'descripcion' => $consulta['descripcion'],
                'hora' => $consulta['hora']
            ];
            

            return $this->jsonConvert("correcto",$list);
        }else{
            return $this->jsonConvert("error",["message" => "no hay consultas"]);
        }
    }
    //-------------------------------------------------------------------------------------------------




    
    
    
    //-------------------------------------------------------------------------------------------------
    public function updateConsulta($idconsulta,$array){
        
        $this->update_table($array,'consultas'," WHERE id_consulta = $idconsulta");

        return $this->jsonConvert("correcto",[ "message" => "Consulta actualizada" ]);
    }
    //-------------------------------------------------------------------------------------------------

    
    
    //-------------------------------------------------------------------------------------------------
    public function deleteConsulta($id){
        $this->delete_table('consultas',"WHERE id_consulta = $id");
        return $this->jsonConvert("correcto",[ "message" => "Consulta eliminada" ]);
    }
    //-------------------------------------------------------------------------------------------------



    //-------------------------------------------------------------------------------------------------
    public function deleteConsultasViejas(){

        $fecha = $this->fecha_local;
        $hora  = $this->hora_local;

        $this->delete_table('consultas',"WHERE fecha < '$fecha' OR (fecha = '$fecha' AND hora < '$hora' ) ");
        return true;
    }
    //-------------------------------------------------------------------------------------------------
    


    //-------------------------------------------------------------------------------------------------
    public function getConsultasHorario(){

        $consulta = "";
        $fecha    = $this->fecha_local;
        $hora     = $this->hora_local;
        $hora_max = $this->getHoraAdicional("+14 minutes");
        
        //Verifica si hay una consulta no atendida
        
        if(isset($_SESSION['ultima_consulta'])){
            $idult = $_SESSION['ultima_consulta'];
            $consulta = $this->select_table_all(['consultas'],"WHERE id_consulta = $idult ","element");
        }

        if($consulta == ""){
            $consulta = $this->select_table_all(['consultas'],"WHERE fecha = '$fecha' AND estado = 0 AND hora >= '$hora' AND hora < '$hora_max' ORDER BY nro_turno ASC ","element");
        }
        
        //Trae el id de la caja que se asigno al seleccionar caja
        if(isset($_SESSION['nro_caja'])){
            $id_caja = $_SESSION['nro_caja'];
        }else{
            return $this->jsonConvert("error",[ "message" => "Seleccione una caja" ]);
        }
        
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
            
            $this->update_table([ "nro_turno" => $consulta['nro_turno'] ],'cajas'," WHERE id_caja = $id_caja ");
            
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

        $consulta = $this->select_table_all(['consultas'],"WHERE id_usuario = '$idusuario' ","element");
            
        if ($consulta != ""){

            $date = date_create($consulta['fecha']);
            $horacon = explode(":",$consulta['hora']);
            $hora = $horacon[0].":".$horacon[1];

            //$isnow = $consulta['fecha'] == $this->fecha_local;
            //$ahora = $consulta['hora']  == $this->hora_local;

            $json = [
                'id'          => $consulta['id_consulta'],
                'descripcion' => $consulta['descripcion'],
                'fecha'       => date_format($date,"d-m-Y"),
                //'isnow'       => $isnow,
                //'isahora'     => $ahora,
                'hora'        => $hora,
                'turno'       => $consulta['nro_turno'],
                ];

            return $this->jsonConvert("correcto",$json);
        }
        else{
            return $this->jsonConvert("error",[ "message" => "No realizo una consulta" ]);
        }
    }
    //-------------------------------------------------------------------------------------------------




    //-------------------------------------------------------------------------------------------------
    public function getConsultasAnteriores($nro_turno){
        
        $fecha = $this->fecha_actual;

        $anteriores = $this->select_table_all(['consultas']," WHERE fecha = '$fecha' AND nro_turno < $nro_turno ","rowcount");
        
        return $this->jsonConvert("correcto",["turnos" => $anteriores]);
    }
    //-------------------------------------------------------------------------------------------------
    


    //-------------------------------------------------------------------------------------------------
    public function insertConsulta($descripcion){

        if(isset($_SESSION['idusuario'])){
            $iduser = $_SESSION['idusuario'];

            $consulta = $this->select_table_all(['consultas'],"WHERE id_consulta = $iduser ","rowcount");

            if($consulta == 0 ){

                $ultconsulta = $this->select_table_all(['consultas']," ORDER BY id_consulta DESC LIMIT 1 ","element");

                if( $ultconsulta != ""){

                    $fechacon = $ultconsulta['fecha'];

                    //Numero de turno
                    $nro_turno = intval($ultconsulta['nro_turno'])+1;

                    //Fecha
                    $horacon = $this->getHoraAdicional($ultconsulta['hora']."+15 minutes");
                    $time = explode(":",$horacon);

                    $time_local = explode(":",$this->hora_local);

                    /* if($time_local[0] == 23){
                        $fechacon = this->getFechaAdicional("+ 1 days");
                    } */
                    
                    if($time[0] < 8){
                        $horacon = '08:00:00';
                    }
                    /* else if($time[0] >= 12 and $time[0] < 14){
                        $horacon = '14:00:00';
                    } */
                    else if($time[0] >= 12){
                        
                        $fechacon = date("Y-m-d",strtotime($ultconsulta['fecha']."+ 1 days"));
                        $horacon = '08:00:00';
                    }

                }
                else{

                    $fechacon = $this->fecha_local;

                    $horacon  = $this->getHoraAdicional("+15 minutes");
                    $time = explode(":",$horacon);

                    $time_local = explode(":",$this->hora_local);

                    if($time_local[0] == 23){
                        $fechacon = $this->getFechaAdicional("+ 1 days");
                    }
                    
                    if($time[0] < 8){
                        $horacon = '08:00:00';
                    }
                    else if($time[0] >= 12){
                        
                        $fechacon = $this->getFechaAdicional("+ 1 days");
                        $horacon = '08:00:00';
                    }

                    $nro_turno = 1;
                }

                $array = [
                "id_usuario"  => $iduser,
                "fecha"       => $fechacon,
                "hora"        => $horacon,
                "descripcion" => $descripcion,
                "estado"      => 0,
                "nro_turno"   => $nro_turno
                ];

                $insid = $this->insert_table($array,'consultas');

                if($insid != 0){
                    return $this->jsonConvert("correcto",[ "message" => "Consulta agregada" ]);
                }else{
                    return $this->jsonConvert("error",[ "message" => "Consulta no agregada" ]);
                }

            }else{
                return $this->jsonConvert("error",[ "message" => "El usuario ya tiene una consulta" ]);
            }
        }
        return true;
    }
    //-------------------------------------------------------------------------------------------------
    
}
//Fin
?>