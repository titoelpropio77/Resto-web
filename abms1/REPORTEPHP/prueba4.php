<?php
// define('FPDF_FONTPATH','..\libphp\fpdf\font');
define('FPDF_FONTPAT', 'font/');
require('../libphp/fpdf/pdf_js.php');
require "../CodigoControl/GenerarQr.php";
require "../CodigoControl/sin/ControlCode.php";
    // echo '<img src="'..'" /><hr/>';  
// require('../libphp/fpdf/font/tahoma.php');
// require('..\libphp\fpdf\font\tahoma.php');
// require('../libphp/fpdf/html2pdf.php');
include_once "../class/Conexion.php";
include_once "../class/VEN_GRAL_MYSQL.class.php";
include_once "../class/DETALLES_MYSQL.class.php";
include_once "../class/PRODUCTOS_MYSQL.class.php";
include_once "../class/CLIENTES_MYSQL.class.php";
include_once "../class/EMPRESA_MYSQL.class.php";


$con = new Conexion();
$conexion = $con->ConexionDB();
$idVenta=$_GET['idVenta'];
$literal=$_GET['literal'];
$fac=$_GET['fac'];
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

// $fechaHoy=str_replace('-', '', $_GET['fechahoy']);
$fechaHoy=date("Y-m-d", strtotime($_GET['fechahoy']));
 $fechaHoy=str_replace('-', '', $fechaHoy);
echo $fechaHoy;
if ($listaVenta[0]->NIT_CLI=="") {
    $nombreCli=$listaVenta[0]->NOM_CLI==""?"SIN NOMBRE":$listaVenta[0]->NOM_CLI;
    $nit_cliente='0';
 } 
 else{
    $nombreCli=$listaVenta[0]->NOM_CLI;
 }
for ($i=0; $i <count($listaDVenta) ; $i++) { 
     
   $TOTAL+=floatval($listaDVenta[$i]->AGRUPA1);
    }

$monto_compra =$TOTAL;
$clave =$listaEmpresa[0]->LLAVE ;
$controlCode = new ControlCode();
  $codigoControl= $controlCode->generarCodControl($numero_autorizacion, $fac, $nit_cliente, $fechaHoy, $monto_compra, $clave);

$genera=new FacturaController();
 $datosqr = "" . $nitEmpresa . "|" . $fac . "|" . $numero_autorizacion . "|" . $listaVenta[0]->F_VENTA . "|" . $monto_compra . "|" . $monto_compra*0.13 . "|" . $codigoControl . "|" . $nit_cliente. "|" . "0" . "|" . "0" . "|" . "0" . "|" . "0"  ;
        $codigoqr = $genera->generadorqr($datosqr);



 $html="";
foreach ($listaDVenta as $key => $value) {
	$html.="<tr><td>".$value->CANTIDAD."
	<td>".$value->NOM_PROD."
	<td>".$value->PRE_VENTA."
	<td>".$value->PRE_VENTA*$value->CANTIDAD."</tr>";

}

class PDF_AutoPrint extends PDF_JavaScript
{
    function MultiCellBlt($w, $h, $blt, $txt, $border=0, $align='J', $fill=false)
    {
        //Get bullet width including margins
        $blt_width = $this->GetStringWidth($blt)+$this->cMargin*2;

        //Save x
        $bak_x = $this->x;

        //Output bullet
        $this->Cell($blt_width,$h,$blt,0,'',$fill);

        //Output text
        $this->MultiCell($w-$blt_width,$h,$txt,$border,$align,$fill);

        //Restore x
        $this->x = $bak_x;
    }
// function AutoPrint($dialog=false)
// {
//     //Open the print dialog or start printing immediately on the standard printer
//     $param=($dialog ? 'true' : 'false');
//     $script="print($param);";
//     $this->IncludeJS($script);
// }

function AutoPrintToPrinter($server, $printer, $dialog=false)
{
    //Print on a shared printer (requires at least Acrobat 6)
    $script = "var pp = getPrintParams();";
    if($dialog)
        $script .= "pp.interactive = pp.constants.interactionLevel.full;";
    else
        $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
    $script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
    $script .= "print(pp);";
    $this->IncludeJS($script);
}   

function AutoPrint($printer='')
    {
        // Open the print dialog
        if($printer)
        {
            $printer = str_replace('\\', '\\\\', $printer);
            $script = "var pp = getPrintParams();";
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
            $script .= "pp.printerName = '$printer'";
            $script .= "print(pp);";
        }
        else
            $script = 'print(true);';
        $this->IncludeJS($script);
    }

}
 header("Content-Type: text/html; charset=UTF-8");
