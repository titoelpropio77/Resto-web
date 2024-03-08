<?php 

include_once "../class/Conexion.php";
include_once "../class/OPPRODUCTOS_MYSQL.class.php";

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
		$idProducto=$_POST['idProducto'];
		$nombreProd=$_POST['nombreProd'];
		$nombreSugerencia=$_POST['nombreSugerencia'];
		$estadoSugerencia=$_POST['estadoSugerencia'];
		$precioSugerencia=$_POST['precioSugerencia'];

		$opProducto=new OPPRODUCTOS_MYSQL($con);
		$opProducto->contructor(0,$idProducto,$nombreProd,$nombreSugerencia,$estadoSugerencia,$precioSugerencia);
		$insertar=$opProducto->insertar();
       
		if (!$insertar) {
		echo 	$error="error";
		}
		
		break;

	case 'modificarFactor':


		break;

		case 'listar':
		$id=$_POST['idProducto'];
		$opProducto=new OPPRODUCTOS_MYSQL($con);

		$resultado=$opProducto->listarDadaProd($id);		
			break;
	
	default:
		# code...
		break;
}

$reponse = array("error" => $error, "result" => $resultado);
echo  json_encode($reponse);
 ?>