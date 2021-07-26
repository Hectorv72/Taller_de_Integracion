<?php

    Class Api extends ConexionDB{

        public $fecha_local;
        public $hora_local;
        
        
        function __construct(){
            //parent::__construct();
            //print "En el constructor SubClass\n";
            $this->fecha_local = $this->getFechaLocal();
            $this->hora_local  = $this->getHoraLocal();
        }
       
        
        public function getFechaLocal(){
            return date("Y-m-d");//
        }


        public function getHoraLocal(){
            return date("H:i:s");
        }


        public function getHoraAdicional($adicional){
            //ejemplo "+5 hours/minutes/seconds"
            return date("H:i:s",strtotime($adicional));
        }


        public function getFechaAdicional($adicional){
            //ejemplo "+5 days/months/years"
            return date("Y-m-d",strtotime($adicional));
        }


        public function jsonConvert($state,$content){
            return (["state" => $state, "content" => $content ]);
        }

        
    }

?>