<?php
include "header.php";
 require("../verificador.php");

?>
<script type="text/javascript">
            impresionnube= "<?php echo verificarimpresionnube(); ?>";
  
</script>
   <link href="jQuery-contextMenu/jquery.contextMenu.css" rel="stylesheet">     


<div class="modal fade in" id="ModalMesasHabilitadas" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">    
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center"><b>MESAS HABILITADAS<span id="tituloProductoNota"></span></b></h4>

            </div>
            <div class="modal-body" style=" overflow-x: auto;">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="divMesaHabilitadas">
                   
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">VOLVER</button>                        

            </div>

        </div>
    </div>

</div>

<div class="modal fade in" id="ModalMeseros" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">    
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center"><b>MESEROS<span id="tituloProductoNota"></span></b></h4>

            </div>
            <div class="modal-body" style=" overflow-x: auto;">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="divMeseros">
                   
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">VOLVER</button>                        

            </div>

        </div>
    </div>

</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="      background: #b2e2cc;  overflow-x: scroll;">
  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
    <label>FILTRO:&nbsp;&nbsp;&nbsp;</label><label><input type="radio" name="tipoPago" value="CONTADO">Contado&nbsp;&nbsp;&nbsp;</label><label><input value="CREDITO" type="radio" name="tipoPago" style="margin-left: 45px;">Credito&nbsp;&nbsp;&nbsp;</label><label  style="margin-left: 45px;"><input value="CONSUMO" type="radio" name="tipoPago">Consumo&nbsp;&nbsp;&nbsp;</label><label style="margin-left: 45px;"><input value="contadocredito" type="radio" name="tipoPago">Contado y Credito</label><label style="margin-left: 45px;"><input value="todos" checked="" type="radio" name="tipoPago">Todos</label>
	</div>
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 " style="">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="    padding: 0;">
        <table class="" width="100%" border="1" style="    margin: 0;">
          <thead style="background: #9595d2 ; margin: 0" >
            <th>Cantidad</th>
        <th>Producto</th>
        <th>Sub Total</th>
          </thead>
        </table>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="    padding: 0;    height: 231px;
    overflow: auto;" >

      <table class="table responsive" width="100%" border="1" >
          
      <tbody id="tbodyReporteCaja" style="background: white"></tbody>
        </table>
      </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="padding: 0;">
 <table id="" border="1" class="table responsive" style="margin: 0;" >
      <thead style="background: #9595d2">
        <th>Nombre del Grupo</th>
        <th>Cantidad</th>

        <th></th>
      </thead>
    </table>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="    padding: 0;    height: 231px;
    overflow: auto;" >

      <table class="table responsive" width="100%" border="1" >
          
      <tbody id="tbodyGrupo" style="background: white"></tbody>
        </table>
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

        <button class="btn btn-default btn-lg" style="margin-top: 40px;    width: 100%;" id="btnMesasMeseros">MESAS / MESERO</button><br>
        <!-- <button class="btn btn-warning btn-lg" onclick="$('#inputTotalVentas').val('');$('#inputTotalCaja').val('');$('#inputTotalCredito').val('');$('#tbodyReporteCaja').empty();$('#inputTotalGastos').val('');$('#inputTotalIngesos').val('');" style="margin-top: 4px;    width: 100%;">LIMPIAR PANTALLA</button><br> -->
        <button class="btn btn-warning btn-lg" style="margin-top: 4px;    width: 100%;" onclick="listarReporteProductos();listarGrupoDada2Fechas()">GENERAR</button><br>
        <button class="btn btn-warning btn-lg" style="margin-top: 4px;    width: 100%;    background: yellow;   color: black;" onclick="">RANKING DE VENTA</button><br>
        <button class="btn btn-warning btn-lg" style="margin-top: 4px;    width: 100%;" onclick="imprimirReporte()">IMPRIMIR</button><br>
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">  
        <label>Total Caja:</label>
        <input type="text" name="" class="form-control" id="totalCaja">
       </div>
       
<!-- <label>Exportar Reporte</label><br>
        <img onclick="imprimirExcel()" src="imagenes/imgExcel.png" style="cursor: pointer;   margin-right: 3px; width: 29px;">
        <img src="imagenes/imgWord.png" style="   margin-right: 3px; width: 29px;">
        <img src="imagenes/imgWord.png" style="  margin-right: 3px;  width: 29px;">
        <img src="imagenes/imgWord.png" style="   margin-right: 3px; width: 29px;"> -->
       </div>
  </div>
	

	</div>
<?php
include "footer.php";
?>
   
    <script type="text/javascript" src="js/reporteProductos.js"></script>
<script type="text/javascript" src="jQuery-contextMenu/jquery.ui.position.js"></script>
    <script type="text/javascript" src="jQuery-contextMenu/jquery.contextMenu.js"></script>
<script type="text/javascript">

$('li[name=liReporteProducto]').addClass('active');


</script>