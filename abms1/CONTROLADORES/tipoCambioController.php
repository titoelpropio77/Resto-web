<?php 

include_once "../class/Conexion.php";
include_once "../class/USUARIOS_MYSQL.class.php";


$proceso=$_POST['proceso'];
$con= new Conexion();
$conexion= $con->ConexionDB();
$error = "";
$resultado = "";
session_start();


switch ($proceso) {
	case 'cambiarMoneda':
    	$login = trim($_POST['usuario']);
    	$password = trim($_POST['password']);
 		$usuario=new USUARIOS_MYSQL($con);
		$verificar=$usuario->verificarExitenciaNivel($login,$password,0);	
		if (count($verificar)>0) {
			$resultado="habilitado";
		}else{
			$resultado="nohabilitado";

		}
	default:
		
		break;
}

$reponse = array("error" => $error, "result" => $resultado);
echo  json_encode($reponse);
 ?>