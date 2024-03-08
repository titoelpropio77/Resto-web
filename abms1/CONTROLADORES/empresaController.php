<?php 

include_once "../class/Conexion.php";
include_once "../class/EMPRESA_MYSQL.class.php";
include_once "../class/CORRELATIVOS.class.php";

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
	case 'obtenerEmpresa':

$empresa=new EMPRESA_MYSQL($con);

$resultado=$empresa->obtenerUltimo();	
		break;
    case 'guardar':
    $nombreEmp=$_POST['nombreEmp'];
    $nombreSuc=$_POST['nombreSuc'];
    $telefono=$_POST['telefono'];
    $direccion=$_POST['direccion'];
    $paisCiudad=$_POST['paisCiudad'];
    $nit=$_POST['nit'];
    $numOrden=$_POST['numOrden'];
    $alfNum=$_POST['alfNum'];
    $InicioFactura=$_POST['InicioFactura'];
    $finFactura=$_POST['finFactura'];
    $facturaActual=$_POST['facturaActual'];
    $numAutorizacion=$_POST['numAutorizacion'];
    $fechaLimite=$_POST['fechaLimite'];
    $llave=$_POST['llave'];
    $turnoIni=$_POST['turnoIni'];
    $turnoFin=$_POST['turnoFin'];
    $fecha=$_POST['fecha'];
        $con->transacion();
        $correlativo = new CORRELATIVOS($con);
        $nombreTabla = "ven_gral_mysql";
        $listacorre = $correlativo->mostrarUltimo($nombreTabla);
        $modificarf = $correlativo->modificarFyFr($nombreTabla, $facturaActual,$facturaActual);
        if (!$modificarf) {
            $error="ERROR AL MOFIFICAR CORRELATIVO";
        }

$empresa=new EMPRESA_MYSQL($con);

$empresa->contructor(0,0,$nombreEmp,"",$paisCiudad,$nit,"","","Bs",$nombreSuc,$alfNum,$direccion,$InicioFactura,$finFactura,$facturaActual,$facturaActual,$telefono,'0',"",$fecha,'',$turnoIni,$turnoFin,'0','0','0','0','0','0','0','0','0','0','0',$llave,$numAutorizacion,$fechaLimite,'0','0','0','0','');
        $insertar=$empresa->insertar();
        if ($insertar==0) {
            $error="ERROR AL INSERTAR EMPRESA";
        }
        if ($error!="") {
            $con->rollback();
        }else{
            $con->commit();

        }
        break;
    case 'verificarDocificacion':
    $fecha=$_POST['fecha'];
$empresa=new EMPRESA_MYSQL($con);
$resulEmpresa=$empresa->obtenerUltimo();   
// $hoy=" $fechaactual[year]-$fechaactual[mon]-$fechaactual[mday]";
    // $datetime1 = date_create($resulEmpresa[0]->FECHA_LIM);
 //    $datetime2 = date_create($hoy);

$date1=date_create($fecha);
$fecha3=$resulEmpresa[0]->FECHA_LIM;
$date2=date_create($resulEmpresa[0]->FECHA_LIM);
$diff=date_diff($date1,$date2);

$dateFormat=date_format($date2, 'd/m/Y');
    // $interval = date_diff($date1, $date2);
$res=$diff->format('%R%a');
    if (intval($res)<=7 && intval($res)>0) {
        $resultado="LE QUEDAN $res DIAS PARA QUE SU DOCIFICACION SE VENZA, SE RECOMIENDA DOCIFICAR ANTES DE LA FECHA: $dateFormat";
    }
    if (intval($res)<0) {
         $resultado= "SU DOCIFICACION YA SE VENCIÓ, NO PODRÁ VENDER $fecha $res";
    }
        
        break;
	default:
		# code...
		break;
}

$reponse = array("error" => $error, "result" => $resultado);
echo  json_encode($reponse);
 ?>