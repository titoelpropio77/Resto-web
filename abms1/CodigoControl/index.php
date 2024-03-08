<?php 
require "GenerarQr.php";

$nitEmpresa="3212249011";
$numero_autorizacion = '383401700116009';
$numero_factura = '6';
$nit_cliente = '1983183';
$fecha_compra = '26/11/2017';
$monto_compra = '65';
$clave = '=8FHR[V*JZPjg23VtY$pYbtrD-6X-DI-DxLLT2uVRx*XZ)4BYLLiu@L\YX(R[2\E';
$genera=new FacturaController();
$codigoControl= $genera->generate('401401600000489', '76', '4793388', '20151202', '46202,30', '95_HZNXYMuiD7gIfKE-YA[34bD@B\U)V)t8n5X@LEUT5@$V9DtV\tP[7fPKCn6Su');
echo $codigoControl;

$datosqr = "" . $nitEmpresa . "|" . $numero_factura . "|" . $numero_autorizacion . "|" . $fecha_compra . "|" . $monto_compra . "|" . $monto_compra*0.13 . "|" . $codigoControl . "|" . $nit_cliente. "|" . "0" . "|" . "0" . "|" . "0" . "|" . "0"  ;
      echo  $codigoqr = $genera->generadorqr($datosqr);
 ?>