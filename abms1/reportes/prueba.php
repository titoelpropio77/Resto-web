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



try {
    $connector= new WindowsPrintConnector("caja");
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
  $printer -> text("---------------------------------------------\n");
  

$printer -> feed(1);
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
