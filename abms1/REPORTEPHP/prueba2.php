<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <title>Factura</title>
        <link rel="stylesheet" href="css/reporte2.css" media="all" />
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    </head>
    <body style="font-family: Tahoma">
     <!--    <div class="btnPrint">
            <button class="btn-floating btn-large waves-effect waves-light red" onclick="window.print();">Imprimir</button>
        </div> -->
      <header class="tamano">
            <h1 id="nombreempresa">'.$listaEmpresa[0]->NOMEMP.'</h1>
            <p style="margin-top: -21px; font-size: 14px;">De: '.$listaEmpresa[0]->NOMPRO.'</p>
            <div id="company" class="clearfix">
                <div style="text-align: center; font-size: 15px; text-transform: uppercase;">
                     '.$listaEmpresa[0]->SUCURSAL.'<br>
                   '.$listaEmpresa[0]->DIREMP.'<br>
                    TELEFONO - '.$listaEmpresa[0]->TELEMP.'<br>
                    '.$listaEmpresa[0]->CIUPAI.' <!-- -{{ $pais }} -->
                </div>
                <div>
                    <h6 id="factura">FACTURA</h6>
                </div>
                <div id="datosfactura">
                    <div>
                        <span><strong>Nit:</strong></span>'.$listaEmpresa[0]->NITRUC.'<!-- {{ $facturanit }} -->
                    </div>
                    <div>
                        <span><strong>Nº FACTURA:</strong></span>'.$listaEmpresa[0]->FACACT.'<!-- {{ $nroFactura }} -->
                    </div>
                    <div>
                        <span><strong>Nº AUTORIZACION:</strong></span>'.$listaEmpresa[0]->NROAUTORI.'<!-- {{ $nroAutorizacion }} -->
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
                    <tbody>
                    
                        <!-- @foreach($consumo as $consumo) -->
                        <tr><!-- 
                            <td >{{ $consumo->cantidad }} -->5</td>
                            <td >POLLO A LA BRASA<!-- {{ $consumo->nombre }} --></td>
                            <td >12<!-- {{ $consumo->precioVenta }} --></td>
                            <td >532<!-- {{ $consumo->importe }} --></td>
                        </tr>
                        <tr><!-- 
                            <td >{{ $consumo->cantidad }} -->5</td>
                            <td >POLLO A LA BRASA<!-- {{ $consumo->nombre }} --></td>
                            <td >12<!-- {{ $consumo->precioVenta }} --></td>
                            <td >532<!-- {{ $consumo->importe }} --></td>
                        </tr>
                        <tr><!-- 
                            <td >{{ $consumo->cantidad }} -->5</td>
                            <td >POLLO A LA BRASA<!-- {{ $consumo->nombre }} --></td>
                            <td >12<!-- {{ $consumo->precioVenta }} --></td>
                            <td >532<!-- {{ $consumo->importe }} --></td>
                        </tr>
                        <!-- @endforeach -->
                    </tbody>
                </table>
                <div id="total">
                    <div>
                        <p>
                            <strong>TOTAL Bs. 52222<!--  {{ $totalneto }} --> </strong>
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
            <img src="CodigoControlV7/temp/test1cf984e25187dd7383c8c89a200afac2.png" alt="codQR" height="130" width="130" />
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
</html>