<?php 

include_once "../class/Conexion.php";
include_once "../class/RELPROGRU_MYSQL.class.php";

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
		$venta=new RELPROGRU_MYSQL($con);
        $con->transacion();
		
		$idProducto=$_POST['id'];
		$cantidad=$_POST['cantidad'];
		$unidad=$_POST['unidad'];
		$nombre=$_POST['nombre'];
		$factor=$_POST['dato'];
		$codigoGrupo=$_POST['dato2'];

		for ($i=0; $i <count($factor) ; $i++) { 
			$venta->contructor(0,$codigoGrupo[$i],$idProducto,$cantidad,$unidad,$factor[$i],$nombre,0,0,"");
			$insertar=$venta->insertar();
			if ($insertar ==0) {
				$error="error";
			}
		}
		if ($error != "") {
            $con->rollback();
        } else {
            $con->commit();
            
        }
		break;

	case 'modificarFactor':
			$con->transacion();

			$relprogru=new RELPROGRU_MYSQL($con);
			$factor=$_POST['factor'];
			$id=$_POST['id'];
			$modificar=$relprogru->modificar($id,$factor);
			if (!$modificar) {
				$error="error";
			}
			if ($error != "") {
            $con->rollback();
        } else {
            $con->commit();
            
        }
		break;

		case 'eliminarRelProGru':
				$id=$_POST['id'];
				$relprogru=new RELPROGRU_MYSQL($con);
				$relprogru->eliminar($id);
			break;
			case 'mostrarFactorGrupo':
					$relprogru=new RELPROGRU_MYSQL($con);
					$resultado=$relprogru->listarFactorGrupo();
				break;
		case 'mostrarFactorGrupoFecha':
					$fecha=$_POST['fecha'];
					$cajero=$_POST['cajero'];
					$turno=$_POST['turno'];
					$relprogru=new RELPROGRU_MYSQL($con);
					// $deTarjeta=$relprogru->listarFactorDeTarjeta($fecha);
					$resultado=$relprogru->listarFactorGrupoFecha($fecha,$cajero,$turno);
				break;
	case 'listarGrupoDada2Fechas':
		$fechaInicio=$_POST['fechaInicial'];
		$fechaFinal=$_POST['fechaFinal'];
		$relprogru=new RELPROGRU_MYSQL($con);
		$resultado=$relprogru->listarGrupoDada2Fechas($fechaInicio,$fechaFinal);
		break;
	case 'verProductosGrupo':
		$id=$_POST['id'];
		$relprogru=new RELPROGRU_MYSQL($con);
		$resultado=$relprogru->verProductosGrupo($id);
		break;
	case 'modificarGrupoPro':
		$con->transacion();
		$id=$_POST['id'];
		$nombre=$_POST['nombre'];
		$orden=$_POST['orden'];
		$relprogru=new RELPROGRU_MYSQL($con);
		$modificar=$relprogru->modificarGrupoPro($id,$nombre,$orden);
		if (!$modificar) {
				$error="error";
			}
			if ($error != "") {
            $con->rollback();
        } else {
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