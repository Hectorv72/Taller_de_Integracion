<?php

class Atenciones extends Api{
//Continacion de la clase api

 /*    public function getAtenciones(){

    } */


    
    //-------------------------------------------------------------------------------------------------
    private function getAtencionEmpleadoId($ss_idempleado = null){

        //$ss_idempleado = $_SESSION['idempleado'];
        $ss_nrocaja    = $_SESSION['nro_caja'];
        
        if($ss_idempleado == null){
            $ss_idempleado = $_SESSION['idempleado'];
        }

        $fecha = $this->fecha_local;

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

        return $id_atencion;

    }
    //-------------------------------------------------------------------------------------------------




    //-------------------------------------------------------------------------------------------------
    public function setAtencionConsulta($idconsulta,$estado,$nro_turno){

        $id_atencion = $this->getAtencionEmpleadoId();
        
        $array = [
            "id_atencion" => $id_atencion,
            "estado"      => $estado,
            "nro_turno"   => $nro_turno
        ];

        $this->insert_table($array,"detalle_atencion");

        $obj_consulta = new Consultas();

        $obj_consulta->deleteConsulta($idconsulta);

        unset($_SESSION['ultima_consulta']);

        $json = $this->jsonConvert("correcto",[ "message" => "Atencion registrada" ]);

        return $json;
    }
    //-------------------------------------------------------------------------------------------------
}
//Fin
?>