<?php
require("../class/personal.php");
require("../class/paises.php");
require("../class/menugrupo.php");

include "headerF.php";
?>

<!-- Modal -->


<!--//*****************************************************************-->
<!--// EDITAR PRODUCTOS echo '<script type="text/javascript">alert(\'Lo estamos redireccionando\');</script>';  echo '<script>alert (" Ha respondido '.$nm.' respuestas afirmativas");</script>';-->
<!--///***************************************************************** -->



  <?php 
//include "../alerts/cargando.php";
   ?>
     <!--<a href="create.php" class="btn btn-success btn-md"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Producto</a><br/>-->
      

     <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">Agregar Producto</button>
     <!-- <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">Agregar Categorias</button> -->


<table id="ghatable" class="ghatable table table-bordered table-striped dataTable no-footer" > <!--jquery.dataTables.min.js -->
     <thead style="text-align: center">
          
               <th>Codigo</th>
               <th>Nombre</th>
               <th>Unidad</th>
               <th>Precio</th>
               <th>Estado</th>
               <th>Operacion</th>
               <th>Insumo</th>

         
     </thead>
     <tbody>
          <?php
        
          $objpersonal = new Personal();
          $personal = $objpersonal->personal();
          if (!$personal) {
            echo "no hubo conexion";
          }
          if(sizeof($personal) > 0){
               foreach ($personal as $row){
                    ?>                    
                    <tr style="text-align: center">
                         <td><?php echo $row['cod_prod'] ?></td>
                         <td><?php echo $row['nom_prod'] ?></td>
                         <td><?php echo $row['unid'] ?></td>
                         <td><?php echo $row['pre_venta'] ?></td>
                         <td><?php echo $row['estado'] ?></td>
                          <td>
                             <button onclick="cargarDatosProducto(<?php echo $row['id'] ?>)" class="btn btn-info" title="EDITAR PRODUCTO" data-toggle="modal" data-target="#myModaledit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                              <!-- <button type="button" class="glyphicon glyphicon-pencil" aria-hidden="true"" data-toggle="modal" data-target="#myModaledit"></button>-->
                      
                              <!-- <a onclick="return confirm('Desea eliminar el registro')" href="delete.php?d=<?php //echo $row['id'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Elimina</a> -->
                               <button onclick="cargarDatosProducto(<?php echo $row['id'] ?>)" class="btn btn-danger" title="ELIMINAR PRODUCTO" data-toggle="modal" data-target="#myModaledit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                     
                         </td>
                         <td><?php 
                            echo "<div class='box box-warning direct-chat direct-chat-warning collapsed-box' id='' ><button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-plus'></i></button>
             <div class='box-body' style='display: none;'>
             <table class=''>
                <thead><th><CENTER>FECHA</CENTER></th><th><CENTER>MONTO</CENTER></th></thead>
                <tbody id='body_detcuota></tbody>\
             </table> </div>  </div>";   
                          ?></td>
                    
                        
                        
                         
                    </tr>
                    <?php
               }
          }
          ?>
     </tbody>
</table>   
    <script src="../js/producto.js"></script>
    <script src="../js/menuGrupo.js"></script>
 
<?php
include "footerF.php";
?>
