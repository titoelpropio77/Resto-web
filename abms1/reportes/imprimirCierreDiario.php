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

$ventasDiarias=$_POST['ventasDiarias'];
$listaGrupo=$_POST['listaGrupo'];
$listaTOTALCAJACIERRE=$_POST['listaTOTALCAJACIERRE'];
$listarGastos=$_POST['listarGastos'];
$empresa=$_POST['empresa'];
$turno=$_POST['turno'];
$fecha=$_POST['fecha'];
$checkProductosVendidos=$_POST['checkProductosVendidos'];
$checkTotaleGrupos=$_POST['checkTotaleGrupos'];
$checkTotalCaja=$_POST['checkTotalCaja'];
$checkFacturaCre=$_POST['checkFacturaCre'];
$checkFacturaAnu=$_POST['checkFacturaAnu'];
$checkGastos=$_POST['checkGastos'];
$checkVentasDeli=$_POST['checkVentasDeli'];
$login=$_POST['login'];
$listaFacturasCredito=$_POST['listaFacturasCredito'];
$listaFacturasAnuladas=$_POST['listaFacturasAnuladas'];
if ($checkProductosVendidos=="true") {

  imprimirProdVend($empresa,$ventasDiarias,$turno,$login,$fecha);
}
if ($checkTotaleGrupos=="true" && $listaGrupo!="") {
  imprimirTotalesGrupos($empresa,$listaGrupo,$turno,$login,$fecha);
}
if ($checkTotalCaja=="true" && $listaTOTALCAJACIERRE!="") {
  reporteCaja($empresa,$listaTOTALCAJACIERRE,$turno,$login,$fecha);
}
if ($checkFacturaCre=="true" && $listaFacturasCredito!="") {
  if ($listaFacturasCredito!="0") {
  listaFacturasCredito($empresa,$listaFacturasCredito,$turno,$login,$fecha);
  }
}
if ($checkFacturaAnu=="true" && $listaFacturasAnuladas!="") {

  if ($listaFacturasAnuladas!="0") {
  listaFacturasAnuladas($empresa,$listaFacturasAnuladas,$turno,$login,$fecha);
  }
}
if ($checkGastos=="true" && $checkGastos!="") {

  if ($listarGastos!="0") {
  listarGastos($empresa,$listarGastos,$turno,$login,$fecha);
  }
}
// foreach ($listaDVenta as $key => $value) {
// 	echo $value->PRE_VENTA;
// }
// echo json_encode($listaEmpresa);
// echo "<br>";
// echo count($listaEmpresa);
// echo $listaEmpresa;
// echo $listaEmpresa[0]['']NOMEMP;
function imprimirProdVend($empresa,$listaDVenta,$turno,$login,$fecha){
try {
  $nombrePc= php_uname('n');
    $connector= new WindowsPrintConnector("smb://".$nombrePc."/caja");
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
$TOTAL=0;

	$printer -> setEmphasis(true);		
	$printer -> setJustification(Printer::JUSTIFY_LEFT);
	$printer -> setTextSize(1,1);
$printer -> text($empresa[0]['NOMEMP']."\n");
$printer -> text($empresa[0]['SUCURSAL']."\n");
$printer -> text($empresa[0]['DIREMP']."\n");
$printer -> text("REPORTES DE VENTAS DIARIAS\n");
$printer -> text("TURNO: ".$turno."\n");
$printer -> text("OPERADOR: ".$login."\n");
$printer -> text("FECHA: ".$fecha."\n");
$printer -> text("---------------------------\n");
$printer -> text("Cant   Producto             Subtotal\n");
$printer -> text("---------------------------\n");

foreach ($listaDVenta as $key => $value) {
  
    $aux=0;
$cadena="";
$auxCadena="";
$restante="";
$restanteCan=0;

    $cantidad=$value['CANTIDAD'];
    $nombrePro=$value['NOM_PROD'];
    $totalNombre=strlen($nombrePro);
    
    $subtotal=$value['AGRUPA1'];
     
    $TOTAL=floatval($TOTAL+$subtotal);
    
    $countCant=strlen($cantidad);
     if ($totalNombre>=33) {//aqui entra si es mayor a la cantidad de caracteres permitidos
        
        
$auxCadena1="";
    if ($countCant<7) {
      $restanteCan=7-$countCant;
      for ($i=0; $i <$restanteCan ; $i++) { 
        $auxCadena1.=" ";
      }
$printer->text($cantidad.$auxCadena1." ");
    }else{
      $printer->text($cantidad." ");
    }

    
     for ($i=0; $i <33 ; $i++) { //recorre lso 33 caracteres permitidos
        if ($nombrePro[$i]==" ") {//verifica si pilla un espacio y lo guarda en un auxiliar
            $aux=$i;
            $cadena.=" ";
            $auxCadena=$cadena;
        }else{
            $cadena.=$nombrePro[$i];
        }
         
     }
      $restante=33-$aux;
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


$auxCadena1="";
    if ($countCant<7) {
      $restanteCan=7-$countCant;
      for ($i=0; $i <$restanteCan ; $i++) { 
        $auxCadena1.=" ";
      }
$printer->text($cantidad.$auxCadena1." ");
    }else{
      $printer->text($cantidad." ");
    }


    $auxCadena=$nombrePro;
    $restante=33-$totalNombre;
    for ($i=0; $i <$restante ; $i++) {//recorre para ponerle el espacio siguiente que le falta 
      // if (strlen($subtotal)==6 && $i==count($restante)) {
      //     break;
      //  }
       $auxCadena.=" ";
     }
    $printer->text($auxCadena.$subtotal."\n");
    
    
}


   }
$printer -> setJustification(Printer::JUSTIFY_CENTER);

$printer->text("----------------------------------");
   $printer -> feed(1);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
   $printer->text("TOTAL                          ");
   $printer->setEmphasis(true);
   $printer->text(number_format($TOTAL, 2, '.', ' '));
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



function imprimirTotalesGrupos($empresa,$listaDVenta,$turno,$login,$fecha){
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
$printer -> text("REPORTES DE GRUPOS\n");
$printer -> text("TURNO: ".$turno."\n");
$printer -> text("OPERADOR: ".$login."\n");
$printer -> text("FECHA: ".$fecha."\n");
$printer -> text("---------------------------\n");
$printer -> text("FAMILIA            CANTIDAD\n");
$printer -> text("---------------------------\n");
  $printer -> setJustification(Printer::JUSTIFY_LEFT);

foreach ($listaDVenta as $key => $value) {
   
    $aux=0;
$cadena="";
$auxCadena="";
$restante="";
    $cantidad=$value['CANTIDAD'];
    $nombrePro=$value['NOM_GRUPO'];
  
    $printer->text($nombrePro."          ");

    $printer->text($cantidad."\n");
   

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

function listaFacturasCredito($empresa,$listaDVenta,$turno,$login,$fecha){
try {
     $nombrePc= php_uname('n');
    $connector= new WindowsPrintConnector("smb://".$nombrePc."/caja");
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
$TOTAL=0;
  $printer -> setEmphasis(true);    
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> setTextSize(1,1);
$printer -> text($empresa[0]['NOMEMP']."\n");
$printer -> text($empresa[0]['SUCURSAL']."\n");
$printer -> text($empresa[0]['DIREMP']."\n");
$printer -> text("REPORTES DE FACTURAS A CREDITO\n");
$printer -> text("TURNO: ".$turno."\n");
$printer -> text("OPERADOR: ".$login."\n");
$printer -> text("FECHA: ".$fecha."\n");
$printer -> text("---------------------------\n");
$printer -> text("NºFAC    CLIENTE            MONTO\n\n");
foreach ($listaDVenta as $key => $value) {

$printer -> text($value['ID']."    ".$value['NOM_CLI']."        ".$value['TOTAL_FACT']."\n");
$TOTAL=floatval($TOTAL+$value['TOTAL_FACT']);

}
  $printer -> setJustification(Printer::JUSTIFY_LEFT);


$printer->text("----------------------------------\n");
$printer->text("TOTAL:                  ".$TOTAL);

   
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

function listaFacturasAnuladas($empresa,$listaDVenta,$turno,$login,$fecha){
try {
     $nombrePc= php_uname('n');
    $connector= new WindowsPrintConnector("smb://".$nombrePc."/caja");
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
$TOTAL=0;
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
$printer -> text("NºFAC    VENDEDOR            MONTO\n\n");
foreach ($listaDVenta as $key => $value) {

$printer -> text($value['ID']."    ".$value['LOGIN']."        ".$value['TOTAL_FACT']."\n");
$TOTAL=floatval($TOTAL+$value['TOTAL_FACT']);

}
  $printer -> setJustification(Printer::JUSTIFY_LEFT);


$printer->text("----------------------------------\n");
$printer->text("TOTAL:                  ".$TOTAL);

   
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

function listarGastos($empresa,$listaDVenta,$turno,$login,$fecha){
  try {
     $nombrePc= php_uname('n');
    $connector= new WindowsPrintConnector("smb://".$nombrePc."/caja");
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
$TOTAL=0;
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
$printer -> text("NROº    ENTREGADO A      CONCEPTO    MONTO\n\n");
foreach ($listaDVenta as $key => $value) {

$printer -> text($value['ID']."    ".$value['ENTREGADOA']."   ".$value['CONCEPTO']."    ".$value['MONTO']."\n");
$TOTAL=floatval($TOTAL+$value['MONTO']);

}
  $printer -> setJustification(Printer::JUSTIFY_LEFT);


$printer->text("----------------------------------\n");
$printer->text("TOTAL:                  ".$TOTAL);

   
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
// SELECT sum(TOTAL_FACT) as facturado FROM ven_gral_mysql WHERE ven_gral_mysql.F_VENTA=""
// select SUM(TOTAL_FACT) AS credito from ven_gral_mysql WHERE FORMAPAGO="CREDITO" and  ven_gral_mysql.F_VENTA=""
// select SUM(TOTAL_FACT) AS consumo from ven_gral_mysql WHERE FORMAPAGO="CONSUMOINTERNO" and  ven_gral_mysql.F_VENTA=""
// select SUM(TOTAL_FACT) AS anulado from ven_gral_mysql WHERE ESTADO="INACTIVO" and  ven_gral_mysql.F_VENTA=""
