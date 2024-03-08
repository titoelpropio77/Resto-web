<?php 

include_once "../class/Conexion.php";
include_once "../class/GASTOS_MYSQL.class.php";

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
	case 'listarEntregadoGAsto':

 $consulta='select * from gastos_mysql  GROUP by ENTREGADOA';
$result=$con->consulta($consulta);

$finalResult = array();
     if (count($result)) {
      while($row =  $result->fetch_assoc()) {
        $entregado=$row["ENTREGADOA"] ==null?"":$row["ENTREGADOA"];
     
      	
      		$a=array("label"=>$entregado);
       		array_push($finalResult,$a);	
      }
      $resultado=$finalResult;
}
    else{
          $finalResult="";
        }
		break;
		case 'listaroGastos':
			$fecha=$_POST['fecha'];
			$tipoTrasaccion=$_POST['tipoTrasanccion']=="INGRESO"?1:0;
			$gastos=new GASTOS_MYSQL($con);
			$resultado=$gastos->listarGastosFecha($fecha,$tipoTrasaccion);
			break;
	    case 'guardarGasto':
	    $con->transacion();
	    ini_set('date.timezone', 'America/La_Paz');
        $now = date('G:i');
	    $fecha=$_POST['fecha'];
	      $entregado=$_POST['entregado'];
    		$concepto=$_POST['concepto'];
    		$monto=$_POST['monto'];
    		$turno=$_POST['turno'];
    		$factura=$_POST['factura']==""?0:$_POST['factura'];
    		$tipoGasto=$_POST['tipoGasto']=="INGRESO"?1:0;//1=ingreso,0=egreso
			$gastos=new GASTOS_MYSQL($con);
		   $gastos->contructor(0,$fecha,$entregado,$concepto,$now,$_SESSION['usuario'],$_SESSION['camoff'],$monto,$turno,"ACTIVO",$tipoGasto,$factura,0);
		   $insertar=$gastos->insertar();
		   if ($insertar==0) {
		   	$error="ERROR AL INSERTAR GASTO";
		   }
		   if ($error!="") {
		   	$con->rollback();
		   }else{
		   	$con->commit();
		   }
			break;
	default:
		# code...
		break;
}
$con->closed();
$reponse = array("error" => $error, "result" => $resultado);
echo  json_encode($reponse);
 ?>