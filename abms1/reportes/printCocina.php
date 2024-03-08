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
/**
* 
*/
require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\ImagickEscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;
use Mike42\Escpos\EscposImage;

// use Mike42\escpos\PrintConnectors\NetworkPrintConnector;
$listaVenta=$_POST['listaVenta'];

$nombrePdto=$_POST['nombrePdto'];


$imPresion=$_POST['imPresion'];
$subTotal=$_POST['subTotal'];
$cantidad=$_POST['cantidad'];
// $nombrePdto=$_POST['nombrePdto']

for ($i=0; $i <count($imPresion) ; $i++) { 
   if($imPresion[$i]['impCoc']!=""){
    $printCocina[]=array("NOM_PROD"=>$nombrePdto[$i],"subTotal"=>$subTotal[$i],"CANTIDAD"=>$cantidad[$i]);
   };
 if($imPresion[$i]['imppunto1']!=""){
    $printPunto1[]=array("NOM_PROD"=>$nombrePdto[$i],"subTotal"=>$subTotal[$i],"CANTIDAD"=>$cantidad[$i]);
   };
  if($imPresion[$i]['imppunto2']!=""){
    $printPunto2[]=array("NOM_PROD"=>$nombrePdto[$i],"subTotal"=>$subTotal[$i],"CANTIDAD"=>$cantidad[$i]);
   };
   if($imPresion[$i]['imppunto3']!=""){
    $printPunto3[]=array("NOM_PROD"=>$nombrePdto[$i],"subTotal"=>$subTotal[$i],"CANTIDAD"=>$cantidad[$i]);
   };
   if($imPresion[$i]['imppunto4']!=""){
    $printPunto4[]=array("NOM_PROD"=>$nombrePdto[$i],"subTotal"=>$subTotal[$i],"CANTIDAD"=>$cantidad[$i]);
   };
}

if (count($printCocina)!=0 && $printCocina!="") {
  $listaDVenta=$printCocina;

  imprimirCocPuntos("cocina",$listaVenta,$listaDVenta);
}

if (count($printPunto1)!=0 && $printPunto1!="") {
  $listaDVenta=$printPunto1;
  imprimirCocPuntos("caja",$listaVenta,$listaDVenta);
}
if (count($printPunto2)!=0 && $printPunto2!="") {
  $listaDVenta=$printPunto2;
  imprimirCocPuntos("caja",$listaVenta,$listaDVenta);
}
if (count($printPunto3)!=0 && $printPunto3!="") {
  $listaDVenta=$printPunto3;
  imprimirCocPuntos("caja",$listaVenta,$listaDVenta);
}
if (count($printPunto4)!=0 && $printPunto4!="") {
  $listaDVenta=$printPunto4;
  imprimirCocPuntos("caja",$listaVenta,$listaDVenta);
}
return;





function imprimirCocPuntos($impresora,$listaVenta,$listaDVenta){

try {
  if ($listaVenta[0]['NIT_CLI']=="") {
    $nombreCli="SIN NOMBRE";
    $nit_cliente="0";
 } else{
  $nombreCli=$listaVenta[0]['NOM_CLI'];
 }
    $connector= new WindowsPrintConnector($impresora);
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
$TOTAL=0;
  $printer -> setEmphasis(true);    
  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> setTextSize(2,2);
  $printer -> text("ORDEN: ".$listaVenta[0]["ORDEN"]." \n");
  $printer -> text($listaVenta[0]["SALIDA"]."\n");
  $printer -> setTextSize(1,1);
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> text($nombreCli."        ".$listaVenta[0]["LOGIN"]."\n");
  $printer -> setTextSize(1,1);
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> setEmphasis(false);
  $printer -> text("---------------------------------------------\n");
  $printer -> text(" FECHA: ".$listaVenta[0]["F_VENTA"]."-".$listaVenta[0]["DHORAVEN"]." \n");
$printer -> feed(1);
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> setTextSize(1,1);
                  for ($i=0; $i < count($listaDVenta); $i++) { 
                    # code...
                 
                    # code...
               
                     $TOTAL=$TOTAL+number_format(floatval($listaDVenta[$i]['subTotal']), 2, '.', ' ');
                     // $nota=$value['NOTA']==""?"":"(".$value['NOTA'].")";
                     
                    $printer->text(number_format(intval($listaDVenta[$i]['CANTIDAD']), 0, '.', ' ')."  ".$listaDVenta[$i]['NOM_PROD']."\n");
                    // $printer->text(number_format(intval($value['CANTIDAD']), 0, '.', ' ')."  ".$value['NOM_PROD'].$nota."\n");

                  }
  $printer -> setTextSize(1,1);
  $printer -> text("---------------------------------------------\n");
  $printer -> setEmphasis(true);   
  $printer -> text("TOTAL.-       ".number_format($TOTAL, 3, '.', ' ')." \n");

  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> setEmphasis(true);
  $printer -> text("\n");

  $printer -> cut();
  /* Print a receipt end */
  
  /* Close printer */
  $printer -> close();

echo "CONECTO CORRECTAMENTE";
} catch (Exception $e) {
echo "NO CONECTO";
    
} 
}