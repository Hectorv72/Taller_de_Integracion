<?php

//include_once "../database/class_api.php";
//include_once "../database/conexion.php";

class Usuarios extends Api{
    
    //Trae todas las consultas
    //-------------------------------------------------------------------------------------------------
   /*  public function getUsuarios($id,$array){

        $this->update_table($array,'cajas',"WHERE id_caja = $id ");
        
    } */

    //-------------------------------------------------------------------------------------------------

    //-------------------------------------------------------------------------------------------------
    public function hashPassword($pass){
        return hash('md5', $pass);
    }
    //-------------------------------------------------------------------------------------------------


    //-------------------------------------------------------------------------------------------------
    public function logoutUsuario(){
        unset($_SESSION['idusuario']);
        return $this->jsonConvert("correcto",["dir"=>"pagina-principal"]);
    }
    //-------------------------------------------------------------------------------------------------
    

    //-------------------------------------------------------------------------------------------------
    public function loginUsuario($user,$pass){

        if(trim($user) != ""){
            $usuario = $this->ejecutar_consulta("SELECT * FROM `usuarios` WHERE nombre_usuario = '$user' ","element");
            //$password = $this->hashPassword($pass);

            if($usuario != ""){
                if($usuario['password_usuario'] == $pass){

                    $_SESSION['idusuario'] = $usuario['id_usuario'];
                    return $this->jsonConvert("correcto",["dir"=>"cliente"]);
                }else{
                    return $this->jsonConvert("error",["message"=>"Contraseña incorrecta"]);
                }
            }else{
                return $this->jsonConvert("error",["message"=>"El usuario no existe"]);
            }
            
        }else{
            return $this->jsonConvert("error",["message"=>"Complete el formulario"]);
        }
        
        
        
    }
    //-------------------------------------------------------------------------------------------------
}

?>