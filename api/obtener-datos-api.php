<?php

    include_once "../database/conexion.php";

    Class Api extends ConexionDB{
        
        private function getDateNow(){
            return date("Y-m-d");//
        }

        private function getHourNow(){
            return date("H:i",strtotime("+5 minutes"));
        }

        private function getHour(){
            return date("H:i");
        }



        public function consultarActualizacionCliente($idcon){
            //$inicial = $this->ejecutar_consulta('SELECT SUM(nro_turno) as "suma" FROM `cajas`',"element");
            $consulta = $this->select_table_all(['consultas'],"WHERE id_consulta = $idcon ","rowcount");

            if ($consulta == 0){
                return json_encode(['actualizacion' => true]);
            }
            return json_encode(['actualizacion' => false]);
        }


        public function getClientes(){

            $fecha = $this->getDateNow() ;

            $clientes = $this->select_table_all(['consultas'],"WHERE fecha = '$fecha' ORDER BY nro_turno ASC",'array');
            
            //$json = array_values($clientes);
            
            $json = ["state" => "correcto", "content" => [ "clientes" => [] ] ];

            foreach ($clientes as $cliente){

                if($cliente['descripcion'] == null){
                    $cliente['descripcion'] = "";
                }

                array_push($json["content"]["clientes"],[
                    'id'          => $cliente['id_consulta'],
                    'turno'       => $cliente['nro_turno'],
                    //'categoria'   => $cliente['id_tipo_consulta'],
                    'descripcion' => $cliente['descripcion'],
                    'hora' => $cliente['hora']
                ]);
            }
            return json_encode($json);
        }


        public function getUsuarioConsulta($iduser){
            
            //$fecha = $this->getDateNow();

            $consulta = $this->select_table_all(['consultas'],"WHERE id_usuario = $iduser ","element");
            
            if ($consulta != ""){

                $date = date_create($consulta['fecha']);
                $isnow = $consulta['fecha'] == $this->getDateNow();
                $ahora = $consulta['hora'] == $this->getHour();

                $json = [ "state" => "correcto", "content" => [
                    'id'          => $consulta['id_consulta'],
                    //'tipo'        => $consulta['id_tipo_consulta'],
                    'descripcion' => $consulta['descripcion'],
                    'fecha'       => date_format($date,"d-m-Y"),
                    'isnow'       => $isnow,
                    'isahora'     => $ahora,
                    'hora'        => $consulta['hora'],
                    'turno'       => $consulta['nro_turno'],
                ]];

                return json_encode($json);
            }
            else{
                return json_encode(["state" => "error" , "content" => [ "message" => "No realizo una consulta" ] ]);
            }
        }


        public function getTurnosAnteriores($nro_turno){
            $fecha = $this->getDateNow();
            $anteriores = $this->select_table_all(['consultas']," WHERE fecha = '$fecha' AND nro_turno < $nro_turno ","rowcount");
            
            $json = [ "state" => "correcto", "content" => [
                'turnos'       => $anteriores
            ]];

            return json_encode($json);
        }



        public function getConsulta($fecha){

            $consulta = "";

            if(isset($_SESSION['ultima_consulta'])){
                $idult = $_SESSION['ultima_consulta'];
                $consulta = $this->select_table_all(['consultas'],"WHERE id_consulta = $idult ","element");
            }
            
            $time = $this->getHour();
            $time = explode(":",$time);
            $hora = $time[0];
            
            if($consulta == ""){
                $consulta = $this->select_table_all(['consultas'],"WHERE fecha = '$fecha' AND estado = 0 AND hora LIKE '$hora%' ORDER BY nro_turno ASC ","element");
            }
            
            $id_caja = $_SESSION['nro_caja'];
            
            if ($consulta != ""){

                $date = date_create($consulta['fecha']);

                $json = [ "state" => "correcto", "content" => [
                    'id'          => $consulta['id_consulta'],
                    'descripcion' => $consulta['descripcion'],
                    'fecha'       => date_format($date,"d-m-Y"),
                    'turno'       => $consulta['nro_turno'],
                    'hora'        => $consulta['hora']
                ]];

                
                $id_consulta = $consulta['id_consulta'];
                
                $this->update_table(["nro_turno" => $consulta['nro_turno'], "habilitado" => "1" ],'cajas'," WHERE id_caja = $id_caja");

                $this->update_table(["estado" => "1" ],'consultas'," WHERE id_consulta = $id_consulta");

                $_SESSION['ultima_consulta'] = $id_consulta;

                return json_encode($json);
            }
            else{
                unset($_SESSION['ultima_consulta']);
                
                $this->update_table(["nro_turno" => 0 ],'cajas'," WHERE id_caja = $id_caja");

                return json_encode(["state" => "error" , "content" => [ "message" => "No hay consultas" ] ]);
            }
        }




        public function deleteConsulta($id){
            $this->delete_table('consultas',"WHERE id_consulta = $id");
            return json_encode(["state" => "correcto" , "content" => [ "message" => "Consulta eliminada" ] ]);
        }



        public function setEstadoConsulta($id,$estado,$nro_turno){

            $ss_idempleado = $_SESSION['idempleado'];
            $ss_nrocaja    = $_SESSION['nro_caja'];

            $fecha = $this->getDateNow();

            $atencion = $this->select_table_all(["atenciones"]," WHERE id_empleado = $ss_idempleado AND id_caja = $ss_nrocaja ","element");


            if($atencion == ""){

                $array = [
                    "fecha"       => $fecha,
                    "id_empleado" => $ss_idempleado,
                    "id_caja"     => $ss_nrocaja
                ];
                $id_atencion = $this->insert_table($array,"atenciones");

            }else{
                $id_atencion = $atencion["id_atencion"];
            }

            $array = [
                "id_atencion" => $id_atencion,
                "estado"      => $estado,
                "nro_turno"   => $nro_turno
            ];

            $this->insert_table($array,"detalle_atencion");

            $this->delete_table("consultas", " WHERE id_consulta = $id ");

            unset($_SESSION['ultima_consulta']);

            $json = [ "state" => "correcto", "content" => [ "message" => "Atencion registrada" ] ];

            return json_encode($json);
            //$consulta = $this->update_table();
        }




        //----------------------Turnos--------------------------------
        public function getTurnoCaja($caja){
            $turno = $this->select_table_all(['cajas'],"WHERE id_caja = $caja","element");
            $json = [ 
                "state" => "correcto" ,
                "content" => [ 'turno' => $turno['nro_turno'] ]
            ];
            return json_encode($json);
        }


        public function getTurnos(){
            $cajas = $this->select_table_all(['cajas'],"WHERE nro_turno != '0' ORDER BY id_caja ASC","array");

            $json = [ "state" => "correcto", "content" => [ "cajas" => [] ] ];

            foreach ($cajas as $caja){
                array_push($json["content"]["cajas"],[
                    'id'    => $caja['id_caja'],
                    'turno' => $caja['nro_turno']
                ]);
            }

            return json_encode($json);
        }

        public function getCajasLibre(){
            $cajas = $this->select_table_all(['cajas'],"WHERE habilitado = '0' ORDER BY id_caja ASC","array");

            $json = [ "state" => "correcto", "content" => [ "cajas" => [] ] ];
            
            if (count($cajas) > 0){
                
                foreach ($cajas as $caja){
                    array_push($json["content"]["cajas"],[
                        'id'    => $caja['id_caja']
                    ]);
                }
                return json_encode($json);
            }else{
                return json_encode(["state" => "error" , "content" => [ "message" => "No hay cajas disponibles" ] ]);
            }
        }


        public function setCajaLibre($id){
            $libre = $this->select_table_all(["cajas"]," WHERE id_caja = $id AND habilitado = 0","rowcount");

            if($libre > 0){
                $cajas = $this->update_table(["habilitado" => '1'],'cajas',"WHERE id_caja = $id AND habilitado = 0 ");
                $_SESSION['nro_caja'] = $id;
                return json_encode(["state" => "correcto" , "content" => [ "message" => "Caja seleccionada" ] ]);
            }else{
                return json_encode(["state" => "error" , "content" => [ "message" => "La caja esta ocupada" ] ]);
            }

            
        }



        public function pedirTurno($descripcion){

            $fecha = $this->getDateNow();

            if(isset($_SESSION['idusuario'])){
                $iduser = $_SESSION['idusuario'];
            }else{
                $iduser = null;
            }

            if($iduser != null){
                $consulta = $this->select_table_all(['consultas'],"WHERE id_consulta = $iduser ","rowcount");
            }

            if($consulta == 0 ){

                $ultconsulta = $this->select_table_all(['consultas']," ORDER BY id_consulta DESC LIMIT 1 ","element");

                

                if( $ultconsulta != ""){

                    $fechacon = $ultconsulta['fecha'];

                    //Numero de turno
                    $nro_turno = intval($ultconsulta['nro_turno'])+1;

                    //Fecha
                    $time = explode(":",$ultconsulta['hora']);

                    $minutos = intval($time[1])+15;
                    $horas = intval($time[0]);

                    if($minutos >= 60){
                        $minutos = $minutos - 60;
                        $horas = $horas+1;
                    }

                    if($horas >= 12 and $horas < 14){
                        $horas = 14;
                        $minutos = 0;
                    }
                    else if($horas >= 19){
                        
                        $fechacon = date("Y-m-d",strtotime($ultconsulta['fecha']."+ 1 days"));
                        $horas = 8;
                        $minutos = 0;
                    }


                    if( $horas < 10 ){
                        $horas = "0".$horas;
                    }

                    if ($minutos < 10 ){
                        $minutos = "0".$minutos;
                    }

                    $time = $horas.":".$minutos;
                }else{
                    $fechacon = $fecha;
                    $time  = $this->getHourNow();
                    $t = explode(":",$time);
                    $h = intval($t[0]);

                    if($h >= 12 and $h < 14){
                        $horas = 14;
                        $minutos = "00";
                        $time = $horas.":".$minutos;
                    }
                    else if($h >= 19){
                        
                        $fechacon = date("Y-m-d",strtotime($ultconsulta['fecha']."+ 1 days"));
                        $horas = "08";
                        $minutos = "00";
                        $time = $horas.":".$minutos;
                    }

                    $nro_turno = 1;
                }



                $array = [
                "id_usuario" => $iduser,
                "fecha" => $fechacon,
                "hora"  => $time,
                "descripcion" => $descripcion,
                "estado" => 0,
                "nro_turno" => $nro_turno
                ];

                $insid = $this->insert_table($array,'consultas');

                if($insid != 0){
                    return json_encode(["state" => "correcto" , "content" => [ "message" => "Consulta agregada" ]]);
                }else{
                    return json_encode(["state" => "error" , "content" => [ "message" => "Consulta no agregada" ] ]);
                }
            }else{
                return json_encode(["state" => "error" , "content" => [ "message" => "El usuario ya tiene una consulta" ] ]);
            }

            

        }


        public function consultarActualizacionTurnos($inicial){

            //$inicial = $this->ejecutar_consulta('SELECT SUM(nro_turno) as "suma" FROM `cajas`',"element");
            $nuevo = $this->ejecutar_consulta('SELECT SUM(nro_turno) as "suma" FROM `cajas`',"element");

            if (intval($inicial) != intval($nuevo['suma'])){
                return json_encode(['actualizacion' => true]);
            }
            return json_encode(['actualizacion' => false]);
            
        }

    }

?>