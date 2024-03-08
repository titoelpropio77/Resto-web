<?php
// define('FPDF_FONTPATH','..\libphp\fpdf\font');
define('FPDF_FONTPAT', 'font/');
require('../libphp/fpdf/pdf_js.php');
require "../CodigoControl/GenerarQr.php";
    // echo '<img src="'..'" /><hr/>';  
// require('../libphp/fpdf/font/tahoma.php');
// require('..\libphp\fpdf\font\tahoma.php');
// require('../libphp/fpdf/html2pdf.php');

$con = new Conexion();
$conexion = $con->ConexionDB();
$idVenta=$_GET['idVenta'];
$literal=$_GET['literal'];
$venta=new VEN_GRAL_MYSQL($con);
$Dventa=new DETALLES_MYSQL($con);
$empresa=new EMPRESA_MYSQL($con);

$listaVenta=$venta->buscarXID($idVenta);
$listaDVenta=$Dventa->listarDadaVenta($idVenta);
$listaEmpresa=$empresa->obtenerUltimo();
$nombreCli="";
$TOTAL=0;

$nitEmpresa=$listaEmpresa[0]->NITRUC;
$numero_autorizacion = $listaEmpresa[0]->NROAUTORI;
$numero_factura = $listaEmpresa[0]->FACACT;
$nit_cliente = $listaVenta[0]->NIT_CLI;
$fecha_compra = $listaVenta[0]->F_VENTA;
for ($i=0; $i <count($listaDVenta) ; $i++) { 
   $TOTAL=number_format(($TOTAL+$listaDVenta[$i]->PRE_VENTA*$listaDVenta[$i]->CANTIDAD), 2, '.', ' ');
    }
if ($listaVenta[0]->NIT_CLI=="") {
    $nombreCli="SIN NOMBRE";
    $nit_cliente="0";
 } 
 else{
    $nombreCli=$listaVenta[0]->NOM_CLI;
 }
$monto_compra =$TOTAL;
$clave =$listaEmpresa[0]->LLAVE ;
$genera=new FacturaController();
$codigoControl= $genera->generate('401401600000489', '76', '4793388', '20151202', '46202,30', '95_HZNXYMuiD7gIfKE-YA[34bD@B\U)V)t8n5X@LEUT5@$V9DtV\tP[7fPKCn6Su');
  $codigoControl;

 $datosqr = $nitEmpresa . "|" . $numero_factura . "|" . $numero_autorizacion . "|" . $fecha_compra . "|" . $monto_compra . "|" . $monto_compra*0.13 . "|" . $codigoControl . "|" . $nit_cliente. "|" . "0" . "|" . "0" . "|" . "0" . "|" . "0"  ;
        $codigoqr = $genera->generadorqr($datosqr);

require __DIR__ . '/../../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\ImagickEscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;
use Mike42\Escpos\EscposImage;
try {
    // $connector= new WindowsPrintConnector("smb://ASUS/caja");
     // $connector = new WindowsPrintConnector("smb://Guest@DESKTOP-8NVPCL9/caja");
     // $connector = new WindowsPrintConnector("smb://Guest@LEO-PC/cocina");
    $connector= new WindowsPrintConnector("caja");
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
	$printer -> setEmphasis(true);		
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> setTextSize(1,1);
$printer -> text($listaEmpresa[0]->NOMEMP."\n");
$printer -> text($listaEmpresa[0]->SUCURSAL."\n");
$printer -> text($listaEmpresa[0]->DIREMP."\n");
$printer -> text("Telefono: ".$listaEmpresa[0]->TELEMP."\n");
$printer -> text($listaEmpresa[0]->CIUPAI."\n");
$printer -> text("---------------------------"."\n");
$printer->setEmphasis(false);
$printer -> text("FACTURA"."\n");
$printer -> text("ORIGINAL"."\n");
$printer->setEmphasis(false);
$printer -> text("NIT:".$listaEmpresa[0]->NITRUC."\n");
$printer -> text("FACTURA:".$listaEmpresa[0]->FACACT."\n");
$printer -> text("Autorización:".$listaEmpresa[0]->NROAUTORI."\n");
$printer -> text("---------------------------"."\n");
$printer -> text("Fecha:".$listaVenta[0]->F_VENTA."\n");
$printer -> text("Señor(ES):".$nombreCli);
$printer -> feed(2);
$printer -> text("Nit:".$listaVenta[0]->NIT_CLI."\n");
$printer -> text("---------------------------"."\n");
$printer -> text("CAJERO:    ".$listaVenta[0]->LOGIN ."\n");
$printer -> feed(1);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setTextSize(2,1);
$printer -> text("ORDEN:".$listaEmpresa[0]->FACACT );
$printer -> setJustification(Printer::JUSTIFY_RIGHT);
$printer -> text("          ".$listaVenta[0]->SALIDA );
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
    // $nombrePro=$listaDVenta[0]->NOM_PROD." dfdf dfdf d dfdf";
    // $nombrePro=$listaDVenta[0]->NOM_PROD." dfdf saldaña modesto tito";
    $aux=0;
$cadena="";
$auxCadena="";
$restante="";
    $cantidad=$value->CANTIDAD;
    $nombrePro=$value->NOM_PROD;
    $totalNombre=strlen($nombrePro);
    $subtotal=$listaDVenta[$i]->PRE_VENTA*$listaDVenta[$i]->CANTIDAD;
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
    $printer->text($value->PRE_VENTA."       ");

    
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

    $printer->text($value->PRE_VENTA."       ");

    
    $printer->text($subtotal."\n");
    
}


   }
$printer -> setJustification(Printer::JUSTIFY_CENTER);

$printer->text("----------------------------------");
   $printer -> feed(1);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
   $printer->text("TOTAL                               ");
   $printer->setEmphasis(true);
   $printer->text($TOTAL);
   $printer -> feed(1);
   $printer->setEmphasis(false);

   $printer->text("Son: ".$literal);
   $printer -> feed(1);
   $printer->text("Cambio: ".$listaVenta[0]->CAMBIO_BS);
   $printer -> feed(1);
   $printer->text("    Código de Control: ");
   $printer->setEmphasis(true);
   $printer->text($codigoControl);
   $printer -> feed(1);
   $printer->setEmphasis(false);

   $printer->text("    Fecha límite de Emisión: ".$listaEmpresa[0]->FECHA_LIM);
   $printer -> feed(1);
   $printer->text("    Forma de Pago: ".$listaEmpresa[0]->FECHA_LIM);
   $printer -> feed(1);
   $tux = EscposImage::load($codigoqr, false);
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
// for ($i = 0; $i < 2; $i++) {
//     $printer->setDoubleStrike($i == 1);
//     $printer->text("The quick brown fox jumps over the lazy dog\n");
// }
// $printer ->setPrintLeftMargin("5");
// $printer -> setTextSize(1,1);
// foreach (array(512, 256, 128, 64) as $width) {
//     $printer->setPrintWidth($width);
//     $printer->text("page width {$width}\n");
// }
// $printer -> feedReverse(10);

$printer -> feed();


$printer -> cut();
$printer -> close();
// $connector = new DummyPrintConnector();
// $printer = new Printer($connector);




// $data = $connector -> getData();
// echo $data;
// header('Content-type: application/octet-stream');
// header('Content-Length: '.strlen($data));

// $file = "temp.php";
// file_put_contents($file, $data);

// $printer -> close();
} catch (Exception $e) {

    $error="no conecto a la impresora";
$reponse = array("error" => $error  );
echo  json_encode($reponse);
    
}