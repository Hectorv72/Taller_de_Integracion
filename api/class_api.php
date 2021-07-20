<?php

    include_once "../database/conexion.php";

    Class Api extends ConexionDB{

        private $fecha_local;
        private $hora_local;
        
        
        __constructor(){
            $this->fecha_local = $this->getDateNow();
            $this->hora_local  = $this->getHourNow();
        }
       
        
        private function getFechaLocal(){
            return date("Y-m-d");//
        }


        private function getHoraLocal(){
            return date("H:i:s");
        }


        private function getHoraAdicional($adicional){
            //ejemplo "+5 hours/minutes/seconds"
            return date("H:i:s",strtotime($adicional));
        }


        private function getFechaAdicional($adicional){
            //ejemplo "+5 days/months/years"
            return date("Y-m-d",strtotime($adicional));
        }


        private function jsonConvert($state,$content){
            return ["state" => $state, "content" => $content ];
        }



        
    }

?>