<?php
/**
 * This is a demo script for the functions of the PHP ESC/POS print driver,
 * Escpos.php.
 *
 * Most printers implement only a subset of the functionality of the driver, so
 * will not render this output correctly in all cases.
 *
 * @author Michael Billington <michael.billington@gmail.com>
 */
 header('Access-Control-Allow-Origin: *');
require "CodigoControl/GenerarQr.php";

require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\ImagickEscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;
use Mike42\Escpos\EscposImage;

// use Mike42\escpos\PrintConnectors\NetworkPrintConnector;
// $listaVenta=$GET['listaVenta'];
//  $literal=$_GET['literal'];
// $listaDVenta=$_GET['listaDVenta'];
// $listaEmpresa=$_GET['listaEmpresa'];
// $codigoqr=$_GET['codigoqu'];
// $fac=$_GET['fac'];
// $fechaHoy=$_GET['fechaHoy'];
// $nitCli=$_GET['nitCli'];
// $nombreCli=$_GET['nombreCli'];
// $cambioBs=$_GET['cambioBs'];

 $literal=$_POST['literal'];
$listaDVenta=$_POST['listaDVenta'];
$listaEmpresa=$_POST['listaEmpresa'];
$codigoqr=$_POST['codigoqu'];
$fac=$_POST['fac'];
$fechaHoy=$_POST['fechaHoy'];
$nitCli=$_POST['nitCli'];
$nombreCli=$_POST['nombreCli'];
$cambioBs=$_POST['cambioBs'];
$telefonoCli=$_POST['telefonoCli'];
$direccionCli=$_POST['direccionCli'];
$idVenta=$_POST['idVenta'];

$date2=date_create($listaDVenta[0]['F_VENTA']);
 $fechaImpresa=date_format($date2, 'd/m/Y');
$nitEmpresa=$listaEmpresa[0]['NITRUC'];
$numero_autorizacion = $listaEmpresa[0]['NROAUTORI'];
$numero_factura = $listaEmpresa[0]['FACACT'];
// $nit_cliente = $listaVenta[0]['NIT_CLI'];
$fecha_compra =$fechaImpresa;
$clave =$listaEmpresa[0]['LLAVE'] ;
$TOTAL=$_POST['totalBs'];
// for ($i=0; $i <count($listaDVenta) ; $i++) { 
//    $TOTAL+=floatval($listaDVenta[$i]['PRE_VENTA']*$listaDVenta[$i]['CANTIDAD']);
//     }
if ($nitCli=="") {
    $nombreCli=$nombreCli==""?"SIN NOMBRE":$nombreCli;
    $nitCli="0";
 } 
 else{
    $nombreCli=$nombreCli;
 }

$monto_compra =$TOTAL;
$genera=new FacturaController();
 $datosqr = "" . $nitEmpresa . "|" . $fac . "|" . $numero_autorizacion . "|" . $fecha_compra . "|" . $monto_compra . "|" . $monto_compra*0.13 . "|" . $codigoqr . "|" . $nitCli. "|" . "0" . "|" . "0" . "|" . "0" . "|" . "0"  ;

        $codigoqrImagen = $genera->generadorqr($datosqr);


