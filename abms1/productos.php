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
include "modal/modalProducto.php";
include "modal/modalGrupo.php";
include "modal/modalInsumoProducto.php";
include "modal/modalMenuGrupo.php";
include "modal/modalOpProducto.php";
include "alerts/cargando.php";
include "modal/modalGestionImpresion.php";

   ?> 


     <!--<a href="create.php" class="btn btn-success btn-md"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Producto</a><br/>-->
      <div class="panel panel-info" style="box-shadow: 0 0 35px 8px black;">
      <div class="panel-heading">
        <ul class="nav nav-tabs">
  <li class="active"><a href="#"><b>PRODUCTO</b></a></li>
  <li><a href="inventario.php"><b>INVENTARIO Y PRODUCCION</b></a></li>
  <li><a href="#" data-toggle="modal" data-target="#ModaGestionImpresion"><b>GESTIONAR IP DE IMPRESION</b></a></li>
  <li><a href="frmPersonal.php" ><b>PERSONAL</b></a></li>
  <li><a href="frmMesas.php" ><b>MESAS</b></a></li>
  <li ><a href="frmUsuario.php" ><b>USUARIO</b></a></li>
  <li ><a href="frmEmpresa.php" ><b>EMPRESA</b></a></li>
</ul>
</div>
      <div class="panel-body">
     <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">NUEVO PRODUCTO</button>
   <button onclick=" window.open('edicionDirecta/edicionDirectaCategoria.php');"  type="button" class="btn btn-info pull-right" >EDICION DIRECTA CATEGORIA</button>
   <button onclick=" window.open('edicionDirecta/edicionDirectaProducto.php');"  type="button" class="btn btn-warning pull-right" >EDICION DIRECTA PRODUCTO</button>

     <!-- <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">Agregar Categorias</button> -->
</p>
<div class="row">

 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="    overflow-x: scroll;">
<table id="ghatable" class="table table-bordered table-hover table-responsive table-condensed dataTable" > <!--jquery.dataTables.min.js -->
     <thead style="text-align: left;">
          <tr>
               <th style="    padding-left: 0;">COD</th>
               <th style="padding-left: 0; ">NOMBRE</th>
               <th style="    padding-left: 0;">Cant</th>
               <th style="    padding-left: 0;">Unidad</th>
               <th style="    padding-left: 0;">Precio</th>
               <th style="    padding-left: 0;">Categoria</th>
               <th style="     width: 68.0208px;   padding-left: 0;">Estado</th>
               <th style="    padding-left: 0;">Acción</th>
               <th style=" text-align: center;">Agregar Receta</th>
               <th style="text-align: center;">Grupo</th>
               <!-- <th>Color</th> -->
               <!-- <th>Operacion</th> -->
            
  
         </tr>
     </thead>
     <tbody id="datos">
         
     </tbody>
</table>   
</div>
</div>
</div>

    </div>
 
<?php
include "footer.php";
?>

    <script src="js/menuGrupo.js"></script>

    <script src="js/producto.js"></script>
    <script src="js/productoGrupo.js"></script>
 
    <script src="js/insumoProducto.js"></script>
    <script src="js/grupo.js"></script>
    <script src="js/opProducto.js"></script>
    <script src="js/plugins/adminlte.js"></script>
    <script type="text/javascript">
      // $('#basicExample').timepicker({ 'scrollDefault': 'now' });
      $(".horaIni").timepicker({
      showInputs: false,
      'timeFormat': 'H:i',
      showMeridian:false,
      value:'6:00',
      showSeconds:false,
      defaultTime:'00:00'
    });
       $(".horaFin").timepicker({
      showInputs: false,
      showMeridian:false,
       defaultTime:'00:00'
    });
$('li[name=liMantenimiento]').addClass('active');

    </script>
<!-- ESTA CONSULTA ME GENERA LOS PRODUCTOS QUE PERTENECEN A UN GRUPO -->
<!--     SELECT (productos_mysql.cantidad*productos_mysql.unid*relprogru_mysql.FACTOR) as cantidad,  grupos_mysql.NOM_GRUPO FROM relprogru_mysql,grupos_mysql,productos_mysql where relprogru_mysql.COD_PROD=productos_mysql.cod_prod and relprogru_mysql.COD_GRUPO=grupos_mysql.COD_GRUPO and productos_mysql.cod_prod=2 -->

<!-- SELECT (detalles_mysql.cantidad*detalles_mysql.unid*relprogru_mysql.FACTOR) as cantidad, grupos_mysql.NOM_GRUPO FROM relprogru_mysql,grupos_mysql,detalles_mysql where relprogru_mysql.COD_PROD=detalles_mysql.cod_prod and relprogru_mysql.COD_GRUPO=grupos_mysql.COD_GRUPO and detalles_mysql.cod_prod=2 -->

<!-- SELECT (sum(detalles_mysql.cantidad)*detalles_mysql.unid*relprogru_mysql.FACTOR) as cantidad, grupos_mysql.NOM_GRUPO ,grupos_mysql.COD_GRUPO FROM relprogru_mysql,grupos_mysql,detalles_mysql where relprogru_mysql.COD_PROD=detalles_mysql.cod_prod and relprogru_mysql.COD_GRUPO=grupos_mysql.COD_GRUPO and detalles_mysql.cod_prod=2 and grupos_mysql.COD_GRUPO=8 -->