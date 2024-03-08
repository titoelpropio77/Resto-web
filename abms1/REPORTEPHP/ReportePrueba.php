<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Factura</title>
        <link rel="stylesheet" href="../css/reporte2.css" media="all" />
      
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    </head>
    <body style="    margin-top: -25px;">
     <!--    <div class="btnPrint">
            <button class="btn-floating btn-large waves-effect waves-light red" onclick="window.print();">Imprimir</button>
        </div> -->
        <header class="tamano">
            <h6 id="nombreempresa"><!-- {{ $empresa }}  -->Pollos kikychuy</h6> <hr>
            <p id="sucursal" >Suc_No_10_Kiky <!-- {{ $propietario }} --></p>
            <div id="company" class="clearfix">
                <div style="text-align: center; font-size: 15px; text-transform: uppercase;">
                    <!-- {{ $sucursal }} --> CENTRAL
BUSCH<br>
                    <!-- {{ $direccion }} --> BARRIO LA CUCHILLA <hr>
                    TELEFONO - <!-- {{ $telefono }} --> <hr>
                    <!-- {{ $ciudad }}  -->- <!-- {{ $pais }} -->
                </div>
                --------------------------------
                <div>
                    <h6  class="factura">FACTURA</h6>
                    <h6 class="factura">ORIGINAL</h6>
                </div>
                --------------------------
                <div id="datosfactura">
                    <div>
                        <span>Nit: MARTIN SUGARRIA</span><!-- {{ $facturanit }} -->
                    </div>
                    <div>
                        <span>Nº FACTURA: 16546546</span><!-- {{ $nroFactura }} -->
                    </div>
                    <div>
                        <span>Nº AUTORIZACION: 16546546</span><!-- {{ $nroAutorizacion }} -->
                    </div>
                </div>
                --------------------------
                <div id="descripcion">
                    <p><!-- { $actividad }} --></p>
                </div>
            </div>
            <div id="project">
                <div>
                    <span><strong>Fecha:</strong><!-- {{ $fecha }} --><strong> Hora:</strong><!-- {{ $hora }} --></span>
                </div> 
                <div>
                    <span><strong>NIT/CI:</strong></span> <!-- {{ $NIT }} -->
                </div>
                <div>
                    <span><strong>Señor(es):</strong></span><!--  {{ $razonSocial }} -->
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
                        <tr> 
                            <td ><!--{{ $consumo->cantidad }} -->5</td>
                            <td >POLLO A LA BRASA<!-- {{ $consumo->nombre }} --></td>
                            <td >12<!-- {{ $consumo->precioVenta }} --></td>
                            <td >532<!-- {{ $consumo->importe }} --></td>
                        </tr>
                        <tr>
                            <td ><!-- {{ $consumo->cantidad }} -->5</td>
                            <td >POLLO A LA BRASA<!-- {{ $consumo->nombre }} --></td>
                            <td >12<!-- {{ $consumo->precioVenta }} --></td>
                            <td >532<!-- {{ $consumo->importe }} --></td>
                        </tr>
                        <tr> 
                            <td ><!--{{ $consumo->cantidad }} -->5</td>
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
</html>