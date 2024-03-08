<?php

include "headerF.php";
?>
<link rel="stylesheet" type="text/css" href="../fullcalendar/css/fullcalendar.css">
<link href='../fullcalendar/css/fullcalendar.print.css' rel='stylesheet' media='print' />

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 ">
         <div class="col-lg-8 col-xs-12" style="    min-height: 188px;">
           <div id='calendar' style="background:white"></div>
      </div>
 </div>
</div>
<!-- <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">Agregar Categorias</button> -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
     <table style="    margin: 0;" id="ghatable1" class="ghatable2 display table table-bordered table-stripe table-hover table-responsive" cellspacing="0" width="100%"> <!--jquery.dataTables.min.js -->
          <thead style="text-align: center">

               <th>Codigo</th>
               <th>Nombre de Insumo</th>
               <th>Movimiento(COMPRA VENTA)</th>
               <th>INGRESO</th>
               <th>EGRESO</th>
               <th>SALDO</th>

          </thead>

     </table>   
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="    max-height: 400px;    overflow: auto;" >
     <table style="    margin: 0;" id="ghatable1" class="ghatable2 display table table-bordered table-stripe table-hover table-responsive" cellspacing="0" width="100%"> <!--jquery.dataTables.min.js -->
          <thead style="text-align: center" ST>
               
               <!-- <th>Codigo</th>
               <th>Nombre de Insumo</th>
               <th>Movimiento(COMPRA VENTA)</th>
               <th>INGRESO</th>
               <th>EGRESO</th>
               <th>SALDO</th> -->
               
          </thead>
          <tbody id="tbodyKardex">
            
          </tbody>
     </table>   
</div>
<?php
include "footerF.php";
?>
<script type="text/javascript" src="../js/movimientoDiario.js"></script>
