<?php

    include_once "../database/conexion.php";

    Class Api extends ConexionDB{

        public function getClientes(){
            $clientes = $this->select_table_all(['consultas'],"ORDER BY nro_turno ASC",'array');
            
            //$json = array_values($clientes);
            
            $json = ["clientes" => [] ];

            foreach ($clientes as $cliente){

                if($cliente['descripcion'] == null){
                    $cliente['descripcion'] = "";
                }

                array_push($json["clientes"],[
                    'id'          => $cliente['id_consulta'],
                    'turno'       => $cliente['nro_turno'],
                    'categoria'   => $cliente['id_tipo_consulta'],
                    'descripcion' => $cliente['descripcion']
                ]);
            }
            return json_encode($json);
        }


        public function getTurnoCaja($caja){
            $turno = $this->select_table_all(['cajas'],"WHERE id_caja = $caja","element");
            $json = [
                'turno' => $turno['nro_turno']
            ];
            return json_encode($json);
        }


        public function getTurnos(){
            $cajas = $this->select_table_all(['cajas'],"ORDER BY id_caja ASC","array");

            $json = ["cajas" => [] ];

            foreach ($cajas as $caja){
                array_push($json["cajas"],[
                    'id'    => $caja['id_caja'],
                    'turno' => $caja['nro_turno']
                ]);
            }

            return json_encode($json);
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