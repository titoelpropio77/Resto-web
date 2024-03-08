 
  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Factura</title>
    <link rel="stylesheet" href="../css/reporte2.css" media="all" />
  </head>
  <body  style="    margin-top: -25px;" >
    <header class="clearfix">
    
    <div class="hola"> <h1><!-- {{ $empresa }} --> </h1></div> 

      
      <div id="company" class="clearfix">

           <span>********************Factura**********************</span>
         
            <div><span>Nit : </span><!-- {{ $facturanit }} --> </div>
            <div><span>Autorizacion :  </span><!-- {{ $nroAutorizacion }} -->  </div>
              <div><span>Numero factura :  </span><!-- {{ $nroFactura }} -->  </div>
      </div>
       <span>********************Cajero**********************</span>
             <div><span>Cajero :</span> <!-- {{ $nombrecajero }} -->  </div>
      <span>*************************************************</span>
      <div id="project">
     
        <div><span>Señor :</span> <!-- {{ $razonSocial }} -->  </div>
        <div><span>Nit :</span> <!-- {{ $NIT }} --> </div>
        <div><span>Fecha :</span> <!-- {{ $fecha }} -->  </div>
       
      </div>
  
       <span>*************************************************</span>
          
    </header>
    <main>

    
 
  
 

      <table>
        <thead>
          <tr>
          <th>Cantidad</th>
            <th class="desc">Descripcion</th>
          
            <th>P/U</th>
            <th>Importe</th>
          </tr>
        </thead>
       
        <tbody>
            <!-- @foreach($consumo as $consumo) -->
          <tr>
          <td ><!-- {{ $consumo->cantidad }} --></td>
         <td ><!-- {{ $consumo->nombre }} --></td>
             <td ><!-- {{ $consumo->precioVenta }} --></td>
          <td ><!-- {{ $consumo->importe }} --></td>
          </tr>
        
       
      
<!--        @endforeach -->
         
         
        </tbody>
         
        
      
     
  
      </table>
 
         <span>*************************************************</span>
      <div id="notices">

    <div> <h5>Total :  <!-- {{ $total }} --> Bs. </h5> </div>
      <div> <span>Total literal :   </span><!--  {{ $totalLiteral }} --></div>
        <div> <span>Forma de pago :   </span> <!-- {{ $formaPago }} --></div>
 
        <div class="notice">

  <div> <span>Codigo de control :   </span> <!-- {{ $codigoControl }}< -->/div>
   <div>  <span> Fecha limite :   </span><!-- {{ $fechaFin }} --></div>
        
        </div>
      </div>
    </main>
     <div>
<br>
      <img src="{{$codigoqr}}"  height="150" width="150" />
      
      <br>
    
  </div>
  
    
  
        
             <br>
  
      <footer>
     
"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS EL USO ILICITO DE ESTA SERA SANCIONADO DE ACUERDO A LA LEY"
    </footer>
     <br>
      <br>
       <br>
     <footer>
Ley Nro 453 "Tienes derecho a un trato equitativo sin discriminacion en la oferta de servicios "
    </footer> 
  
             <br>
  <span>*************************************************</span>

         <h5> gourmet gourmet </h5> gourmet

             <br>
  <span>*************************************************</span>
  </body>
</html>