<?php 

include_once "../class/Conexion.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// $proceso=$_GET['proceso'];
$con= new Conexion();
$conexion= $con->ConexionDB();
$error = "";
$resultado = "";
if (!$con->estado) {
    $error = "No se pudo establecer conexion. Intente nuevamente.";
    $reponse = array("error" => $error, "result" => $resultado);
    echo  json_encode($reponse);
    return;
}
if($_GET["action"]=="searchName"){
		$finalResult = array();
 $consulta = "SELECT ID,COD_CLI,NOM_CLI,NIT_CLI,CEL_CLI FROM clientes_mysql where NOM_CLI like '%".$_GET["term"]."%' limit 1000";
  $result=$con->consulta($consulta);
        if (count($result)) {
          $aux="";
      while($row =  $result->fetch_assoc()) {
         
            $nombre=$row["NOM_CLI"];
         
      		$a=array("id"=>$row["ID"],"label"=>$nombre." - ".$row["NIT_CLI"],"value"=>$row["NOM_CLI"], "number"=>$row["NIT_CLI"],"CEL_CLI"=>$row["CEL_CLI"]);
       		array_push($finalResult,$a);	
      }
}
	else{
          $finalResult="";
        }
     echo json_encode($finalResult);
}
if($_GET["action"]=="searchNit"){
    $finalResult = array();
 $consulta = "SELECT ID,COD_CLI,NOM_CLI,NIT_CLI,CEL_CLI FROM clientes_mysql where NIT_CLI like '%".$_GET["term"]."%' limit 1000";
  $result=$con->consulta($consulta);
        if (count($result)) {
      while($row =  $result->fetch_assoc()) {

          $a=array("id"=>$row["ID"],"label"=>$row["NIT_CLI"]."-".$row["NOM_CLI"],"value"=>$row["NIT_CLI"], "number"=>$row["NOM_CLI"],"CEL_CLI"=>$row["CEL_CLI"]);
          array_push($finalResult,$a);  
      }
}
  else{
          $finalResult="";
        }
    
    
    
 
     echo json_encode($finalResult);

}
if($_GET["action"]=="searchTel"){
    $finalResult = array();
 $consulta = "SELECT ID,COD_CLI,NOM_CLI,NIT_CLI,TEL_CLI,DIR_CLI FROM clientes_mysql where TEL_CLI like '%".$_GET["term"]."%' limit 1000";
  $result=$con->consulta($consulta);
        if (count($result)) {
      while($row =  $result->fetch_assoc()) {

          $a=array("id"=>$row["ID"],"label"=>$row["NOM_CLI"]."-".$row["TEL_CLI"],"nomCli"=>$row["NOM_CLI"],"value"=>$row["TEL_CLI"], "DIRECCION"=>$row["DIR_CLI"],"nitCli"=>$row["NIT_CLI"]);
          array_push($finalResult,$a);  
      }
}
  else{
          $finalResult="";
        }
    
    
    
 
     echo json_encode($finalResult);

}
if($_GET["action"]=="searchTelNombre"){
   $finalResult = array();
 $consulta = "SELECT ID,COD_CLI,NOM_CLI,NIT_CLI,TEL_CLI,DIR_CLI FROM clientes_mysql where NOM_CLI like '%".$_GET["term"]."%' limit 1000";
  $result=$con->consulta($consulta);
        if (count($result)) {
        
      while($row =  $result->fetch_assoc()) {
         
            $nombre=$row["NOM_CLI"];
         
          $a=array("id"=>$row["ID"],"label"=>$nombre,"nomCli"=>$row["NOM_CLI"],"TEL_CLI"=>$row["TEL_CLI"], "DIRECCION"=>$row["DIR_CLI"],"nitCli"=>$row["NIT_CLI"]);
          array_push($finalResult,$a); 
      }
}
  else{
          $finalResult="";
        }
     echo json_encode($finalResult);
   }
if($_GET["action"]=="searchTelNit"){
   $finalResult = array();
 $consulta = "SELECT ID,COD_CLI,NOM_CLI,NIT_CLI,TEL_CLI,DIR_CLI FROM clientes_mysql where NIT_CLI like '%".$_GET["term"]."%' limit 1000";
  $result=$con->consulta($consulta);
        if (count($result)) {
          $aux="";
      while($row =  $result->fetch_assoc()) {
         
            $nombre=$row["NOM_CLI"];
         
          $a=array("telefono"=>$row["TEL_CLI"],"label"=>$nombre." - ".$row["NIT_CLI"],"nomCli"=>$row["NOM_CLI"],"TEL_CLI"=>$row["TEL_CLI"], "DIRECCION"=>$row["DIR_CLI"],"value"=>$row["NIT_CLI"]);
          array_push($finalResult,$a); 
      }
}
  else{
          $finalResult="";
        }
     echo json_encode($finalResult);
   }
   if($_GET["action"]=="todo"){
   $finalResult = array();
 $consulta = "SELECT ID,COD_CLI,NOM_CLI,NIT_CLI,TEL_CLI,DIR_CLI FROM clientes_mysql ";
  $result=$con->consulta($consulta);
        if (count($result)) {
          $aux="";
      while($row =  $result->fetch_assoc()) {
         
            $nombre=$row["NOM_CLI"];
         
          $a=array("telefono"=>$row["TEL_CLI"],"label"=>$nombre." - ".$row["NIT_CLI"],"nomCli"=>$row["NOM_CLI"],"TEL_CLI"=>$row["TEL_CLI"], "DIRECCION"=>$row["DIR_CLI"],"value"=>$row["NIT_CLI"]);
          array_push($finalResult,$a); 
      }
}
  else{
          $finalResult="";
        }
     echo json_encode($finalResult);
   }
 ?>