try {
  $nombrePc= php_uname('n');
    $connector= new WindowsPrintConnector("smb://".$nombrePc."/caja");
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
	$printer -> setEmphasis(true);		
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> setTextSize(1,1);
$printer -> text($listaEmpresa[0]['NOMEMP']."\n");
$printer -> text($listaEmpresa[0]['SUCURSAL']."\n");
$printer -> text($listaEmpresa[0]['DIREMP']."\n");
$printer -> text("Telefono: ".$listaEmpresa[0]['TELEMP']."\n");
$printer -> text($listaEmpresa[0]['CIUPAI']."\n");
$printer -> text("---------------------------"."\n");
$printer->setEmphasis(false);
$printer -> text("FACTURA"."\n");
$printer -> text("ORIGINAL"."\n");
$printer->setEmphasis(false);
$printer -> text("NIT:".$listaEmpresa[0]['NITRUC']."\n");
$printer -> text("FACTURA:".$fac."\n");
$printer -> text("Autorización:".$listaEmpresa[0]['NROAUTORI']."\n");
$printer -> text("---------------------------"."\n");
$printer -> text("Fecha:".$fechaImpresa."\n");
$printer -> text("Señor(ES):".$nombreCli);
$printer -> feed(2);
$printer -> text("Nit:".$nitCli."\n");
$printer -> text("---------------------------"."\n");
$printer -> text("CAJERO:    ".$listaDVenta[0]['LOGIN'] ."\n");
$printer -> feed(1);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setTextSize(2,1);
$printer -> text("ORDEN:".$listaDVenta[0]['ORDEN'] );
$printer -> setJustification(Printer::JUSTIFY_RIGHT);
$printer -> text("      ".$listaDVenta[0]['SALIDA'] );
$printer -> setTextSize(1,1);
$printer -> feed(1);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("----------------------------------"."\n");
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("Cant.  Concepto                  p/u");
$printer -> setJustification(Printer::JUSTIFY_RIGHT);
$printer -> text("    Subtotal\n");

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("----------------------------------"."\n");
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(false);
// foreach (array(1, 2, 4, 8, 16, 32, 64, 128, 256, 512) as $margin) {
//     $printer->setPrintLeftMargin($margin);
//     $printer->text("left margin {$margin}");
// }


foreach ($listaDVenta as $key => $value) {
    // $nombrePro=$listaDVenta[0]['']NOM_PROD." dfdf dfdf d dfdf";
    // $nombrePro=$listaDVenta[0]['']NOM_PROD." dfdf saldaña modesto tito";
    $aux=0;
$cadena="";
$auxCadena="";
$restante="";
    $cantidad=$value['CANTIDAD'];
    $nombrePro=$value['NOM_PROD'];
    $totalNombre=strlen($nombrePro);
    $subtotal=number_format(floatval($value['AGRUPA1']), 2, '.', ' ');
    $printer->text($cantidad." ");
 
    if ($totalNombre>=26) {//aqui entra si es mayor a la cantidad de caracteres permitidos
        
        
    
     for ($i=0; $i <26 ; $i++) { //recorre lso 26 caracteres permitidos
        if ($nombrePro[$i]==" ") {//verifica si pilla un espacio y lo guarda en un auxiliar
            $aux=$i;
            $cadena.=" ";
            $auxCadena=$cadena;
        }else{
            $cadena.=$nombrePro[$i];
        }
         
     }
      $restante=26-$aux;
     for ($i=0; $i <$restante-1 ; $i++) {//recorre para ponerle el espacio siguiente que le falta 
         $auxCadena.=" ";
     }
         $printer->text($auxCadena);
    $printer->text(number_format(floatval($value['PRE_VENTA']), 2, '.', ' ')."      ");

    
    $printer->text( $subtotal."\n");
    $auxCadena="    ";
    for ($i=$aux; $i < $totalNombre; $i++) { 
        $auxCadena.=$nombrePro[$i];
    }
     $printer->text($auxCadena."\n");
        }
    else{
    $auxCadena=$nombrePro;
    $restante=26-$totalNombre;
    for ($i=0; $i <$restante ; $i++) {//recorre para ponerle el espacio siguiente que le falta 
         $auxCadena.=" ";
     }
    $printer->text($auxCadena);

    $printer->text(number_format(floatval($value['PRE_VENTA']), 2, '.', ' ')."      ");

    
    $printer->text($subtotal."\n");
    
}


   }
$printer -> setJustification(Printer::JUSTIFY_CENTER);

$printer->text("----------------------------------");
   $printer -> feed(1);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
   $printer->text("TOTAL                               ");
   $printer->setEmphasis(true);
   $printer->text(number_format(floatval($TOTAL), 2, '.', ' '));
   $printer -> feed(1);
   $printer->setEmphasis(false);

   $printer->text("Son: ".$literal);
   $printer -> feed(1);
   $printer->text("Cambio: ".number_format(floatval($cambioBs), 2, '.', ' '));
   $printer -> feed(1);
   $printer->text("    Código de Control: ");
   $printer->setEmphasis(true);
   $printer->text($codigoqr);
   $printer -> feed(1);
   $printer->setEmphasis(false);
   $date2=date_create($listaEmpresa[0]['FECHA_LIM']);
  $dateFormat=date_format($date2, 'd/m/Y');
   $printer->text("    Fecha límite de Emisión: ".$dateFormat);
   $printer -> feed(1);
   $printer->text("    Forma de Pago: ".$listaDVenta[0]['FAMILIA']);
   $printer -> feed(1);
   $tux = EscposImage::load($codigoqrImagen, false);
   // $printer->bitImage($tux);
   // $printer->setPrintWidth(256);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> graphics($tux);
$printer -> feed(1);

/* Name of shop */
// $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("ESTA FACTURA CONTRIBUYE AL
DESARROLLO DEL PAIS, EL USO
ILICITO DE ESTA SERA SANCIONADO
DE ACUERDO A LEY.\n");
// $printer->setPrintWidth(256);
   $printer -> text("Ley 453: Tienes derecho a recibir informacion
sobre las caracteristicas y contenidos delos
servicios que utilices.\n");
   if ( $telefonoCli!="" && $direccionCli!="") {
$printer -> feed(1);
     $printer -> text("Direccion: $direccionCli\n");
     $printer -> text("$nombreCli\n");
     $printer -> text("$telefonoCli\n");
   }
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
// $printer -> text("ABC");

// $printer -> text("DEF");
// $printer -> feedReverse(3);
// $printer -> text("GHI");
if ($listaDVenta[0]['FAMILIA']=="PREPAGO") {
 $printer -> setJustification(Printer::JUSTIFY_LEFT);

 $printer -> feed(1);
     $printer -> text("$idVenta\n");
 
}
$printer -> feed();

$printer -> cut();

$printer -> close();

echo "CONECTO CORRECTAMENTE";
foreach ($listaDVenta as $key => $value) {
  if ($value['AGRUPA3']!="") {
    $generar=$value['NOM_PROD']."||".$value['F_VENTA'];
    $codigoqrImagen =$genera->generadorqr($generar);
try {

  
 $nombrePc= php_uname('n');
    $connector= new WindowsPrintConnector("smb://".$nombrePc."/caja");
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */

  $printer -> setEmphasis(true);    
   $tux = EscposImage::load($codigoqrImagen, false);
   // $printer->bitImage($tux);
   // $printer->setPrintWidth(256);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> graphics($tux);

  $printer -> cut();
  /* Print a receipt end */
  
  /* Close printer */
  $printer -> close();

echo "CONECTO CORRECTAMENTE";
} catch (Exception $e) {
echo "NO CONECTO";
    
} 
  }
}
} catch (Exception $e) {
echo "NO CONECTO";
    
}


function imprimirCocPuntos($nombreProd){
$genera=new FacturaController();

}