<?php
include "header.php";
 require("../verificador.php");
?>
<script type="text/javascript">
            impresionnube= "<?php echo verificarimpresionnube(); ?>";
  
</script>
<style type="text/css">
	.fc-scroller {
   overflow-y: hidden !important;
}
</style>
        <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap/datepicker3.css"> -->
        <link rel="stylesheet" type="text/css" href="fullcalendar/css/fullcalendar.css">
    <link href='fullcalendar/css/fullcalendar.print.css' rel='stylesheet' media='print' />

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="      background: #b2e2cc;  overflow-x: scroll;">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 ">
		 <div class="col-lg-8 col-xs-12" style="    min-height: 188px;">
  <div id='calendar' style="background:white"></div>
        </div>
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       	<br>
       	 <label>TURNOS:      </label> &nbsp;  &nbsp;
       	 <label><input type="checkbox" name="" id="turnoMan" value="MAÑANA" onclick="archivarTotalesChecked(this)">MAÑANA</label> &nbsp; &nbsp;
       	 <label><input type="checkbox" name="" id="turnoNoc" value="NOCHE" onclick="archivarTotalesChecked(this)">NOCHE</label>
       	 <br>
       	 <label style="color: blue"><input type="checkbox" name="">&nbsp;Aplicar al INVENTARIO</label><br>
       	 <label style="color: blue"><input type="checkbox" name="" id="archivarTotales" value="archivarTotales" onclick="archivarTotalesChecked(this)">&nbsp;Archivar Totales</label>
       	 <br>
       </div>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 " style="    min-height: 330px;" id="divListaProducto">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
      <table id="" class="table responsive" width="100%" style="    margin: 0;">
      <thead style="background: #9595d2">
        <th>Cantidad</th>
        <th>Producto</th>
        <th style="width: 10%;">Sub Total</th>
      </thead>
    </table>
    </div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="    max-height: 281px;
    overflow: auto;">
      <table width="100%" border="1" id="tableDetalleVenta" class="table responsive">
      <thead  id="theadDetalleVenta">
      </thead>
      <tbody id="tbodyDetalleVenta"></tbody>
    </table>
    </div>
	</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 " style="    padding: 0;">
  <button class="btn btn-sucess" style="    width: 100%;    background: #35ff35;    font-weight: bold;    color: #8e2121;">Tickear/Destickear todo</button>
		 <div class="col-xs-12" >
                    <label for="inputEmail3" class="col-sm-3 control-label">CAJERO:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="selectCajero" name="cajero" >
                                  
                                </select>
                            </div>        
        </div>
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       	 <label ><input type="checkbox" value="checkProductosVendidos" name="" checked="" id="checkProductosVendidos">&nbsp;Productos Vendidos</label><br>
       	 <label ><input type="checkbox" name="" id="checkTotaleGrupos">&nbsp;Totales de Grupos</label><br>
       	 <label ><input type="checkbox" name="" id="checkTotalCaja">&nbsp;Totales Caja</label><br>
       	 <label ><input type="checkbox" name="" id="checkFacturaCre">&nbsp;Facturas al Crédito</label><br>
       	 <label ><input type="checkbox" name="" id="checkFacturaAnu">&nbsp;Facturas Anuladas</label><br>
       	 <label ><input type="checkbox" name="" id="checkGastos">&nbsp;Gastos</label><br>
       	 <label ><input type="checkbox" name="" id="checkVentasDeli">&nbsp;Ventas delivery</label><br>
       	  <div class="col-sm-6">
       	  		<label>Total Caja:</label>
                <input type="number" step="0.01" class="form-control" name="cantidad" id="inputTotalCaja" placeholder="0.00 ">
          </div>
          <div class="col-sm-6">
       	  		<label>Venta del Día:</label>
                <input type="number" step="0.01" class="form-control" name="cantidad" id="inputVentaDia" placeholder="0.00 ">
          </div>
       	 <br>
       </div>
	</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-8 ">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<table class="table responsive" width="100%" style="    margin: 0;"  border="1" id="tableGrupo">
					<thead style="background: #9595d2;">
						<th>Nombre del Grupo</th>
						<th>Cantidad</th>
					</thead>
				</table>
        </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="    max-height: 198px;
    overflow: auto;">

        <table class="table responsive" width="100%"  border="1" >
         <thead style="background: #9595d2; display: none">
            <th>Nombre del Grupo</th>
            <th>Cantidad</th>
          </thead>
          <tbody id="tbodyGrupo" style="background:#ffe7a2;  font-weight: bold;"></tbody>
        </table>
        </div>
				<div class="col-xs-12" >
                    <label for="inputEmail3" class="col-sm-3 control-label">Entregado:</label>
                            <div class="col-sm-9">
                               <input type="" name="" class="form-control">
                            </div>         
       		    </div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " style="text-align: center;    padding: 0;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="    padding: 0;">
				<table class="" width="100%" border="1" style="    margin: 0;">
					<thead style="background: #9595d2 ; margin: 0" >
						<th style="    width: 33%;">Insumos</th>
						<th>Cantidad V</th>
						<th>Medida</th>
						<th>Cantidad M</th>
						<th>Medida M</th>
						<th>Cantidad X</th>
						<th>Medida X</th>
					</thead>
				</table>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="    padding: 0;" >

			<table class="table responsive" width="100%" border="1" >
					
          <tbody id="tbodyInsumo"></tbody>
				</table>
			</div>
				<button class="btn btn-warning btn-lg" onclick="imprimir()">IMPRIMIR</button>
        <div class="form-group" style="    display: inline-block;    margin-left: 23px;">
           <label>Exportar Reporte</label><br>
        <img src="imagenes/imgWord.png" style="  cursor: pointer; margin-right: 3px; width: 29px;">
        <img onclick="imprimirExcel('tableDetalleVenta');" src="imagenes/imgExcel.png" style=" cursor: pointer;  margin-right: 3px; width: 29px;">
        <img src="imagenes/imgPdf.png" onclick="imprimirPdf()" style=" cursor: pointer; margin-right: 3px;  width: 29px;">
        <img src="imagenes/imgPrevia.png" style=" cursor: pointer;  margin-right: 3px; width: 29px;">
        </div>
       
			</div>
	</div>
<?php
include "footer.php";
?>
 <script type="text/javascript" src="js/cierreDiario.js"></script>


<script type="text/javascript">
$('li[name=liCierreDiario]').addClass('active');
</script>