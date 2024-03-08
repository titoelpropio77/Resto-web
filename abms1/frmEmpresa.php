<?php


include "header.php";
?>

<style type="text/css">
body{
  background-color:#FBFFFF;
}
</style>
<!-- Modal -->

<!--//*****************************************************************-->
<!--// EDITAR PRODUCTOS echo '<script type="text/javascript">alert(\'Lo estamos redireccionando\');</script>';  echo '<script>alert (" Ha respondido '.$nm.' respuestas afirmativas");</script>';-->
<!--///***************************************************************** -->


<?php 

include "alerts/cargando.php";

   ?> 


     <!--<a href="create.php" class="btn btn-success btn-md"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Producto</a><br/>-->
      <div class="panel panel-info" style="box-shadow: 0 0 35px 8px black;">
      <div class="panel-heading">
        <ul class="nav nav-tabs">
  <li ><a href="productos.php"><b>PRODUCTO</b></a></li>
  <li><a href="inventario.php"><b>INVENTARIO Y PRODUCCION</b></a></li>
  <li><a href="#" data-toggle="modal" data-target="#ModaGestionImpresion"><b>GESTIONAR IP DE IMPRESION</b></a></li>
  <li ><a href="frmPersonal.php" ><b>PERSONAL</b></a></li>
  <li ><a href="#" ><b>MESAS</b></a></li>
  <li ><a href="frmUsuario.php" ><b>USUARIO</b></a></li>
  <li class="active"><a href="frmEmpresa.php" ><b>EMPRESA</b></a></li>
</ul>
</div>
      <div class="panel-body">
    

<form enctype="multipart/form-data" id="formEmpresa">
   <button type="button" class="btn btn-success " onclick="$('.form-control').attr('readonly',false);$('#llave').attr('readonly',false)">NUEVA </button>
     <button type="submit" class="btn btn-warning "  >GRABAR</button>
<div class="row">
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 " >

    <label>Nombre de la Empresa</label>
   <input type="text" readonly=""    name="nombreEmp" class="form-control" placeholder="NOMBRE DE LA EMPRESA">
</div>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 " >

    <label>Nombre de la Sucursal</label>
   <input type="text" readonly=""    name="nombreSuc" class="form-control" placeholder="NOMBRE DE LA SUCURSAL">
</div>
 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 " >

    <label>Telefono:</label>
   <input type="text" readonly=""    name="telefono" class="form-control" placeholder="TELEFONO">
</div>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 " >

    <label>DIRECCION:</label>
   <input type="text" readonly=""    name="direccion" class="form-control" placeholder="DIRECCION">
</div>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 " >

    <label>PAIS-CIUDAD:</label>
   <input type="text" readonly=""    name="paisCiudad" class="form-control" placeholder="PAIS-CIUDAD">
</div>
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
 <label>FACTURAS</label><br>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >
 <label>NIT</label>
   <input type="text" readonly=""    name="nit" class="form-control" placeholder="NIT">
</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >
 <label>NUM. ORDEN</label>
   <input type="text" readonly=""    name="numOrden" class="form-control" placeholder="NUM ORDEN">
</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >
 <label>ALFNUM</label>
   <input type="text" readonly=""    name="alfNum" class="form-control" placeholder="ALFNUM">
</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >
 <label>INICIO FACTURA</label>
   <input type="text" readonly=""    name="InicioFactura" class="form-control" placeholder="INICIO FACTURA">
</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >
 <label>FIN FACTURA</label>
   <input type="text" readonly=""    name="finFactura" class="form-control" placeholder="FIN FACTURA">
</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >
 <label>FACTURA ACTUAL</label>
   <input type="text" readonly=""    name="facturaActual" class="form-control" placeholder="FACTURA ACTUAL">
</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >
 <label>NRO. AUTORIZACION</label>
   <input type="text" readonly=""    name="numAutorizacion" class="form-control" placeholder="NRO. AUTORIZACION">
</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >
 <label>FECHA LIMITE</label>
  
   <input type="text" readonly=""    name="fechaLimite" class="form-control" placeholder="FECHA LIMITE">
</div>
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 " >
 <label>LLAVE</label>
   <textarea readonly="" name="llave" id="llave" rows="4" cols="50" style="width: 100%" placeholder="LLAVE">
</textarea>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
         <label for="inputEmail3" class="col-sm-3 control-label">DOCIFICACION:</label>
                 
             <!-- <input type="file" name="foto" id="imagenProducto" size="30"  onclick="cargarImagen2(this,1)"> -->
             <!-- <canvas id='canvas' style='display: none;'></canvas> -->
              <img id="foto" src="imagenes/docificacion.png" alt="Comida"  onclick="cargarImagen(this,1)"  style="width: 100px;
    height: 78px; cursor: pointer;" />
    <input type="file" name="archivoDocificacion" id="fotocargar" style="    visibility: hidden;">
                

</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <label for="inputEmail3" class="col-sm-3 control-label">Inicio de Horario Turno Mañan:</label>
         <div class="col-sm-3">
             <input  readonly="" class="form-control" name="turnoIni" id="turnoIni" >
   </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <label for="inputEmail3" class="col-sm-3 control-label">Fin de Horario Turno Mañan:</label>
         <div class="col-sm-3">
             <input  readonly=""  class="form-control" name="turnoFin" id="turnoFin" >
   </div>
</div>
</div>
</div>
</div>
 </form>
</div>

    </div>

<?php
include "footer.php";
//include "modal/modalInsumoProducto.php";

?>

<script type="text/javascript" src="js/empresa.js"></script>

    <script type="text/javascript">
     
      $('#loading').css('display','none');
    $('li[name=liMantenimiento]').addClass('active');
    </script>
<!-- ESTA CONSULTA ME GENERA LOS PRODUCTOS QUE PERTENECEN A UN GRUPO -->
<!--     SELECT (productos_mysql.cantidad*productos_mysql.unid*relprogru_mysql.FACTOR) as cantidad,  grupos_mysql.NOM_GRUPO FROM relprogru_mysql,grupos_mysql,productos_mysql where relprogru_mysql.COD_PROD=productos_mysql.cod_prod and relprogru_mysql.COD_GRUPO=grupos_mysql.COD_GRUPO and productos_mysql.cod_prod=2 -->

<!-- SELECT (detalles_mysql.cantidad*detalles_mysql.unid*relprogru_mysql.FACTOR) as cantidad, grupos_mysql.NOM_GRUPO FROM relprogru_mysql,grupos_mysql,detalles_mysql where relprogru_mysql.COD_PROD=detalles_mysql.cod_prod and relprogru_mysql.COD_GRUPO=grupos_mysql.COD_GRUPO and detalles_mysql.cod_prod=2 -->

<!-- SELECT (sum(detalles_mysql.cantidad)*detalles_mysql.unid*relprogru_mysql.FACTOR) as cantidad, grupos_mysql.NOM_GRUPO ,grupos_mysql.COD_GRUPO FROM relprogru_mysql,grupos_mysql,detalles_mysql where relprogru_mysql.COD_PROD=detalles_mysql.cod_prod and relprogru_mysql.COD_GRUPO=grupos_mysql.COD_GRUPO and detalles_mysql.cod_prod=2 and grupos_mysql.COD_GRUPO=8 -->