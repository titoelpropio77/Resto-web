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

require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\ImagickEscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;
use Mike42\Escpos\EscposImage;

// use Mike42\escpos\PrintConnectors\NetworkPrintConnector;
$listaVenta=$_POST['listaVenta'];
 $literal=$_POST['literal'];
$listaDVenta=$_POST['listaDVenta'];
$codigoqr=$_POST['codigoqu'];



$TOTAL=0;
$nombreCli="";
for ($i=0; $i <count($listaDVenta) ; $i++) { 
   $TOTAL=number_format(($TOTAL+$listaDVenta[$i]['PRE_VENTA']*$listaDVenta[$i]['CANTIDAD']), 2, '.', ' ');
    }


$monto_compra =$TOTAL;


try {
    $connector= new WindowsPrintConnector("caja");
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
  $printer -> feed(2);    
  $printer -> setEmphasis(true);    
  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> text("PEIDO PARA \n");
  $printer -> text("Reference #: \n");
  $printer -> setTextSize(3,3);
  $printer -> text("\n");
  $printer -> setTextSize(1,1);
  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> text("r\n");
  $printer -> setEmphasis(false);
  $printer -> text("---------------------------------------------\n");
  $printer -> text("ORDEN COCINA\n");
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> setTextSize(1,2);
                  foreach ($listaDVenta as $key => $value) {
                    $Printer->text($value['CANTIDAD']."      ".$value['NOM_PROD']);

                  }
  $printer -> setTextSize(1,1);
  $printer -> text("---------------------------------------------\n");
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