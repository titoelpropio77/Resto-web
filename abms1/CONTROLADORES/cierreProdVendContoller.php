<?php 

include_once "../class/Conexion.php";
include_once "../class/DETALLES_MYSQL.class.php";
include_once "../class/VEN_GRAL_MYSQL.class.php";

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

switch ($proceso) {
	case 'listarVentaDadaFecha':

	$entrada=$_POST['entrada'];
	$vendedor=$_POST['cajero'];
			$fecha=$_POST['fecha'];

$detalle=new DETALLES_MYSQL($con);

$resultado=$detalle->listarDadaFecha($fecha,$entrada,$vendedor);	
		break;
	case 'listaFacturasCredito':
		$fecha=$_POST['fecha'];
		$cajero=$_POST['cajero'];
		$turno=$_POST['turno'];
		$detalle=NEW VEN_GRAL_MYSQL($con);
		$resultado=$detalle->listaFacturasCredito($fecha,$cajero,$turno);
	break;
	case 'listaFacturasAnuladas':
		$fecha=$_POST['fecha'];
		
		$detalle=NEW VEN_GRAL_MYSQL($con);
		$resultado=$detalle->listaFacturasAnuladas($fecha);
	break;
	case 'listarReporteCajaDada2Fechas':
		$fechaInicial=$_POST['fechaInicial'];
		$fechaFin=$_POST['fechaFinal'];

     $consulta='SELECT date_format(F_VENTA,"%d/%m/%Y") as F_VENTA,SUM(CASE WHEN ven_gral_mysql.ID <> ""  THEN ven_gral_mysql.TOTAL_FACT ELSE 0 END) AS FACTURADO,
 SUM(CASE WHEN ven_gral_mysql.FORMAPAGO = "CREDITO" AND ven_gral_mysql.ESTADO="ACTIVO" THEN ven_gral_mysql.TOTAL_FACT ELSE 0 END) AS CREDITO,
SUM(CASE WHEN ven_gral_mysql.FORMAPAGO = "CONSUMO" AND ven_gral_mysql.ESTADO="ACTIVO" THEN ven_gral_mysql.TOTAL_FACT ELSE 0 END) AS CONSUMO
,SUM(CASE WHEN ven_gral_mysql.ESTADO = "INACTIVO" THEN ven_gral_mysql.TOTAL_FACT ELSE 0 END) AS ANULADO,
SUM(CASE WHEN ven_gral_mysql.FORMAPAGO = "CONTADO" AND ven_gral_mysql.ESTADO="ACTIVO" THEN ven_gral_mysql.TOTAL_FACT ELSE 0 END) AS CONTADO,
(CASE WHEN 
  (SELECT sum(monto) AS MONTO from gastos_mysql where gastos_mysql.ESTADO="ACTIVO" And gastos_mysql.FECHAGASTO=ven_gral_mysql.F_VENTA  and gastos_mysql.TIPOTRANSACCION=0)  <> "" THEN
(SELECT sum(monto) AS MONTO from gastos_mysql where gastos_mysql.ESTADO="ACTIVO" And gastos_mysql.FECHAGASTO=ven_gral_mysql.F_VENTA  and gastos_mysql.TIPOTRANSACCION=0) ELSE 0 END) AS GASTO,
(CASE WHEN 
  (SELECT sum(monto) AS MONTO from gastos_mysql where gastos_mysql.ESTADO="ACTIVO" And gastos_mysql.FECHAGASTO=ven_gral_mysql.F_VENTA  and gastos_mysql.TIPOTRANSACCION=1)  <> "" THEN
(SELECT sum(monto) AS MONTO from gastos_mysql where gastos_mysql.ESTADO="ACTIVO" And gastos_mysql.FECHAGASTO=ven_gral_mysql.F_VENTA  and gastos_mysql.TIPOTRANSACCION=1) ELSE 0 END) AS INGRESOS
FROM ven_gral_mysql where ven_gral_mysql.F_VENTA BETWEEN "'.$fechaInicial.'" and "'.$fechaFin.'" group by ven_gral_mysql.F_VENTA; ';

$result=$con->consulta($consulta);
     if (count($result)) {
      while($row =  $result->fetch_assoc()) {
        $facturado=$row["FACTURADO"] ==null?"0":$row["FACTURADO"];
        $credito=$row["CREDITO"] ==null?"0":$row["CREDITO"];
        $consumo=$row["CONSUMO"] ==null?"0":$row["CONSUMO"];
        $anulado=$row["ANULADO"] ==null?"0":$row["ANULADO"];
        $contado=$row["CONTADO"] ==null?"0":$row["CONTADO"];
        $gastos=$row["GASTO"] ==null?"0":$row["GASTO"];
        $ingreso=$row["INGRESOS"] ==null?"0":$row["INGRESOS"];
        $fecha=$row["F_VENTA"];
        $lista[]=array("facturado"=>$facturado,"credito"=>$credito,"consumo"=>$consumo,"anulado"=>$anulado,"contado"=>$contado,"gastos"=>$gastos,"ingreso"=>$ingreso,"fecha"=>$fecha);
      }
      $resultado=$lista;
  }
		break;
	case 'listarReporteProductos':
			 $fechaInicial=$_POST['fechaInicial'];
			$fechaFin=$_POST['fechaFinal'];
			$tipoPago=$_POST['tipoPago'];

			switch ($tipoPago) {
				case 'todos':
					$detalle=new DETALLES_MYSQL($con);
					$resultado=$detalle->todoDadaDosFecha($fechaInicial,$fechaFin);
					break;
				case 'contadocredito':
					$detalle=new DETALLES_MYSQL($con);
					$resultado=$detalle->contadoCreditoDadaDosFecha($fechaInicial,$fechaFin);
					break;
				case 'CONSUMO':
					$detalle=new DETALLES_MYSQL($con);
					$resultado=$detalle->formaPago($fechaInicial,$fechaFin,$tipoPago);
					break;
				case 'CREDITO':
					$detalle=new DETALLES_MYSQL($con);
					$resultado=$detalle->formaPago($fechaInicial,$fechaFin,$tipoPago);
					break;
				case 'CONTADO':
					$detalle=new DETALLES_MYSQL($con);
					$resultado=$detalle->formaPago($fechaInicial,$fechaFin,$tipoPago);
					break;
				default:
					# code...
					break;
			}
			break;	
		case 'listarReporteServicioDada2Fechas':
			$detalle=NEW DETALLES_MYSQL($con);
			$fechaInicial=$_POST['fechaInicial'];
			$fechaFinal=$_POST['fechaFinal'];
			$consulta="
select sum(detalles_mysql.CANTIDAD)as CANTIDAD,NOM_PROD,COD_PROD,(sum(detalles_mysql.CANTIDAD)*detalles_mysql.PRE_VENTA)AS SUBTOTAL,SUM(AGRUPA3)AS AGRUPA3,
SUM(CASE WHEN SUBSTRING(detalles_mysql.SALIDA,1,4) = 'MESA'  THEN detalles_mysql.CANTIDAD ELSE 0 END) AS MESA,
SUM(CASE WHEN SUBSTRING(detalles_mysql.SALIDA,1,4) = 'LLEV'  THEN detalles_mysql.CANTIDAD ELSE 0 END) AS LLEVAR,
SUM(CASE WHEN SUBSTRING(detalles_mysql.SALIDA,1,4) = 'AUTO'  THEN detalles_mysql.CANTIDAD ELSE 0 END) AS AUTO,
SUM(CASE WHEN SUBSTRING(detalles_mysql.SALIDA,1,4) = 'MOTO'  THEN detalles_mysql.CANTIDAD ELSE 0 END) AS MOTO
from detalles_mysql
WHERE detalles_mysql.F_VENTA  BETWEEN  '$fechaInicial'  and '$fechaFinal'  and detalles_mysql.ANULADO <>'S'  GROUP BY NOM_PROD";
$lista=array();
$result=$con->consulta($consulta);
     if (count($result)) {
      while($row =  $result->fetch_assoc()) {
        $CANTIDAD=$row["CANTIDAD"] ==null?"0":$row["CANTIDAD"];
        $NOM_PROD=$row["NOM_PROD"] ==null?"0":$row["NOM_PROD"];
        $SUBTOTAL=$row["SUBTOTAL"] ==null?"0":$row["SUBTOTAL"];
        $AGRUPA3=$row["AGRUPA3"] ==null?"0":$row["AGRUPA3"];
        $MESA=$row["MESA"] ==null?"0":$row["MESA"];
        $LLEVAR=$row["LLEVAR"] ==null?"0":$row["LLEVAR"];
        $AUTO=$row["AUTO"] ==null?"0":$row["AUTO"];
        $MOTO=$row["MOTO"] ==null?"0":$row["MOTO"];
        $lista[]=array("CANTIDAD"=>$CANTIDAD,"NOM_PROD"=>$NOM_PROD,"SUBTOTAL"=>$SUBTOTAL,"MESA"=>$MESA,"LLEVAR"=>$LLEVAR,"AUTO"=>$AUTO,"MOTO"=>$MOTO,"AGRUPA3"=>$AGRUPA3);
      }
      $resultado=$lista;
  }
$consulta="SELECT SUM(AGRUPA3)AS AGRUPA3 from detalles_mysql WHERE detalles_mysql.F_VENTA  BETWEEN  '$fechaInicial'  and '$fechaFinal' and detalles_mysql.ANULADO <>'S'";
$result=$con->consulta($consulta);
if (count($result)) {
      while($row =  $result->fetch_assoc()) {
        $AGRUPA3=$row["AGRUPA3"] ==null?"0":$row["AGRUPA3"];
      
      }
     
  }

  $consulta="select COUNt(SUBSTRING(SALIDA,1,4)) as CANTIDAD,SUBSTRING(SALIDA,1,4) AS SALIDA,sum(CANTIDAD*PRE_VENTA)AS SUBTOTAL
from detalles_mysql WHERE detalles_mysql.F_VENTA  BETWEEN  '$fechaInicial'  and '$fechaFinal' AND detalles_mysql.AGRUPA3='' and detalles_mysql.ANULADO <>'S' GROUP BY SUBSTRING(SALIDA,1,4) ";
 $result=$con->consulta($consulta);
 $lista=array();
  if (count($result)) {
      while($row =  $result->fetch_assoc()) {
        $CANTIDAD=$row["CANTIDAD"] ==null?"0":$row["CANTIDAD"];
        $SALIDA=$row["SALIDA"] ==null?"0":$row["SALIDA"];
        $SUBTOTAL=$row["SUBTOTAL"] ==null?"0":$row["SUBTOTAL"];
        if ($row["SALIDA"]=="MESA") {
        	$SUBTOTAL=$SUBTOTAL+$AGRUPA3;
        }
        
       
        $lista[]=array("CANTIDAD"=>$CANTIDAD,"SALIDA"=>$SALIDA,"SUBTOTAL"=>$SUBTOTAL);
      }
      $resultado2=$lista;
  }


			// $resultado=$detalle->listarReporteServicioDada2Fechas($fechaInicial,$fechaFinal);
		break;
	default:
		
		break;

case 'facturasEmitidas':
	$fechaInicial=$_POST['fechaInicial'];
	$fechaFinal=$_POST['fechaFinal'];
	 $consulta="select FACTURA as NROTRANSAC, FORTAX as FAC_NODEC, TOT_DES as FAC_SIDEC, ORDEN ,DATE_FORMAT(F_VENTA,'%Y/%m/%d')as F_VENTA, NIT_CLI, NOM_CLI, 
TOTAL_FACT, TOTAL_FACT*13/100 as DEBIDO, NROAUTORI ,CIFRADO, ESTADO, FORMAPAGO, LOGIN, ELIMINPOR, DHORAVEN
from ven_gral_mysql 
WHERE ven_gral_mysql.F_VENTA  BETWEEN  '$fechaInicial'  and '$fechaFinal'";
 $result=$con->consulta($consulta);
 $lista=array();
  if (count($result)) {
      while($row =  $result->fetch_assoc()) {
        $NROTRANSAC=$row["NROTRANSAC"] ==null?"0":$row["NROTRANSAC"];
        $FAC_NODEC=$row["FAC_NODEC"] ==null?"0":$row["FAC_NODEC"];
        $FAC_SIDEC=$row["FAC_SIDEC"] ==null?"0":$row["FAC_SIDEC"];
        $ORDEN=$row["ORDEN"] ==null?"0":$row["ORDEN"];
        $F_VENTA=$row["F_VENTA"] ==null?"":$row["F_VENTA"];
        $NIT_CLI=$row["NIT_CLI"] ==null?"0":$row["NIT_CLI"];
        $NOM_CLI=$row["NOM_CLI"] ==null?"0":$row["NOM_CLI"];
        $TOTAL_FACT=$row["TOTAL_FACT"] ==null?"":$row["TOTAL_FACT"];
        $DEBIDO=$row["DEBIDO"] ==null?"":$row["DEBIDO"];
        $NROAUTORI=$row["NROAUTORI"] ==null?"":$row["NROAUTORI"];
        $CIFRADO=$row["CIFRADO"] ==null?"":$row["CIFRADO"];
        $ESTADO=$row["ESTADO"] ==null?"":$row["ESTADO"];
        $LOGIN=$row["LOGIN"] ==null?"":$row["LOGIN"];
        $ELIMINPOR=$row["ELIMINPOR"] ==null?"":$row["ELIMINPOR"];
        $DHORAVEN=$row["DHORAVEN"] ==null?"":$row["DHORAVEN"];
        $FORMAPAGO=$row["FORMAPAGO"] ==null?"":$row["FORMAPAGO"];
        
        
       
        $lista[]=array("NROTRANSAC"=>$NROTRANSAC,"FAC_NODEC"=>$FAC_NODEC,"FAC_SIDEC"=>$FAC_SIDEC,"ORDEN"=>$ORDEN,"F_VENTA"=>$F_VENTA,
        	"NIT_CLI"=>$NIT_CLI,"NOM_CLI"=>$NOM_CLI,"TOTAL_FACT"=>$TOTAL_FACT,"DEBIDO"=>$DEBIDO,"NROAUTORI"=>$NROAUTORI,"CIFRADO"=>$CIFRADO,"ESTADO"=>$ESTADO,"LOGIN"=>$LOGIN,"ELIMINPOR"=>$ELIMINPOR,"DHORAVEN"=>$DHORAVEN,"FORMAPAGO"=>$FORMAPAGO);
      }
      $resultado=$lista;
  }

	break;
}

$reponse = array("error" => $error, "result" => $resultado,"result2"=>$resultado2);
echo  json_encode($reponse);
 ?>