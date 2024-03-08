<?php 

include_once "../class/Conexion.php";
include_once "../class/MESAS_MYSQL.class.php";

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
	case 'listarTodo':
		$mesas=new MESAS_MYSQL($con);
		$resultado=$mesas->todo();

		break;
	case 'mesaProcesando':
		$mesas=new MESAS_MYSQL($con);
		$idMesa=$_POST['idMesa'];
		$resultado=$mesas->mesaProcesando($idMesa);
		$_SESSION['idMesaProcesando']=$idMesa;
		
		break;
	case 'hablilitarMesaProcesando':
		$mesas=new MESAS_MYSQL($con);
		$idMesa=$_POST['idMesa'];
		$modificar=$mesas->hablilitarMesaProcesando($idMesa);
		if (!$modificar) {
			$error="ERROR";
		}
		break;
	case 'guardar':
		$nombreMesa=$_POST['nombreMesa'];
		$estado=$_POST['estadoMesa'];
		$orden=$_POST['orden']==""?0:$_POST['orden'];
		$con->transacion();
		$mesas=new MESAS_MYSQL($con);
		$mesas->contructor(0,$nombreMesa,$estado,"",$orden,"","","","",0,"");
		$insertar=$mesas->insertar();
		if ($insertar==0) {
			$error="<span style='font-weight: bold;'>* ERROR AL GUARDAR MESA.</span><br>";
		}
		if ($error!="") {
		$con->rollback();
			
		}else{
			$con->commit();
		}
		break;
    case 'modificar':

    	$id=$_POST['id'];
    	$nombreMesa=$_POST['nombreMesa'];
		$estado=$_POST['estadoMesa'];
		$orden=$_POST['orden']==""?0:$_POST['orden'];
		$con->transacion();
		$mesas=new MESAS_MYSQL($con);
		$mesas->contructor(0,$nombreMesa,$estado,"",$orden,"","","","",0,"");

		$modificar=$mesas->modificarMesa($id);
		if ($modificar==0) {
			$error="<span style='font-weight: bold;'>* ERROR AL MODIFICARDO MESA.</span><br>";
		}
		if ($error!="") {
		$con->rollback();
			
		}else{
			$con->commit();
		}
    	break;
    case 'buscarXID':
    	 $id=$_POST['id'];
		$mesas=new MESAS_MYSQL($con);
    	$resultado=$mesas->buscarXID($id);
    	break;
    case 'eliminarMesa':
    	 $id=$_POST['id'];
		$con->transacion();

		$mesas=new MESAS_MYSQL($con);
    	$eliminar=$mesas->eliminarMesa($id);
		if ($eliminar==0) {
			$error="<span style='font-weight: bold;'>* ERROR AL ELIMINAR MESA.</span><br>";
		}
		if ($error!="") {
		$con->rollback();
			
		}else{
			$con->commit();
		}
    	break;
    case 'modificarTodo':
    $ID=$_POST['ID'];
    $NRO_MESA=$_POST['NRO_MESA'];
    $ESTADO=$_POST['ESTADO'];
    $USO=$_POST['USO'];
    $ORDEN=$_POST['ORDEN']==""?0:$_POST['ORDEN'];
    $COLORES=$_POST['COLORES'];
    $PROCESANDO=$_POST['PROCESANDO'];
    $DELETEADO=$_POST['DELETEADO'];
    $NROPERSONA=$_POST['NROPERSONA'];
    $NROORDEN=$_POST['NROORDEN']==""?0:$_POST['NROORDEN'];
    $NOM_CLI=$_POST['NOM_CLI'];
    	
    for ($i=0; $i <count($ID) ; $i++) { 
		$mesas=new MESAS_MYSQL($con);
		$mesas->contructor(0,$NRO_MESA[$i],$ESTADO[$i],$USO[$i],$ORDEN[$i],$COLORES[$i],$PROCESANDO[$i],$DELETEADO[$i],$NROPERSONA[$i],$NROORDEN[$i],$NOM_CLI[$i]);

		$modificar=$mesas->modificarTodo($ID[$i]);
		if (!$modificar) {
			$error="<span style='font-weight: bold;'>* ERROR AL MODIFICARDO MESA.</span><br>";
			break;
		}

    }
   if ($error!="") {
		$con->rollback();
		break;
			
		}else{
			$con->commit();
		}
    	break;
	default:
		# code...
		break;
}

$reponse = array("error" => $error, "result" => $resultado);
echo  json_encode($reponse);
 ?>