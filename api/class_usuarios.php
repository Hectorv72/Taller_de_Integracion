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
            $password = $this->hashPassword($pass);

            if($usuario != ""){
                if($usuario['password_usuario'] == $password){

                    $_SESSION['idusuario']         = $usuario['id_usuario'];
                    $_SESSION['nombre_usuario']    = $usuario['nombre_usuario'];
                    $_SESSION['nombre_y_apellido'] = $usuario['apellido_y_nombre'];
                    $id_usuario = $usuario['id_usuario'];

                    $empleado = $this->ejecutar_consulta("SELECT * FROM `empleados` WHERE id_usuario = '$id_usuario' ","element");

                    if($empleado != ""){
                        $_SESSION['idempleado'] = $empleado['id_empleado'];
                        return $this->jsonConvert("correcto",["dir"=>"empleado"]);
                    }else{
                        return $this->jsonConvert("correcto",["dir"=>"cliente"]);
                    }
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


    //-------------------------------------------------------------------------------------------------
    public function registerUsuario($array){

        if(preg_match("/^(?=\w*[a-z])\S{6,15}$/",$array["nombre_usuario"])){
            if(preg_match("/^([A-Za-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/",$array["email_usuario"])){
                if(preg_match("/^(?=\w*[a-z0-9])\S{6,15}$/",$array["password_usuario"])){

                    $user = $array['nombre_usuario'];
                    $email = $array['email_usuario'];
                    $con_user = $this->select_table_all(['usuarios']," WHERE nombre_usuario = '$user' ","rowcount");

                    if($con_user == 0){

                        $con_email = $this->select_table_all(['usuarios']," WHERE email_usuario = '$email' ","rowcount");

                        if($con_email == 0){

                            $array["password_usuario"] = $this->hashPassword($array["password_usuario"]);

                            $id = $this->insert_table($array,"usuarios");
                            if($id != 0){
                                return $this->jsonConvert("correcto",["message"=>"Tu usuario fue registrado, ahora inicia sesion"]); 
                            }else{
                                return $this->jsonConvert("error",["message"=>"Algo fallo al crear tu usuario, vuelve a intentarlo"]); 
                            }

                        }else{
                            return $this->jsonConvert("error",["message"=>"Un usuario ya existe con ese email"]); 
                        }
                    }else{
                        return $this->jsonConvert("error",["message"=>"El usuario ya existe"]);
                    }
                }
            }
        }

        return $this->jsonConvert("error",["message"=>"ocurrio un error, por favor intenta mas tarde"]);
    }
    //-------------------------------------------------------------------------------------------------
}

?>