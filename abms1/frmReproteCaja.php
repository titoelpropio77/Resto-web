<?php
include "header.php";
?>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/datepicker3.css">


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="      background: #b2e2cc;  overflow-x: scroll;">
	
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 " style="    min-height: 465px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="      background: #b2e2cc; margin: 0; ">
		<table id="tableReporteCaja" border="1" class="table responsive" width="100%" style="margin: 0;">
			<thead style="background: #9595d2">
				<th>Fecha</th>
        <th>T.Gastos</th>
				<th>T.Ingresos</th>
        <th>T.Credito</th>
        <th>Saldo Caja</th>
				<th>Venta del Día</th>
				<th></th>
			</thead>
      
		</table>

  </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="      background: #b2e2cc;height: 555px;
overflow: auto;">
      <table class="table responsive">
      <tbody id="tbodyReporteCaja" style="background: white"></tbody>
      </table>
  </div>

<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">

    <label>Total Gastos</label>
    <input type="number" name="" id="inputTotalGastos" class="form-control">
  </div>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">

    <label>Total Ingresos</label>
    <input type="number" name="" id="inputTotalIngesos" class="form-control">
  </div>
   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">

    <label>Total Credito</label>
    <input type="number" name="" id="inputTotalCredito" class="form-control">
  </div> 
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">

    <label>Total Caja</label>
    <input type="number" name="" id="inputTotalCaja" class="form-control">
  </div>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">

    <label>Total Ventas</label>
    <input type="number" name="" id="inputTotalVentas" class="form-control">
  </div>

	</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
		
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="text-align: center">
       	 
         <label>RANGO DE FECHA:</label> <br>

       	 <label>Fecha Inicial:</label>
          <div class="form-group">
                       <div class="input-group date">
                                  <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                </div>
                              <input type="text" class="form-control pull-right " id="fechaInicial" ">
                      </div>
                                <!-- /.input group -->
          </div>
          <label>Fecha Final:</label>
        <div class="form-group">
                       <div class="input-group date">
                                  <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                </div>
                              <input type="text" class="form-control pull-right " id="fechaFinal" ">
                      </div>
                                <!-- /.input group -->
          </div>

        <button class="btn btn-warning btn-lg" style="margin-top: 40px;    width: 100%;">Gastos por Entrega</button><br>
        <button class="btn btn-warning btn-lg" onclick="$('#inputTotalVentas').val('');$('#inputTotalCaja').val('');$('#inputTotalCredito').val('');$('#tbodyReporteCaja').empty();$('#inputTotalGastos').val('');$('#inputTotalIngesos').val('');" style="margin-top: 4px;    width: 100%;">LIMPIAR PANTALLA</button><br>
        <button class="btn btn-warning btn-lg" style="margin-top: 4px;    width: 100%;" onclick="listarReporteCajaDada2Fechas()">GENERAR</button><br>
        <button class="btn btn-warning btn-lg" style="margin-top: 4px;    width: 100%;">IMPRIMIR</button><br>
        <button class="btn btn-success btn-lg" style="margin-top: 4px;    width: 100%;" onclick="facturasEmitidas()">FACTURAS EMITIDAS</button><br>


        <label ><input type="checkbox" name="" style="    margin-top: 60px;" >Imprimir solo TOTALES</label> <br>
        <label ><input type="checkbox" name="" >Totales Mensuales</label><br>
<label>Exportar Reporte</label><br>
        <img onclick="imprimirExcel()" src="imagenes/imgExcel.png" style="cursor: pointer;   margin-right: 3px; width: 29px;">
        <img src="imagenes/imgWord.png" style="   margin-right: 3px; width: 29px;">
        <img src="imagenes/imgWord.png" style="  margin-right: 3px;  width: 29px;">
        <img src="imagenes/imgWord.png" style="   margin-right: 3px; width: 29px;">
       </div>
	</div>
		
	</div>
<?php
include "footer.php";
?>
    <script type="text/javascript" src="js/bootstrap/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="js/reporteCaja.js"></script>

<script type="text/javascript">
	$('.datepicker').datepicker({   autoclose: true,
                                    dateFormat: 'yy-mm-dd'
                                            });

   $('#ghatable').DataTable({
        "pagingType": "full_numbers",
         "scrollY":        "330px",
        "scrollCollapse": true,
        "paging":         false,
        retrieve: true
        
    });
$('li[name=liReporteCaja]').addClass('active');

   
</script>