$height=2;
$alturaDetalle=0;
$pdf=new PDF_AutoPrint('P', 'mm', array (100,300 ));


  // $sms_text =iconv ( 'UTF-8', 'ISO-8859-1', "Autorización");
// echo  $sms_text =utf8_encode( "Autorización");

// $pdf->AddFont('Tahoma','','tahoma.php');
$pdf->AddFont('tahoma','','tahoma.php');
$pdf->AddPage();
$pdf->SetFont('tahoma','',7);
// $pdf->Text(25, 2, $listaEmpresa[0]->NOMEMP);
$pdf->SetXY(27, 2);
// $pdf->Cell(10);
$pdf->Cell(20,2, $listaEmpresa[0]->NOMEMP, 0, 0, 'C');
$pdf->SetXY(27, 5.8);
$pdf->Cell(19,2, $listaEmpresa[0]->SUCURSAL, 0, 0, 'C');
$pdf->SetXY(27, 8.8);
$pdf->Cell(19,2, $listaEmpresa[0]->DIREMP, 0, 0, 'C');
$pdf->SetXY(27, 11.8);
$pdf->Cell(19,2,"Telefono: ". $listaEmpresa[0]->TELEMP, 0, 0, 'C');
$pdf->SetXY(27, 14.8);
$pdf->Cell(19,2, $listaEmpresa[0]->CIUPAI, 0, 0, 'C');
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->SetXY(27, 16.7);
$pdf->Cell(19,2, "----------------------", 0, 0, 'C');
$pdf->SetFont ( 'Arial', 'B', '7' );
$pdf->SetXY(27, 19.2);
$pdf->Cell(19,2, "FACTURA", 0, 0, 'C');
$pdf->SetXY(27, 22.4);
$pdf->Cell(19,2, "ORIGINAL", 0, 0, 'C');
$pdf->SetFont('tahoma','',6.8);
$pdf->SetXY(27, 26.1);
$pdf->Cell(19,2, "NIT:".$listaEmpresa[0]->NITRUC, 0, 0, 'C');
$pdf->SetFont('tahoma','',7.8);
$pdf->SetXY(27, 30);
$pdf->Cell(19,2, "FACTURA:".$fac, 0, 0, 'C');
$pdf->SetXY(27, 32.8);
$pdf->SetFont ( 'Arial', 'B', '7' );
// $pdf->Cell(19,2, "Autorización"  , 0, 0, 'C');
$pdf->Cell(19,2,iconv ( 'UTF-8', 'ISO-8859-1', "Autorización:".$listaEmpresa[0]->NROAUTORI)  , 0, 0, 'C');
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->SetXY(27, 34.5);
$pdf->Cell(19,2, "----------------------", 0, 0, 'C');
$pdf->SetFont('tahoma','',7);
$pdf->SetXY(27, 37.8);
$pdf->Cell(19,2, "Fecha:  " .$listaVenta[0]->F_VENTA, 0, 0, 'C');
$pdf->SetFont ( 'Arial', 'B', '7' );
$pdf->SetXY(27, 40.8);
$pdf->Cell(19,2,  iconv ('UTF-8', 'ISO-8859-1',"Señor(ES): ".$nombreCli) , 0, 0, 'C');
$pdf->SetXY(27, 45.8);
$pdf->Cell(19,2, "NIT:".$listaVenta[0]->NIT_CLI , 0, 0, 'C');
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->SetXY(27, 47.8);
$pdf->Cell(19,2, "----------------------", 0, 0, 'C');
$pdf->SetFont('tahoma','',7.5);
$pdf->SetXY(20, 51.5);
$pdf->Cell(10,2, "CAJERO:  ".$listaVenta[0]->LOGIN , 0, 0, 'C');
$pdf->SetFont('Arial','B',13);
$pdf->SetXY(20, 56.5);
$pdf->Cell(1,2, "ORDEN:".$listaVenta[0]->ORDEN, 0, 0, 'C');
$pdf->SetXY(55, 56.5);
$pdf->Cell(1,2, $listaVenta[0]->SALIDA, 0, 0, 'C');
$pdf->SetFont('Arial','B',16);
$pdf->SetXY(28, 59.5);
$pdf->Cell(21,2, "---------------------------------", 0, 0, 'C');
$pdf->SetFont('tahoma','',7.5);
$pdf->SetXY(10, 62.5);
$pdf->Cell(1,2, "Cant.", 0, 0, 'C');
$pdf->SetXY(32, 62.5);
$pdf->Cell(1,2, "Concepto", 0, 0, 'C');
$pdf->SetXY(50, 62.5);
$pdf->Cell(1,2, "p/u", 0, 0, 'C');
$pdf->SetXY(60, 62.5);
$pdf->Cell(1,2, "Subtotal", 0, 0, 'C');
$pdf->SetFont('Arial','B',16);
$pdf->SetXY(28, 64);
$pdf->Cell(21,2, "---------------------------------", 0, 0, 'C');
$pdf->SetFont('tahoma','',7.5);

