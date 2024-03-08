<?php 


include_once "../class/Conexion.php";
include_once "../class/RELPROINS_MYSQL.class.php";
include_once "../class/INSUMOS_MYSQL.class.php";

$con= new Conexion();
$conexion= $con->ConexionDB();

$resultado = "";
$error = "";
$proceso=$_POST['proceso'];
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
	case 'modificarCantidadInsumo':
		$insProd=new RELPROINS_MYSQL($con);
			$ID=$_POST['id'];
			$CANTIDAD=$_POST['cantidad'];
			$con->transacion();
			$modificar =$insProd->modificar($ID,$CANTIDAD);
			if (!$modificar) {
		$error='ERROR AL MODIFICAR DATOS';
	
		$con->rollback();
		}else{
			$resultado= "MODIFICADO CORRECTAMENTE";
			$con->commit();
	
		}

		
		break;
	case 'EliminarInsumoProducto':
		$insProd=new RELPROINS_MYSQL($con);
		$ID=$_POST['id'];
		$eliminar=$insProd->eliminar($ID);

		if (!$eliminar) {
			$con->rollback();
			$error='ERROR AL ELIMINAR DATOS';
		}else{
			$con->commit();
			$resultado= "ELIMINAR CORRECTAMENTE";
		}
				break;
     case 'listarInsumoProducto':
		$ID=$_POST['id'];

     		$insProd=new INSUMOS_MYSQL($con);
     		$resultado= $insProd->listar($ID);
     		if ($resultado) {
     			
     		}else{
     			$error="NO TIENE INSUMOS REGISTRADOS";
     		}
     	break;
     case 'guardarInsumoProducto':
     	guardarInsumoProducto();
     	break;
     case 'listarInsumoDadoProducto':
     	$idProducto=$_POST['idProducto'];
   		$insProd=new INSUMOS_MYSQL($con);
     	$resultado=$insProd->listarInsumoDadoProducto($idProducto);

     	break;

	default:
		# code...
		break;
}
//if (isset($_POST['btnGuardarInsumoProducto'])) {
function guardarInsumoProducto(){

$error = "";
$con= new Conexion();
$conexion= $con->ConexionDB();
$insProd=new RELPROINS_MYSQL($con);
$COD_INS=$_POST['insumo'];
$COD_PROD=$_POST['productoInsumo'];
$CANTIDAD=$_POST['cantidad'];
for ($i=0; $i <count($COD_INS) ; $i++) { 
	$insProd->contructor(0,$COD_PROD,$COD_INS[$i],$CANTIDAD[$i],'');
$insertar=$insProd->insertar();
if ($insertar===0) {
	$error='ERROR AL INSERTAR DATOS';
}


}
header('Location: ../productos.php');
if($error!=''){
	$error="error";
}else{
	$resultado="GUARDADO CORRECTAMENTE";
}

}




$reponse = array("error" => $error, "result" => $resultado);
echo  json_encode($reponse);
 /// esta funcion lista en el modal insumo producto
//if(isset($_POST['btnInsumoProducto'])){

