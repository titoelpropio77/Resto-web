<?php
require("../class/Conexion.php");

require("../class/INSUMOS_MYSQL.class.php");
require("../class/PRODUCTOS_MYSQL.class.php");
include "headerF.php";
include "../modal/modalInsumos.php";
?>


<!-- <button type="button" class="btn btn-success " data-toggle="modal" data-target="#ModalGuardarInsumos">AGREGAR STOCK</button> -->
 <div class="col-sm-12">   
   <div class="col-sm-10">   
                    <div class="form-group col-xs-3">

                        <label for="inputEmail3" >NOMBRE DEL INSUMO:  </label> 
                            <input type="email" class="form-control" id="NombreInsumo" placeholder="Nombre Producto">
                    </div> <!-- form-goup -->
                    <div class="form-group col-xs-3">
                        <label for="inputEmail3" >MEDIDA  VENTA: </label>

                           <input type="text" name="" id="MedidaVenta" class="form-control">
                    </div> <!-- form-goup -->
                        <div class="form-group col-xs-3">
                        <label for="inputEmail3" >STOCK MINIMO: </label>

                            <input type="number" class="form-control" id="StockMinimo" placeholder=" INSTRODUZCA STOCK MINIMO">
                    </div>
                        <div class="form-group col-xs-3">
                        <label for="inputEmail3" >STOCK ACTUAL: </label>

                            <input type="number" class="form-control" id="StockActual" placeholder="INSTRODUZCA STOCK ACTUAL">
                    </div>
                     
                    </div>
                     <div class="col-sm-2">   
                      <div class="col-xs-12">
                        <button class="btn btn-info pull-left">BUSCAR PROVEEDOR</button>
                      </div>

                    </div>
                  <div class="col-sm-10">   
                       <div class="form-group col-xs-3">
                        
                    </div> <!-- form-goup -->
                    <div class="form-group col-xs-3">
                        <label for="inputEmail3" >MEDIDA MEDIA : </label>

                             <input class="form-control" id="MedidaMedia" type="text">
                    </div> <!-- form-goup -->
                        <div class="form-group col-xs-3">
                        <label for="inputEmail3" >OPERADOR: </label>

                            <input type="text" class="form-control" id="OperadorMedia" placeholder="INSTRODUZCA OPERADOR">
                    </div>
                        <div class="form-group col-xs-3">
                        <label for="inputEmail3" >EQUIVALENCIA: </label>

                            <input type="number" class="form-control" id="EquivalenciaMedia" placeholder="INSTRODUZCA EQUIVALENCIA">
                    </div>
                   
                    </div>
                     <div class="col-sm-2">   
                      <div class="col-xs-12">
                        <button class="btn btn-info pull-right">EQUVALENCIAS</button>
                      </div>
                      
                    </div>
                  <div class="col-sm-10">   

                     <div class="form-group col-xs-3">
                        
                    </div> <!-- form-goup -->
                     <div class="form-group col-xs-3">
                        <label for="inputEmail3" >MEDIDA MAXIMA : </label>

                            
                             <input type="text" class="form-control" id="MedidaMaxima">
                             
                    </div> <!-- form-goup -->
                     <div class="form-group col-xs-3">
                        <label for="inputEmail3" >OPERADOR: </label>

                            <input type="text" class="form-control" id="OperadorMaxima" placeholder="INSTRODUZCA OPERADOR">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="inputEmail3" >EQUIVALENCIA: </label>

                            <input type="number" class="form-control" id="EquivalenciaMaxima" placeholder="INSTRODUZCA EQUIVALENCIA">
                    </div>
                    </div>
                   
                   
                    <div class="form-group col-xs-2">
                          
                          <button type="submit" name="bts" class="btn btn-success pull-right" onclick="guardarInsumos()">Guardar</button>
                    </div>
                </div>
     <!-- <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">Agregar Categorias</button> -->