$cant=66;
$concept=66;
$pu=66;
$subtotal=66;

for ($i=0; $i <count($listaDVenta) ; $i++) { 
     $subt=floatval($listaDVenta[$i]->AGRUPA1);
    $PRE_VENTA=number_format($listaDVenta[$i]->PRE_VENTA, 2, '.', ' ');
    if ($i==0) {

          $pdf->SetXY(7, $cant=$cant);
$pdf->Cell(1,2, number_format($listaDVenta[$i]->CANTIDAD, 2, '.', ' '), 0, 0, 'L');
$pdf->SetXY(13, $concept=$concept);
    $pdf->MultiCellBlt(30,3,"",$listaDVenta[$i]->NOM_PROD);
$pdf->SetXY(46, $pu=$pu);
$pdf->Cell(1,2,$PRE_VENTA, 0, 0, 'L'); 
$pdf->SetXY(60, $subtotal=$subtotal);
$pdf->Cell(1,2,  number_format($subt, 2, '.', ' '), 0, 0, 'L'); 
    }else{
$pdf->SetXY(7, $cant=$cant+6);
$pdf->Cell(1,2, $listaDVenta[$i]->CANTIDAD, 0, 0, 'L');
$pdf->SetXY(13, $concept=$concept+6);
// $pdf->Cell(1,2,  $listaDVenta[$i]->NOM_PROD, 0, 0, 'L');
 $pdf->MultiCellBlt(30,3,"",$listaDVenta[$i]->NOM_PROD);
$pdf->SetXY(46, $pu=$pu+6);
$pdf->Cell(1,2,$PRE_VENTA, 0, 0, 'L'); 
$pdf->SetXY(60, $subtotal=$subtotal+6);
$pdf->Cell(1,2,number_format($subt, 2, '.', ' ') , 0, 0, 'L');
    }

}
$pdf->SetFont('Arial','B',16);
$pdf->SetXY(28, $cant=$cant+5);
$pdf->Cell(21,2, "---------------------------------", 0, 0, 'C');
$pdf->SetFont('tahoma','',7.5);
$pdf->SetXY(15, $cant=$cant+2.5);
$pdf->Cell(1,2,"TOTAL:" ,0, 0, 'C'); 
$pdf->SetXY(60, $cant);
$pdf->Cell(1,2,number_format(floatval($TOTAL), 2, '.', ' ') ,0, 0, 'C'); 
$pdf->SetFont('tahoma','',7.3);
$pdf->SetXY(9, $cant=$cant+5);
$pdf->Cell(1,2,"Son: ".$literal ,0, 0, 'L'); 
$pdf->SetXY(9, $cant=$cant+5);
$pdf->Cell(1,2,"Pago: " ,0, 0, 'L'); 
$pdf->SetXY(30, $cant);
$pdf->Cell(1,2,number_format(($listaVenta[0]->PAGO_BS), 2, '.', ' ') ,0, 0, 'C'); 
$pdf->SetXY(9, $cant=$cant+5);
$pdf->Cell(1,2,"Cambio:" ,0, 0, 'L'); 
$pdf->SetXY(30, $cant);
$pdf->Cell(1,2,number_format(($listaVenta[0]->CAMBIO_BS), 2, '.', ' ')  ,0, 0, 'C'); 
$pdf->SetXY(11, $cant=$cant+4);
$pdf->Cell(1,2,"Codigo de Control:   ".$codigoControl ,0, 0, 'L'); 
$pdf->SetFont ( 'Arial', 'B', '7' );
$pdf->SetXY(11, $cant=$cant+4);
 $date2=date_create($listaEmpresa[0]->FECHA_LIM);
  $dateFormat=date_format($date2, 'd/m/Y');
