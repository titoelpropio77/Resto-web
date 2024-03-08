<?php
Class Conexion {
      var $servername = "127.0.0.1";
   var $username = "root";
   var $password = "";
   var $dbname="lenny";
   public $conn;
   public $estado;
   public $mysqli;
   public function ConexionDB(){
         try {
          // $mysqli = new mysqli('localhost','posgourmet','root','posgourmet',3306);
            $this->conn = new mysqli('localhost','root','','lenny',3306);
             $this->conn->set_charset("utf8");
            // mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'",$mysqli);
             // var_dump($this->conn);
            if($this->conn->connect_errno){
                $this->estado= false;
                  
                return $this->estado;
            }else{
                $this->estado= true;
                return $this->estado;
            }
          
        }
        catch(PDOException $e)
        {
            $this->estado= false;
                return $this->estado;
        }
   }
 
   public function Conexion(){
      
      $this->mysqli = new mysqli('localhost','root','','lenny',3306);
        $this->mysqli->set_charset("utf8");
      if ( $this->mysqli->connect_errno){
         
         echo '<script> alert (" NO HAY CONEXION ");</script>';
         }
      if (!$this->mysqli->set_charset("utf8")) {
        printf("Error cargando el conjunto de caracteres utf8: %s\n", $this->mysqli->error);
        exit();
        } else {
            // printf("Conjunto de caracteres actual: %s\n", $mysqli->character_set_name());
        }

      return $this->mysqli;
   }
  public  function real_escape_string($valor){

 $ciudad = $this->conn->real_escape_string($valor);
return $ciudad;
 }
   public function comillas_inteligentes($valor) {
      // Retirar las barras
      if (get_magic_quotes_gpc()) {
         $valor = stripslashes($valor);
      }
      // Colocar comillas si no es entero
      if (!is_numeric($valor)) {
         $valor = "'" . $this->mysqli->real_escape_string($valor) . "'";
      }
      return $valor;
   }


   function transacion(){
       $this->conn->autocommit(false);
   }
   function manipular($query){
        if ($this->conn->query($query) === TRUE) {
            return true;
        } else {	
            return false;
        }
   }
   function consulta($sql){
        $result = $this->conn->query($sql);
        if (count($result) > 0) {
            return $result;
        } else {
            return null;
        }
   }
   function cerrarConexion(){
       try {
           $close = $conn->close();
       } catch (Exception $ex) {
           throw $ex;
       }
   }
   function commit(){
       $this->conn->commit();
   }
   function rollback(){
       $this->conn->rollback();
   }
   function closed(){
    
  mysqli_close($this->mysqli);
   }
}