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
$proceso=$_POST['proceso'];
if ($proceso=="imprimeAbrirMesa") {
  # code...
$nombrePdto=$_POST['nombrePdto'];
$imPresion=$_POST['imPresion'];
$subTotal=$_POST['subTotal'];
$cantidad=$_POST['cantidad'];
$hora=$_POST['hora'];
$NOM_EMPL=$_POST['NOM_EMPL'];

$date2=date_create($_POST['fechaVenta']);
  $fecha=date_format($date2, 'd/m/Y');

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


$listaVenta="";
if (count($printCocina)!=0 && $printCocina!="") {
  $listaDVenta=$printCocina;
  imprimirCocPuntos("cocina",$listaVenta,$listaDVenta,$fecha,$hora);
}

if (count($printPunto1)!=0 && $printPunto1!="") {
  $listaDVenta=$printPunto1;
  imprimirCocPuntos("cocina",$listaVenta,$listaDVenta,$fecha,$hora);
}
if (count($printPunto2)!=0 && $printPunto2!="") {
  $listaDVenta=$printPunto2;
  imprimirCocPuntos("cocina",$listaVenta,$listaDVenta,$fecha,$hora);
}
if (count($printPunto3)!=0 && $printPunto3!="") {
  $listaDVenta=$printPunto3;
  imprimirCocPuntos("caja",$listaVenta,$listaDVenta,$fecha,$hora);
}
if (count($printPunto4)!=0 && $printPunto4!="") {
  $listaDVenta=$printPunto4;
  imprimirCocPuntos("caja",$listaVenta,$listaDVenta,$fecha,$hora);
}
return;

}
if ($proceso=="imprimirDetalleM") {
  $cantidad = $_POST['cantidad'];
    $nombrePdto = $_POST['nombreProducto'];
    $precio = $_POST['precioA'];
    $nroMesa = $_POST['nroMesa'];
    $fecha=$_POST['fecha'];
    $subTotal=$_POST['subTotal'];
    $total=$_POST['total'];
    $operacion=$_POST['operacion'];
    $nombreEmpleadoAtendio=$_POST['nombreEmpleadoAtendio'];
    imprimirDetalleMesa($cantidad,$nombrePdto,$precio,$nroMesa,$fecha,$subTotal,$total,$operacion,$nombreEmpleadoAtendio);

}
if ($proceso=="ANULAR MESA") {
  $cantidad = $_POST['cantidad'];
    $nombrePdto = $_POST['nombreProducto'];
    $precio = $_POST['precioA'];
    $nroMesa = $_POST['nroMesa'];
    $fecha=$_POST['fecha'];
    $subTotal=$_POST['subTotal'];
    $total=$_POST['total'];
    $operacion=$_POST['operacion'];
    $nombreEmpleadoAtendio=$_POST['nombreEmpleadoAtendio'];
    imprimirDetalleMesa($cantidad,$nombrePdto,$precio,$nroMesa,$fecha,$subTotal,$total,$operacion,$nombreEmpleadoAtendio);
}
if ($proceso=="ANULAR ITEM") {
  $cantidad = $_POST['cantidad'];
    $nombrePdto = $_POST['nombreProducto'];
    $precio = $_POST['precioA'];
    $nroMesa = $_POST['nroMesa'];
    $fecha=$_POST['fecha'];
    $subTotal=$_POST['subTotal'];
    $total=$_POST['total'];
    $operacion=$_POST['operacion'];
    $nombreEmpleadoAtendio=$_POST['nombreEmpleadoAtendio'];
    imprimirDetalleMesa($cantidad,$nombrePdto,$precio,$nroMesa,$fecha,$subTotal,$total,$operacion,$nombreEmpleadoAtendio);
}
function imprimirCocPuntos($impresora,$listaVenta,$listaDVenta,$fecha,$hora){
try {
  $nombrePc= php_uname('n');
 //  if ($listaVenta[0]['NIT_CLI']=="") {
 //    $nombreCli="SIN NOMBRE";
 //    $nit_cliente="0";
 // } else{
 //  $nombreCli=$listaVenta[0]['NOM_CLI'];
 // }
  $TOTAL=0;
    $connector= new WindowsPrintConnector("smb://".$nombrePc."/".$impresora);
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
  $printer -> setEmphasis(true);    
  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> setTextSize(2,2);
  $printer -> text("ORDEN: ".$_POST['orden']." \n");
  $printer -> text("MESA:".$_POST['nroMesa']."\n");
  $printer -> setTextSize(1,1);
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> text($_POST['NOM_EMPL']."\n");
  $printer -> setTextSize(1,1);
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> setEmphasis(false);
  $printer -> text("---------------------------------------------\n");
  $printer -> text(" FECHA: ".$fecha."-".$hora." \n");
  $printer -> feed(1);
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> setTextSize(1,1);
                  foreach ($listaDVenta as $key => $value) {
                    $TOTAL=$TOTAL+number_format(floatval($value['subTotal']), 2, '.', ' ');
                    
                    $printer->text(number_format(intval($value['CANTIDAD']), 0, '.', ' ')."  ".$value['NOM_PROD']."\n");

                  }
  $printer -> setTextSize(1,1);
  $printer -> text("---------------------------------------------\n");
  $printer -> cut();
  /* Print a receipt end */
  
  /* Close printer */
  $printer -> close();

echo "CONECTO CORRECTAMENTE";
} catch (Exception $e) {
echo "NO CONECTO";
    
} 
}     
function imprimirDetalleMesa($cantidad1,$nombrePdto,$precio,$nroMesa,$fecha,$subTotal,$total,$operacion,$nombreEmpleadoAtendio){
try {
  $nombrePc= php_uname('n');
 //  if ($listaVenta[0]['NIT_CLI']=="") {
 //    $nombreCli="SIN NOMBRE";
 //    $nit_cliente="0";
 // } else{
 //  $nombreCli=$listaVenta[0]['NOM_CLI'];
 // }
    $connector= new WindowsPrintConnector("smb://".$nombrePc."/caja");
    $printer= new Printer($connector);
    // $printer->selectPrintMode(Printer::MODE_DOUBLE);
/* Line feeds */
  $printer -> setTextSize(2,2);
$operacion=$operacion=="imprimirDetalleM"?"":$operacion;
  $printer -> setEmphasis(true);    
  $printer -> setJustification(Printer::JUSTIFY_CENTER);

  $printer -> text("MESA:".$nroMesa." $operacion\n");
  $printer -> setTextSize(1,1);
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> setEmphasis(false);
  $printer -> text("NIT: \n\n");
  $printer -> text("NOMBRE:  \n");
$date2=date_create($fecha);
 $fechaImpresa=date_format($date2, 'd/m/Y');
  $printer -> text("---------------------------------------------\n");
  $printer -> text(" FECHA: ".$fechaImpresa."-".$_POST['hora']." \n");
  $printer -> feed(1);
  $printer -> setJustification(Printer::JUSTIFY_LEFT);
  $printer -> setTextSize(1,1);
  $TOTAL=0;
                 for ($i=0; $i <count($precio) ; $i++) { 

                    // $TOTAL= floatval($TOTAL+$subTotal[$i]);

                    // $printer->text(number_format(intval($cantidad[$i]), 0, '.', ' ')."  ".$nombrePdto[$i]."    ".$subTotal[$i]."\n");
                     $aux=0;
$cadena="";
$auxCadena="";
$restante="";
$restanteCan=0;

    $cantidad=$cantidad1[$i];
    $nombrePro=$nombrePdto[$i];
    $totalNombre=strlen($nombrePro);
    
    $subtotal=$subTotal[$i];
     
    $TOTAL=floatval($TOTAL+$subtotal);
    
    $countCant=strlen($cantidad);
     if ($totalNombre>=33) {//aqui entra si es mayor a la cantidad de caracteres permitidos
        
        
$auxCadena1="";
    if ($countCant<7) {
      $restanteCan=7-$countCant;
      for ($k=0; $k <$restanteCan ; $k++) { 
        $auxCadena1.=" ";
      }
$printer->text($cantidad.$auxCadena1." ");
    }else{
      $printer->text($cantidad." ");
    }

    
     for ($j=0; $j <33 ; $j++) { //recorre lso 33 caracteres permitidos
        if ($nombrePro[$j]==" ") {//verifica si pilla un espacio y lo guarda en un auxiliar
            $aux=$j;
            $cadena.=" ";
            $auxCadena=$cadena;
        }else{
            $cadena.=$nombrePro[$j];
        }
         
     }
      $restante=33-$aux;
     for ($l=0; $l <$restante-1 ; $l++) {//recorre para ponerle el espacio siguiente que le falta 
         $auxCadena.=" ";
     }
         $printer->text($auxCadena);
   

    
    $printer->text( $subtotal."\n");
    $auxCadena="    ";
    for ($k=$aux; $k < $totalNombre; $k++) { 
        $auxCadena.=$nombrePro[$k];
    }
     $printer->text($auxCadena."\n");
        }
    else{


$auxCadena1="";
    if ($countCant<7) {
      $restanteCan=7-$countCant;
      for ($l=0; $l <$restanteCan ; $l++) { 
        $auxCadena1.=" ";
      }
$printer->text($cantidad.$auxCadena1." ");
    }else{
      $printer->text($cantidad." ");
    }


    $auxCadena=$nombrePro;
    $restante=33-$totalNombre;
    for ($k=0; $k <$restante ; $k++) {//recorre para ponerle el espacio siguiente que le falta 
      // if (strlen($subtotal)==6 && $i==count($restante)) {
      //     break;
      //  }
       $auxCadena.=" ";
     }
    $printer->text($auxCadena.$subtotal."\n");
    
    
}

                 }
                   
  $printer -> setTextSize(1,1);
  $printer -> text("---------------------------------------------\n");
  $printer -> text("TOTAL:                            ".number_format($TOTAL, 2, '.', ' ')."\n");
  $printer -> setEmphasis(true);    
  $printer -> text($nombreEmpleadoAtendio."\n");


  $printer -> cut();
  /* Print a receipt end */
  
  /* Close printer */
  $printer -> close();

echo "CONECTO CORRECTAMENTE";
} catch (Exception $e) {
echo "NO CONECTO";
    
} 
}