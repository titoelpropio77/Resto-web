<?php

require('../libphp/fpdf/html2pdf.php');
include_once "../class/Conexion.php";
include_once "../class/VEN_GRAL_MYSQL.class.php";
include_once "../class/DETALLES_MYSQL.class.php";
include_once "../class/PRODUCTOS_MYSQL.class.php";
include_once "../class/CLIENTES_MYSQL.class.php";
include_once "../class/EMPRESA_MYSQL.class.php";


$con = new Conexion();
$conexion = $con->ConexionDB();
$idVenta=$_GET['idVenta'];
$venta=new VEN_GRAL_MYSQL($con);
$Dventa=new DETALLES_MYSQL($con);
$empresa=new EMPRESA_MYSQL($con);

$listaVenta=$venta->buscarXID($idVenta);
$listaDVenta=$Dventa->listarDadaVenta($idVenta);
$listaEmpresa=$empresa->obtenerUltimo();
$pdf=new PDF_HTML('P','mm','A4');
$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$nombreCli="";
if ($listaVenta[0]->NIT_CLI=="") {
 	$nombreCli="SIN NOMBRE";
 } 
 else{
 	$nombreCli=$listaVenta[0]->NOM_CLI;
 }
 $html="";
foreach ($listaDVenta as $key => $value) {
	$html.="<tr><td>".$value->CANTIDAD."
	<td>".$value->NOM_PROD."
	<td>".$value->PRE_VENTA."
	<td>".$value->PRE_VENTA*$value->CANTIDAD."</tr>";
}
$pdf->AddPage();
$pdf->WriteHTML('<!DOCTYPE html>
<html lang="en">
    <head>
      
        <meta charset="utf-8">
        <title>Factura</title>
        <link rel="stylesheet" href="css/reporte2.css" media="all" />
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    </head>
    <body >
     <!--    <div class="btnPrint">
            <button class="btn-floating btn-large waves-effect waves-light red" onclick="window.print();">Imprimir</button>
        </div> -->
      <header class="tamano">
            <h6 id="nombreempresa" style="margin-bottom:0">'.$listaEmpresa[0]->NOMEMP.'</h6>
            <hr>

            <p style="margin-top: -55px; font-size: 14px;">Suc_No_10_Kiky</p>
            <div id="company" class="clearfix">
                <div style="text-align: center; font-size: 15px; text-transform: uppercase;">
                     '.$listaEmpresa[0]->SUCURSAL.'<br>
                   '.$listaEmpresa[0]->DIREMP.'<br>
                    TELEFONO - '.$listaEmpresa[0]->TELEMP.'<br>
                    '.$listaEmpresa[0]->CIUPAI.' <!-- -{{ $pais }} -->
                </div>
                --------------------------------
                <div>
                    <h6  class="factura">FACTURA</h6>
                    <h6 class="factura">ORIGINAL</h6>
                </div>
                <div id="datosfactura">
                    <div>
                        <span>Nit:</span>'.$listaEmpresa[0]->NITRUC.'<!-- {{ $facturanit }} -->
                    </div>
                    <div>
                        <span>Nº FACTURA:</span>'.$listaEmpresa[0]->FACACT.'<!-- {{ $nroFactura }} -->
                    </div>
                    <div>
                        <span>Nº AUTORIZACION:</span>'.$listaEmpresa[0]->NROAUTORI.'<!-- {{ $nroAutorizacion }} -->
                    </div>
                </div>
                <div id="descripcion">
                    <p><!-- { $actividad }} --></p>
                </div>
            </div>
            <div id="project">
                <div>
                    <span><strong>Fecha:</strong>'.$listaVenta[0]->F_VENTA.'<!-- {{ $fecha }} --><strong> Hora:</strong>'.$listaVenta[0]->DHORAVEN.'<!-- {{ $hora }} --></span>
                </div> 
                <div>
                    <span><strong>NIT/CI:</strong></span>'.$listaVenta[0]->NIT_CLI.' <!-- {{ $NIT }} -->
                </div>
                <div>
                    <span><strong>Señor(es):</strong></span>'.$nombreCli.'<!--  {{ $razonSocial }} -->
                </div>
            </div>
        </header>
     <main  class="tamano">
            <div id="detalleVenta">
                <table>
                    <thead class="encabezado">
                        <tr>
                            <th> CANTIDAD</th>
                            <th class="desc"> DETALLE </th>
                            <th> P.UNITARIO </th>
                            <th> SUBTOTAL </th>
                        </tr>
                    </thead>
                    <tbody style="tbodyDetalle">
                    
                        '.$html.'
                </table>
                <div id="total">
                    <div>
                        <p>
                            <strong>TOTAL Bs.<!--  {{ $totalneto }} --> </strong>
                        </p>
                    </div>
                    <div>
                        <p>
                            <strong>DESCUENTO Bs. <!-- {{ $descuento }} --></strong>
                        </p>
                    </div>
                    <div>
                        <p>
                            <strong>TOTAL NETO Bs.<!-- {{ $total }} --></strong>
                        </p>
                    </div>
                </div>
                <!--                <div>
                                    <span>Cajero :</span> {{ $nombrecajero }}
                                </div>-->
            </div>
            <div id="totLiteral">
                <span>SON: </span><!-- {{ $totalLiteral }} -->
            </div>
<!--            <div>
                <div class="descripcion" style="font-size: 15px;">
                    <p>
                        No se admiten cambios, ni devoluciones pasadas 48 horas despues de la compra, muchas gracias!
                    </p>
                </div>
            </div>-->
            <div id="notices">
                <!-- <div>
                  <span>Forma de pago:</span>{{$formaPago}}
                </div>-->
                <div class="notice">
                    <div>
                        <span>CODIGO DE CONTROL: </span> <!-- {{ $codigoControl }} -->
                    </div>
                    <div>
                        <span>FECHA LIMITE DE EMISION: </span><!-- {{ $fechaFin }} -->
                    </div>
                </div>
            </div>
        </main>
   <div id="img"  class="tamano">
            <img src="../CodigoControlV7/temp/test1cf984e25187dd7383c8c89a200afac2.png" alt="codQR" height="130" width="130" />
        </div> 
        <footer  class="tamano">
            <p>
                <span>
                    "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS, EL USO ILICITO DE ESTA SERA SANCIONADO DE ACUERDO A LA LEY"
                </span>
            </p>
            <p>Ley Nro 453: Los servicios deben suministrarse en condiciones de inocuidad, calidad y seguridad</p>
            <div>
                <span>OsB POS</span>
                <span>www.osbolivia.com</span>
            </div>
        </footer>
    </body>
</html>');
$pdf->Output();

?>