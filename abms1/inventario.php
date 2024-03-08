<?php


include "header.php";
?>



<!--//*****************************************************************-->
<!--// EDITAR PRODUCTOS echo '<script type="text/javascript">alert(\'Lo estamos redireccionando\');</script>';  echo '<script>alert (" Ha respondido '.$nm.' respuestas afirmativas");</script>';-->
<!--///***************************************************************** -->



  <?php 
include "modal/modalMenuGrupo.php";
   ?>
     <!--<a href="create.php" class="btn btn-success btn-md"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Producto</a><br/>-->
   <div class="panel panel-info" style="box-shadow: 0 0 35px 8px black;">
      <div class="panel-heading">
        <ul class="nav nav-tabs">
  <li ><a style="cursor: pointer;" href="productos.php"><b>PRODUCTO</b></a></li>
  <li class="active"><a href="inventario.php"><b>INVENTARIO Y PRODUCCION</b></a></li>
  <li><a href="#" data-toggle="modal" data-target="#ModaGestionImpresion"><b>GESTIONAR IP DE IMPRESION</b></a></li>
  <li><a  href="frmPersonal.php"  ><b>PERSONAL</b></a></li>
  <li><a href="frmMesas.php"  ><b>MESAS</b></a></li>
  <li ><a href="frmUsuario.php" ><b>USUARIO</b></a></li>
  <li ><a href="frmEmpresa.php" ><b>EMPRESA</b></a></li>
</ul>
</div>
      <div class="panel-body">
   <div class="panel panel-info" style="box-shadow: 0 0 35px 8px black;">
      <div class="panel-heading">
        <ul class="nav nav-tabs">
  <li class="active"  ><a style="cursor: pointer;" url="formularios/movimientoDiario.php" onclick="cambiarFormulario(this)"><b>MOVIMIENTO DIARIO</b></a></li>
  <li  ><a href="#" url="formularios/insumos.php" id="frmInsumos" onclick="cambiarFormulario(this)"><b>INSUMOS </b></a></li>
  <li  ><a href="#" id="frmReporteDInsumos" onclick="cambiarFormulario(this)"><b>REPORTE DETALLADO </b></a></li>
  <li  ><a href="#" id="frmReporteDGeneral" onclick="cambiarFormulario(this)"><b>REPORTE GENERAL </b></a></li>
  <li  ><a href="#" url="formularios/receta.php" id="frmReceta" onclick="cambiarFormulario(this)"><b>RECETA </b></a></li>
  <li class="pull-right" ><a href="#" class="btn btn-danger" ><b>VOLVER </b></a></li>
</ul>
</div>
      <div class="panel-body">
     <iframe id="iframe" src="formularios/movimientoDiario.php" style="width: 100%; height: 640px; border: none"></iframe>
</div>
    </div>
</div>
    </div>
 
<?php
include "footer.php";
?>
    <script src="js/menuGrupo.js"></script>
    <script type="text/javascript">
      $('li[name=liMantenimiento]').addClass('active');
    </script>
