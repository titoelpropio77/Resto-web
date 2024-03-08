<?php 

include_once "../class/Conexion.php";
include_once "../class/RELPROGRU_MYSQL.class.php";
include_once "../class/GRUPOS_MYSQL.class.php";

$proceso=$_POST['proceso'];
$con= new Conexion();
$conexion= $con->ConexionDB();
$error = "";
$resultado = "";
session_start();

if (!isset($_SESSION['usuario'])) {
    $error = "Error Session";
    $reponse = array("error" => $error, "result" => $resultado);
    echo json_encode($reponse);
    return;
}
if (!$conexion) {

	 $error = "No se pudo establecer conexion. Intente nuevamente.";
    $reponse = array("error" => $error, "result" => $resultado);
    // echo  json_encode($reponse);
    return;
}



switch ($proceso) {
	case 'guardar':

		break;
	case 'listarProductoGrupo':
	   $id=$_POST['id'];
	   $progru=new GRUPOS_MYSQL($con);
	   $lista=$progru->listarProductoGrupo($id);
	   if ($lista) {
	  $resultado=$lista;
	   }else{
	   	$resultado="";
	   }
		break;
		case 'listarRelProGrupo':
			$RELPROGRU_MYSQL=new RELPROGRU_MYSQL($con);
			// $RELPROGRU_MYSQL->
		break;
	default:
		# code...
		break;
}

$reponse = array("error" => $error, "result" => $resultado);
echo  json_encode($reponse);
 ?>