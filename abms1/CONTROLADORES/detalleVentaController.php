<?php 

include_once "../class/Conexion.php";
include_once "../class/DETALLES_MYSQL.class.php";
include_once "../class/VEN_GRAL_MYSQL.class.php";
include_once "../class/DETTARJETA_MYSQL.class.php";
$proceso=$_POST['proceso'];
$con= new Conexion();
$conexion= $con->ConexionDB();
$error = "";
$resultado = "";
$resultado2 = "";
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

if ($proceso==="listarDadaVenta") {
	$id=$_POST['id'];
$detalle=new DETALLES_MYSQL($con);
$venta=new VEN_GRAL_MYSQL($con);
$resultado2=$venta->buscarXID($id);
$resultado=$detalle->listarDadaVenta($id);
}

$reponse = array("error" => $error, "result" => $resultado, "result2" => $resultado2);
echo  json_encode($reponse);
 ?>