$pdf->Cell(1,2,iconv ( 'UTF-8', 'ISO-8859-1',"Fecha limite de Emisíon:  ".$dateFormat) ,0, 0, 'L');
$pdf->SetXY(11, $cant=$cant+4);
$pdf->SetFont('tahoma','',7.5);
$pdf->Cell(1,2,"Forma de Pago:  ".$listaVenta[0]->FORMAPAGO ,0, 0, 'L');
$pdf->SetXY(15, $cant=$cant+4);
$pdf->Cell(1,2,$pdf->Image($codigoqr,$pdf->GetX()-5, $pdf->GetY(),-280) ,0, 0, 'L');

$pdf->SetXY(26, $cant=$cant+2);
$pdf->Cell(1,2,"ESTA FACTURA CONTRIBUYE AL" ,0, 0, 'L');

$pdf->SetXY(26, $cant=$cant+3);
$pdf->Cell(1,2,"DESARROLLO DEL PAIS, EL USO " ,0, 0, 'L');
$pdf->SetXY(26, $cant=$cant+3);
$pdf->Cell(1,2,utf8_decode("ILICITO DE ESTA SERA SANCIONADO") ,0, 0, 'L');
$pdf->SetXY(26, $cant=$cant+3);
$pdf->Cell(1,2,utf8_decode("DE ACUERDO A LEY") ,0, 0, 'L');
$pdf->SetXY(8, $cant=$cant+6);
$sample_text = 'Ley 453: Tienes derecho a recibir informacion
sobre las caracteristicas y contenidos delos
servicios que utilices.';
    $pdf->MultiCellBlt(60,3,"",$sample_text);
    
// $pdf->Cell(0, 1, "text", 0, 0, 'C');
// $pdf->Text(25, 5, $listaEmpresa[0]->SUCURSAL);

// $pdf->MultiCell(0,5,'You can <p ALIGN="center">center a line</p>',0,'C');

// $pdf->MultiCell(0, 0, iconv('UTF-8', 'cp874', $listaEmpresa[0]->SUCURSAL."Suc_No_10_Kiky"));
//Open the print dialog
 // $pdf->AutoPrint("caja");
 // $pdf->AutoPrint(true);
 $namepdf=$nombreCli.$listaVenta[0]->F_VENTA.$listaEmpresa[0]->FACACT.$fac;
$namepdf =  str_replace(' ', '', $namepdf);
$namepdf =  str_replace('/', '', $namepdf);
 $fileout="pdfFactura/".$namepdf.".pdf";
// $pdf->Output('pdfFactura/hola.pdf','I');
 // $pdf->AutoPrintToPrinter("127.0.0.1",'caja',true);
// $pdf->Output('C:\test1.pdf');
// $pdf->Output('result.pdf', 'D');

 // $pdf->Output ("F", $namepdf."pdf");
 // $pdf->Output ("../pdfFactura","F");
 // $file = fopen($_SERVER['DOCUMENT_ROOT'].'/posgourmet/abms1/REPORTEPHP', 'wb');
 $pdf->Output (  $fileout,"F",true);
// $pdf->Output();
//  $error="";
// $reponse = array("error" => $error, "result" =>   $fileout);
// echo  json_encode($reponse);
 // $pdf->AutoPrint(true);
?>