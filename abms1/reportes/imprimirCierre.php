<?php 
 header('Access-Control-Allow-Origin: *');
require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\ImagickEscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;
use Mike42\Escpos\EscposImage;
$proceso=$_POST['proceso'];
if ($proceso=="listaTOTALCAJACIERRE") {
	$listaTOTALCAJACIERRE=$_POST['listaTOTALCAJACIERRE'];
$empresa=$_POST['empresa'];
$turno=$_POST['turno'];
$fecha=$_POST['fecha'];
$login=$_POST['login'];
 reporteCaja($empresa,$listaTOTALCAJACIERRE,$turno,$login,$fecha);
}
if ($proceso=="listarItemElimDadaFecha") {
	$listaItemEli=$_POST['listaItemEli'];
	$turno=$_POST['turno'];
$fecha=$_POST['fecha'];
$login=$_POST['login'];
	reporteItemEli($listaItemEli,$turno,$login,$fecha);
}


function reporteCaja($empresa,$listaDVenta,$turno,$login,$fecha){
try {
     $nombrePc= php_uname('n');
    $connector= new WindowsPrintConnector("smb://".$nombrePc."/caja");
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */

  $printer -> setEmphasis(true);    
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> setTextSize(1,1);
$printer -> text($empresa[0]['NOMEMP']."\n");
$printer -> text($empresa[0]['SUCURSAL']."\n");
$printer -> text($empresa[0]['DIREMP']."\n");
$printer -> text("REPORTES DE CAJA\n");
$printer -> text("TURNO: ".$turno."\n");
$printer -> text("OPERADOR: ".$login."\n");
$printer -> text("FECHA: ".$fecha."\n");
$printer -> text("---------------------------\n");

  $printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer->text("TOTAL facturado:          ".$listaDVenta[0]['facturado']."\n");
$printer->text("TOTAL credito:            ".$listaDVenta[0]['credito']."\n");
$printer->text("TOTAL consumo interno:    ".$listaDVenta[0]['consumo']."\n");
$printer->text("TOTAL gastos:             ".$listaDVenta[0]['gastos']."\n");
$printer->text("TOTAL anulado:            ".$listaDVenta[0]['anulado']."\n");
$printer->text("TOTAL otros ingresos:     ".$listaDVenta[0]['ingreso']."\n\n");
$printer->text("SALDO EN CAJA:            ".$_POST['saldoCaja']."\n");
$printer->text("VENTA DEL DIA:            ". $_POST['vendaDia']."\n");

$printer->text("----------------------------------");

   

$printer -> feed();

$printer -> cut();

$printer -> close();

echo "CONECTO CORRECTAMENTE";
} catch (Exception $e) {
echo "NO CONECTO";
    
}
}

function reporteItemEli($listaItemEli,$turno,$login,$fecha){
try {
     $nombrePc= php_uname('n');
    $connector= new WindowsPrintConnector("smb://".$nombrePc."/caja");
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */

  $printer -> setEmphasis(true);    
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> setTextSize(1,1);
$printer -> text("CANTIDAD  PRODUCTO  SUBTOTAL\n");
$TOTAL=0;
foreach ($listaItemEli as $key => $value) {
$printer -> text($value['CANTIDAD']."     " .$value['NOM_PROD']. "    ".floatval($value['CANTIDAD']*$value['PRE_VENTA'])."\n");
$TOTAL+=floatval($value['CANTIDAD']*$value['PRE_VENTA']);
}
$printer -> text("---------------------------------\n");
$printer -> text("TOTAL:          ".$TOTAL."\n");

$printer -> feed();

$printer -> cut();

$printer -> close();

echo "CONECTO CORRECTAMENTE";
} catch (Exception $e) {
echo "NO CONECTO";
    
}
}