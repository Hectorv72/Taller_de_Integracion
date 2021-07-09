<?php

    include_once "../database/conexion.php";

    Class Api extends ConexionDB{


        public function getClientes(){
            $clientes = $this->select_table_all(['consultas'],"ORDER BY nro_turno ASC",'array');
            
            //$json = array_values($clientes);
            
            $json = ["state" => "correcto", "content" => [ "clientes" => [] ] ];

            foreach ($clientes as $cliente){

                if($cliente['descripcion'] == null){
                    $cliente['descripcion'] = "";
                }

                array_push($json["content"]["clientes"],[
                    'id'          => $cliente['id_consulta'],
                    'turno'       => $cliente['nro_turno'],
                    'categoria'   => $cliente['id_tipo_consulta'],
                    'descripcion' => $cliente['descripcion']
                ]);
            }
            return json_encode($json);
        }


        public function getConsulta($fecha){
            
            $consulta = $this->select_table_all(['consultas'],"WHERE fecha = '$fecha' AND estado = 0 ORDER BY nro_turno ASC ","element");
            
            if ($consulta != ""){
                $date = date_create($consulta['fecha']);
                $json = [ "state" => "correcto", "content" => [
                    'id'          => $consulta['id_consulta'],
                    'descripcion' => $consulta['descripcion'],
                    'fecha'       => date_format($date,"d-m-Y"),
                    'turno'       => $consulta['nro_turno'],
                ]];
                return json_encode($json);
            }
            else{
                return json_encode(["state" => "error" , "content" => [ "message" => "No hay consultas" ] ]);
            }
        }

        public function setEstadoConsulta($id,$estado){
            $consulta = $this->update_table();
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
    
                return json_encode(["state" => "correcto" , "content" => [ "message" => "Caja seleccionada" ] ]);
            }else{
                return json_encode(["state" => "error" , "content" => [ "message" => "La caja esta ocupada" ] ]);
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