<?php

class Cajas extends Api{
    //Trae todas las consultas de la fecha
    //-------------------------------------------------------------------------------------------------
    public function getCajas(){

        $cajas = $this->select_table_all(['cajas']," ORDER BY id_caja ASC ","array");

        $list = [];

        if(count($cajas)>0){
            foreach ($cajas as $caja){
                array_push($list,[
                    'id'    => $caja['id_caja'],
                    'turno' => $caja['nro_turno'],
                    'estado' => $caja['habilitado']
                ]);
            }
        }

        return $this->jsonConvert("correcto",[ "cajas" => $list ]);
        
    }
    //-------------------------------------------------------------------------------------------------

    //-------------------------------------------------------------------------------------------------
    public function getCaja($id){
        
        $caja = $this->select_table_all(['cajas'],"WHERE id_caja = $caja","element");
        $list = [
            'turno'  => $caja['nro_turno'],
            'estado' => $caja['habilitado']
        ];
        return $this->jsonConvert("correcto",$list);
    }
    //-------------------------------------------------------------------------------------------------

    //-------------------------------------------------------------------------------------------------
    public function updateCaja($id,$array){

        $this->update_table($array,'cajas',"WHERE id_caja = $id ");
        
    }
    //-------------------------------------------------------------------------------------------------

}
?>