<table id="ghatable" class="ghatable display table table-bordered table-stripe table-hover table-responsive" cellspacing="0" width="100%"> <!--jquery.dataTables.min.js -->
     <thead style="text-align: center">
          
               <th>CODIGO</th>
               <th>NOMBRE</th>
               <th>MEDIDA</th>
               <th>STOCK MINIMO</th>
               <th>STOCK ACTUAL</th>
               <th>ESTADO</th>
               <th>STOCK AUMENTADO</th>
               <th>OPERACION</th>
           
     </thead>
     <tbody>
         <?php
                     $con = new Conexion();
                $conexcion = $con->ConexionDB() ;
                $insumos = new INSUMOS_MYSQL($con);
                 $listainsumo = $insumos->todo();
                for ($i=0; $i <count($listainsumo) ; $i++) { 
                  
                  echo '<tr  style="  text-align: center;"><td>'.$listainsumo[$i]->COD_INS.'<td>'.$listainsumo[$i]->NOM_INSUMO.'<td>'.$listainsumo[$i]->MEDIDA.'<td>'.$listainsumo[$i]->STOCK_MIN.'<td>'.$listainsumo[$i]->STOCK_ACT.'<td>'.$listainsumo[$i]->ESTADO.'
                  <td>'.$listainsumo[$i]->CAN_ADI.'
                  <td><button title="MODIFICAR INSUMO" onclick="cargarDatos('.$listainsumo[$i]->ID.')"  class="btn btn-info" title="EDITAR PRODUCTO" data-toggle="modal" data-target="#ModalModificarInsumos"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                  <button class="btn btn-danger"  title="ELIMINAR INSUMO"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                  ';
                  ?>
                  <button nombreInsumo="" data-toggle="modal" data-target="#ModalAumentarStock" onclick='$("#idInsumoStock").val(<?php echo $listainsumo[$i]->ID; ?>); $("#labelNInsumo").text("<?php echo $listainsumo[$i]->NOM_INSUMO; ?>")' class="btn btn-success" title="AUMENTAR STOCK"><i class="fa fa-plus"></i></button></tr>
                  <?php
                }
                // if ($listaregional !== null) {
                //     for ($index = 0; $index < count($listaregional); $index++) {
                       
                //     }
                // }
               
                ?>
     </tbody>
</table>   

<?php
include "footerF.php";
?>

    <script src="../js/plugins/jquery-ui.js"></script>
    <script src="../js/insumo.js"></script>


<script type="text/javascript">
  

var availableTags = [
  <?php 
     $con = new Conexion();
                $conexcion = $con->ConexionDB() ;
      $producto= new PRODUCTOS_MYSQL($con);
      $lista=$producto->todo();
      for ($i=0; $i <count($lista) ; $i++) { 
        echo  '"'.$lista[$i]->nom_prod.'",';
      }
   ?>
];
  $( "#NombreInsumo" ).autocomplete({
  source: availableTags
});


var availableTagsV = [

<?php
                           $con = new Conexion();
                          $conexcion = $con->ConexionDB() ;
                          $insumos = new INSUMOS_MYSQL($con);
                          $MostrarMedVenta = $insumos->MostrarMedVenta();
                         for ($i=0; $i <count($MostrarMedVenta) ; $i++) { 
                  
                  echo '"'.$MostrarMedVenta[$i]->MEDIDA.'",';
                }
     
                ?>
];

    $( "#MedidaVenta" ).autocomplete({
  source: availableTagsV
});
    var availableTagsM = [

<?php $con = new Conexion();
                          $conexcion = $con->ConexionDB() ;
                          $insumos = new INSUMOS_MYSQL($con);
                          $MostrarMedVenta = $insumos->MostrarMedMedia();
                         for ($i=0; $i <count($MostrarMedVenta) ; $i++) { 
                  
                  echo '"'.$MostrarMedVenta[$i]->MEDIDAM.'",';
                                   }
     
                ?>
];

    $( "#MedidaMedia" ).autocomplete({
  source: availableTagsM
});var availableTagsX = [
 <?php
                           $con = new Conexion();
                          $conexcion = $con->ConexionDB() ;
                          $insumos = new INSUMOS_MYSQL($con);
                          $MostrarMedVenta = $insumos->MostrarMedMaxima();
                         for ($i=0; $i <count($MostrarMedVenta) ; $i++) { 
                  
                  echo '"'.$MostrarMedVenta[$i]->MEDIDAX.'",';
                
               
               }
                ?>
               
];

    $( "#MedidaMaxima" ).autocomplete({
  source: availableTagsX
});

</script>