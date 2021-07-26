<?php 

	class ConexionDB{

		//-------------------------Atributos------------------------------------------
		public $db_conexion;
		public $user = "root";
		public $pass = "";
		public $host = "localhost";
		public $db = "taller_de_integracion";
		public $conexion;
		//----------------------------------------------------------------------------

		public function __construct($user="root", $pass="", $host="localhost", $db=null){
			$this->user = $user;
			$this->pass = $pass;
			$this->host	= $host;

			if($db != null){
				$this->db = $db;
			}
		}


		//-------------------------Metodos--------------------------------------------

		//Conecta a la bd
		//----------------------------------------------------------------------------
		public function encender_conexion(){

			$user = $this->user;
			$pass = $this->pass;
			$host = $this->host;
			$db	  = $this->db;

			try{

				$this->db_conexion = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);

			}catch(Exception $e){

				$this->db_conexion = $e->getMessage();
				exit;
			}

			if (!is_object($this->db_conexion)){
				// es un error no es un objeto database
				//echo $this->db_conexion;
				echo "<br> NO SE PUEDE CONECTAR A LA BASE DE DATOS";
				die();
			}

		}
		//----------------------------------------------------------------------------


		//Cierra la conexion
		//----------------------------------------------------------------------------
		public function cerrar_conexion(){//&$conexion
	
			$this->conexion = null;
			$this->db_conexion = null;
			return null;
		}
		//----------------------------------------------------------------------------
		

		//Retorna un valor dependiendo del parametro
		//----------------------------------------------------------------------------
		public function retornar_tipo($tipo_retorno){
			if($tipo_retorno == "array"){
				//Array de los elementos del registro
				$array = array();
				while($element = $this->conexion->fetch(PDO::FETCH_ASSOC)){
					$array[] = $element;
				}
				return $array;
			
			}else if($tipo_retorno == "element"){
				//Un unico elemento del registro
				return $this->conexion->fetch(PDO::FETCH_ASSOC);

			}else if($tipo_retorno == "rowcount"){
				//Cantidad de elementos en el registro
				return $this->conexion->rowcount();

			}
			return null;

		}
		//----------------------------------------------------------------------------


		//Ejecutar una consulta cualquiera
		//----------------------------------------------------------------------------
		public function ejecutar_consulta($sql,$retorno=null){
			//print_r($this->db_conexion);
			$this->encender_conexion();

			try{
				$this->conexion = $this->db_conexion->prepare($sql);

				$this->conexion->execute();

			}catch (PDOException $e) {
			
				print $e->getMessage();
			}
			
			$resultado = "";

			if($retorno != null){
				
				$resultado = $this->retornar_tipo($retorno);
				$this->cerrar_conexion();
				return $resultado;
			}

			$this->cerrar_conexion();
			return null;

		}
		//----------------------------------------------------------------------------
	

		//Realiza un insert con los parametros del array
		//----------------------------------------------------------------------------
		public function insert_table($array,$table){//$retorno=null

			$this->encender_conexion();

			$sql = "INSERT INTO `".$table."` (";

			$contador = 0;
			foreach($array as $key => $value){
				$sql = $sql."`$key`";
				$contador++;
				if( $contador != count($array) ){
					$sql = $sql.",";
				}
			}

			$sql = $sql.") VALUES (";

			$contador = 0;
			foreach($array as $key => $value){
				$sql = $sql."'$value'";
				$contador++;
				if( $contador != count($array) ){
					$sql = $sql.",";
				}
			}

			$sql = $sql.")";

			try{
				$this->conexion = $this->db_conexion->prepare($sql);

				$this->conexion->execute();

			}catch (PDOException $e) {
			
				print $e->getMessage();
			}

			//print_r($this->conexion);

			$id = $this->db_conexion->lastinsertid();

			$this->cerrar_conexion();
			
			return $id;

		}
		//----------------------------------------------------------------------------


		//Realiza un update con los parametros del array
		//----------------------------------------------------------------------------
		public function update_table($array,$table,$condition=null){//$retorno=null

			$this->encender_conexion();

			$sql = "UPDATE `$table` SET ";

			$contador = 0;
			foreach($array as $key => $value){
				$sql = $sql."`$key` = '$value'";
				$contador++;
				if( $contador != count($array) ){
					$sql = $sql.",";
				}
			}

			if($condition != null){
				$sql = $sql." $condition ";
			}


			try{
				$this->conexion = $this->db_conexion->prepare($sql);

				$this->conexion->execute();

			}catch (PDOException $e) {
			
				print $e->getMessage();
			}
			//$id = $this->db_conexion->lastinsertid();
			//print_r($this->conexion);

			$this->cerrar_conexion();

			return null;

		}
		//----------------------------------------------------------------------------


		//Realiza un delete con los parametros del array
		//----------------------------------------------------------------------------
		public function delete_table($table,$condition=null){//$retorno=null

			$this->encender_conexion();

			$sql = "DELETE FROM `$table` ";

			if($condition != null){
				$sql = $sql." $condition ";
			}

			try{
				$this->conexion = $this->db_conexion->prepare($sql);

				$this->conexion->execute();

			}catch (PDOException $e) {
			
				print $e->getMessage();
			}
			//$id = $this->db_conexion->lastinsertid();

			$this->cerrar_conexion();
			
			//return $id;
			return null;

		}
		//----------------------------------------------------------------------------


		//Devuelve todos los resultados de una consulta select
		//----------------------------------------------------------------------------
		public function select_table_all($tables,$condition=null,$retorno=null){
			//print_r($this->db_conexion);
			$this->encender_conexion();

			$sql = "SELECT * FROM ";

			//tablas a seleccionar
			$contador = 0;
			foreach($tables as $table){
				$sql = $sql."`$table`";
				$contador++;
				if( $contador != count($tables) ){
					$sql = $sql.", ";
				}
			}

			if($condition!=null){
				$sql = $sql." $condition ";
			}

			try{
				$this->conexion = $this->db_conexion->prepare($sql);

				$this->conexion->execute();

			}catch (PDOException $e) {
			
				print $e->getMessage();
			}

			if($retorno != null){
				$resultado = $this->retornar_tipo($retorno);
				$this->cerrar_conexion();
				return $resultado;
			}

			$this->cerrar_conexion();
			return null;

		}
		//----------------------------------------------------------------------------

		
		//Realiza un select con los parametros del array
		//----------------------------------------------------------------------------
		public function select_table($array,$tables,$condition=null,$retorno="null"){//,$array_order=null,$order="ASC"

			$this->encender_conexion();

			$sql = "SELECT ";

			//Columnas a seleccionar
			$contador = 0;
			foreach($array as $column){
				//$sql = $sql."`$column`";
				$sql = $sql.$column;
				$contador++;
				if( $contador != count($array) ){
					$sql = $sql.", ";
				}
			}

			$sql = $sql." FROM ";

			//tablas a seleccionar
			$contador = 0;
			foreach($tables as $table){
				$sql = $sql."`$table`";
				$contador++;
				if( $contador != count($tables) ){
					$sql = $sql.", ";
				}
			}


			if($condition != null){
				$sql = $sql." $condition";
			}


			/* //columnas de orden
			if($array_order != null){
				$sql = $sql." ORDER BY ";
				$contador = 0;
				foreach($array_order as $column){
					$sql = $sql."`$column`";
					$contador++;
					if( $contador != count($array_order) ){
						$sql = $sql.",";
					}
				}
				$sql = $sql." $order";
			} */


			try{
				$this->conexion = $this->db_conexion->prepare($sql);

				$this->conexion->execute();

				//print_r($this->conexion);

			}catch (PDOException $e) {
			
				print $e->getMessage();
			}
			//$id = $this->db_conexion->lastinsertid();
			//print_r($this->conexion);

			if($retorno != null){
				
				$resultado = $this->retornar_tipo($retorno);
				$this->cerrar_conexion();
				return $resultado;
			}

			$this->cerrar_conexion();
			
			//return $id;
			return null;

		}
		//----------------------------------------------------------------------------
		
	}

 ?>