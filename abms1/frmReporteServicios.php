<?php
include "header.php";
?>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/datepicker3.css">


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="      background: #b2e2cc;  overflow-x: scroll;">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
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
          </div>
 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
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
    </div>
    <button class="btn btn-warning btn-lg" style="margin-top: 14px;">LIMPIAR PANTALLA</button>
    <button class="btn btn-warning btn-lg" style="margin-top: 14px;" onclick="listarReporteServicioDada2Fechas()">GENERAR </button>
    <button class="btn btn-warning btn-lg" style="margin-top: 14px;" onclick="imprimirExcel()">IMPRIMIR</button>
     </div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="    min-height: 465px;">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
		<table id="tableReporteCaja" border="1" class="table responsive" width="100%" style="margin: 0;" >
			<thead style="background: #9595d2">
				<th style="    width: 9%;">CANTIDAD</th>
        <th style="    width: 42%;">PRODUCTO</th>
				<th>SUBTOTAL</th>
        <th>MESA</th>
        <th>LLEVAR</th>
        <th>AUTO</th>
				<th>MOTO</th>
			</thead>
		</table>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="    height: 270px;    overflow: auto;">
    <table id="tableReporteCaja" border="1" class="table responsive" width="100%" style="">
      
      <tbody id="tbodyReporteCaja" style="background: white"></tbody>
    </table>
  </div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">

    <label>Ctd. Mesa</label>
    <input type="number" name="" id="inputCtdMesa" class="form-control">
    <label>$BS.</label>

    <input type="number" name="" id="inputBsMesa" class="form-control">
  </div>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">

    <label>LLEVAR</label>
    <input type="number" name="" id="inputCtdLlevar" class="form-control">
    <label></label>
    <input type="number" name="" id="inputBsLlevar" class="form-control">
  </div>
   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">

    <label>AUTO</label>
    <input type="number" name="" id="inputCtdAuto" class="form-control">
    <label></label>
    <input type="number" name="" id="inputBsAuto" class="form-control">
  </div> 
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  ">

    <label>MOTO</label>
    <input type="number" name="" id="inputCtdMoto" class="form-control">
    <label></label>
    <input type="number" name="" id="inputBsMoto" class="form-control">
  </div>
	</div>

		
	</div>
<?php
include "footer.php";
?>
    <script type="text/javascript" src="js/bootstrap/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="js/reporteServicio.js"></script>
<script type="text/javascript">
$('li[name=liReporteServicio]').addClass('active');
  
</script>