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

include "modal/modalPersonal.php";
   ?> 


     <!--<a href="create.php" class="btn btn-success btn-md"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Producto</a><br/>-->
      <div class="panel panel-info" style="box-shadow: 0 0 35px 8px black;">
      <div class="panel-heading">
        <ul class="nav nav-tabs">
  <li ><a href="productos.php"><b>PRODUCTO</b></a></li>
  <li><a href="inventario.php"><b>INVENTARIO Y PRODUCCION</b></a></li>
  <li><a href="#" data-toggle="modal" data-target="#ModaGestionImpresion"><b>GESTIONAR IP DE IMPRESION</b></a></li>
  <li class="active"><a href="#" ><b>PERSONAL</b></a></li>
  <li><a href="frmMesas.php" ><b>MESAS</b></a></li>
  <li ><a href="frmUsuario.php" ><b>USUARIO</b></a></li>
  <li ><a href="frmEmpresa.php" ><b>EMPRESA</b></a></li>
</ul>
</div>
      <div class="panel-body">
     <button type="button" class="btn btn-success " data-toggle="modal" data-target="#modalPersonal">NUEVO PERSONAL</button>
     <!-- <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">Agregar Categorias</button> -->
</p>
<div class="row">

 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="    overflow-x: scroll;">
<table id="tablaPersonal" class="table table-bordered table-hover table-responsive table-condensed dataTable" > <!--jquery.dataTables.min.js -->
     <thead style="text-align: left;">
          <tr>
               <th style="    padding-left: 0;">COD</th>
               <th style="padding-left: 0; ">NOMBRE</th>
               <th style="    padding-left: 0;">DIRECCION</th>
               <th style="    padding-left: 0;">C.I.</th>
               <th style="    padding-left: 0;">CARGO</th>
               <th style="    padding-left: 0;">SALARIO</th>
               <th style="    padding-left: 0;">COLOR</th>
               <th style="    padding-left: 0;">OPERACION</th>
         </tr>
     </thead>
     <tbody id="tbodyPersonal">
         
     </tbody>
</table>   
</div>
</div>
</div>

    </div>
 
<?php
include "footer.php";
//include "modal/modalInsumoProducto.php";





?>

<script type="text/javascript" src="js/personal.js"></script>

    <script type="text/javascript">
      // $('#basicExample').timepicker({ 'scrollDefault': 'now' });
      $('#loading').css('display','none');
    $('li[name=liMantenimiento]').addClass('active');
    </script>
<!-- ESTA CONSULTA ME GENERA LOS PRODUCTOS QUE PERTENECEN A UN GRUPO -->
<!--     SELECT (productos_mysql.cantidad*productos_mysql.unid*relprogru_mysql.FACTOR) as cantidad,  grupos_mysql.NOM_GRUPO FROM relprogru_mysql,grupos_mysql,productos_mysql where relprogru_mysql.COD_PROD=productos_mysql.cod_prod and relprogru_mysql.COD_GRUPO=grupos_mysql.COD_GRUPO and productos_mysql.cod_prod=2 -->

<!-- SELECT (detalles_mysql.cantidad*detalles_mysql.unid*relprogru_mysql.FACTOR) as cantidad, grupos_mysql.NOM_GRUPO FROM relprogru_mysql,grupos_mysql,detalles_mysql where relprogru_mysql.COD_PROD=detalles_mysql.cod_prod and relprogru_mysql.COD_GRUPO=grupos_mysql.COD_GRUPO and detalles_mysql.cod_prod=2 -->

<!-- SELECT (sum(detalles_mysql.cantidad)*detalles_mysql.unid*relprogru_mysql.FACTOR) as cantidad, grupos_mysql.NOM_GRUPO ,grupos_mysql.COD_GRUPO FROM relprogru_mysql,grupos_mysql,detalles_mysql where relprogru_mysql.COD_PROD=detalles_mysql.cod_prod and relprogru_mysql.COD_GRUPO=grupos_mysql.COD_GRUPO and detalles_mysql.cod_prod=2 and grupos_mysql.COD_GRUPO=8 -->