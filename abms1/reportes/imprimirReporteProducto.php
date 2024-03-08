<?php
 header('Access-Control-Allow-Origin: *');
/**
 * This is a demo script for the functions of the PHP ESC/POS print driver,
 * Escpos.php.
 *
 * Most printers implement only a subset of the functionality of the driver, so
 * will not render this output correctly in all cases.
 *
 * @author Michael Billington <michael.billington@gmail.com>
 */


require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\ImagickEscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;
use Mike42\Escpos\EscposImage;

// use Mike42\escpos\PrintConnectors\NetworkPrintConnector;

$VentasDadaFecha=$_POST['VentasDadaFecha'];
$reporteGrupo=$_POST['reporteGrupo'];
$empresa=$_POST['empresa'];
$fechaInicial=$_POST['fechaInicial'];
$fechaFinal=$_POST['fechaFinal'];
$empresa=$_POST['empresa'];
$login=$_POST['login'];

if ($VentasDadaFecha!="") {

  imprimirProdVend($empresa,$VentasDadaFecha,$fechaInicial,$fechaFinal,$login);
}
if ($reporteGrupo!="") {
  imprimirTotalesGrupos($empresa,$reporteGrupo,$fechaInicial,$fechaFinal,$login);
}

// foreach ($listaDVenta as $key => $value) {
// 	echo $value->PRE_VENTA;
// }
// echo json_encode($listaEmpresa);
// echo "<br>";
// echo count($listaEmpresa);
// echo $listaEmpresa;
// echo $listaEmpresa[0]['']NOMEMP;
function imprimirProdVend($empresa,$listaDVenta,$fechaInicial, $fechaFinal,$login){
try {
  $nombrePc= php_uname('n');
    $connector= new WindowsPrintConnector("smb://".$nombrePc."/caja");
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
$TOTAL=0;
for ($i=0; $i <count($listaDVenta) ; $i++) { 
   $TOTAL=number_format(($TOTAL+$listaDVenta[$i]['AGRUPA1']), 2, '.', ' ');
    }
	$printer -> setEmphasis(true);		
	$printer -> setJustification(Printer::JUSTIFY_RIGHT);
	$printer -> setTextSize(1,1);
$printer -> text($empresa[0]['NOMEMP']."\n");
$printer -> text($empresa[0]['SUCURSAL']."\n");
$printer -> text($empresa[0]['DIREMP']."\n");
$printer -> text("REPORTES DE VENTAS DIARIAS\n");
$printer -> text("OPERADOR: ".$login."\n");
$printer -> text("FECHAS: ".$fechaInicial." - $fechaFinal  \n");
$printer -> text("---------------------------\n");
$printer -> text("Cant   Producto         Subtotal\n");
$printer -> text("---------------------------\n");

foreach ($listaDVenta as $key => $value) {
   
    $aux=0;
$cadena="";
$auxCadena="";
$restante="";
    $cantidad=$value['CANTIDAD'];
    $nombrePro=$value['NOM_PROD'];
    $totalNombre=strlen($nombrePro);
    $subtotal=number_format(floatval($value['AGRUPA1']), 2, '.', ' ');
    $printer->text($cantidad." ");
  $countCant=strlen($cantidad);
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
   
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
// $printer -> text("ABC");
// $printer -> feed(7);
// $printer -> text("DEF");
// $printer -> feedReverse(3);
// $printer -> text("GHI");
$printer -> feed();

$printer -> cut();

$printer -> close();

echo "CONECTO CORRECTAMENTE";
} catch (Exception $e) {
echo "NO CONECTO";
    
}

}



function imprimirTotalesGrupos($empresa,$listaDVenta,$fechaInicial, $fechaFinal,$login){
try {
    $connector= new WindowsPrintConnector("caja");
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */

  $printer -> setEmphasis(true);    
  $printer -> setJustification(Printer::JUSTIFY_RIGHT);
  $printer -> setTextSize(1,1);
$printer -> text($empresa[0]['NOMEMP']."\n");
$printer -> text($empresa[0]['SUCURSAL']."\n");
$printer -> text($empresa[0]['DIREMP']."\n");
$printer -> text("REPORTES DE VENTAS DIARIAS\n");
$printer -> text("OPERADOR: ".$login."\n");
$printer -> text("FECHAS: ".$fechaInicial." - $fechaFinal  \n");
$printer -> text("---------------------------\n");
$printer -> text("Grupo         Subtotal\n");
$printer -> text("---------------------------\n");

foreach ($listaDVenta as $key => $value) {
   
    $aux=0;
$cadena="";
$auxCadena="";
$restante="";
    $cantidad=$value['CANTIDAD'];
    $nombrePro=$value['NOM_GRUPO'];
    $totalNombre=strlen($nombrePro);
    
 if ($totalNombre>=26) {

 }else{
  $auxCadena=$nombrePro;
    $restante=26-$totalNombre;
    for ($i=0; $i <$restante ; $i++) {//recorre para ponerle el espacio siguiente que le falta 
         $auxCadena.=" ";
     }
    $printer->text($auxCadena);
    $printer->text($cantidad."\n");
 }
   

   }
$printer -> setJustification(Printer::JUSTIFY_LEFT);

$printer->text("----------------------------------");

   
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
// $printer -> text("ABC");
// $printer -> feed(7);
// $printer -> text("DEF");
// $printer -> feedReverse(3);
// $printer -> text("GHI");
$printer -> feed();

$printer -> cut();

$printer -> close();

echo "CONECTO CORRECTAMENTE";
} catch (Exception $e) {
echo "NO CONECTO";
    
}
}

