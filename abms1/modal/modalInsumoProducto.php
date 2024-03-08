
<div class="modal fade in" id="ModalaAgregarInsumo" role="dialog" data-backdrop="static">
   <form action="CONTROLADORES/insumoProductoController.php" id="formulario" enctype="multipart/form-data" method="POST"> 
    <div class="modal-dialog modal-lg">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center"><b>AGREGAR INSUMO AL PRODUCTO <span id="tituloInsumoProducto"></span></b></h4>

            </div>
            <div class="modal-body" style=" overflow-x: scroll;"">
    
      <input type="hidden" id="idProducto" name="productoInsumo">         
      <input type="hidden" id="idProducto" name="proceso" value="guardarInsumoProducto">         
<table id="ghatableInsumoProducto" class="ghatableInsumoProducto display table table-bordered table-stripe table-hover table-responsive" cellspacing="0" width="100%"> <!--jquery.dataTables.min.js -->
     
     <thead style="text-align: center">
               <th>CODIGO</th>
               <th>NOMBRE</th>
               <th>MEDIDA</th>
               <th>STOCK MINIMO</th>
               <th>STOCK ACTUAL</th>
               <th>SELECCIONAR INSUMO </th>
               <th>CANTIDAD</th>
     </thead>
     <tbody id="tbodyInsumoProducto">
         
     </tbody>
</table>  
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnGuardar" name="btnGuardarInsumoProducto" class="btn btn-success" onclick="">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">VOLVER</button>                        

            </div>
      
        </div>
    </div>
          </form>

</div>






<div class="modal fade in" id="ModalEliminarInsumoProducto" role="dialog" data-backdrop="static">

    <div class="modal-dialog">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center"><b>DESEA ELIMINAR EL INSUMO <span id="nombreInsumoE"></span></b></h4>

            </div>
            <div class="modal-body">
                  <input type="hidden" id="idInsumoEliminar" name="idInsumoEliminar">
            </div>
            <div class="modal-footer">
                <button type="submit" name="btnEliminarInsPro" class="btn btn-warning" onclick="eliminarInsumoProducto()">ELIMINAR</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">VOLVER</button>                        
            </div>
        </div>
    </div>  

</div>




<div class="modal fade in" id="ModalModificarCantidadInsumo" role="dialog" data-backdrop="static">

    <div class="modal-dialog">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center"><b>MODICAR LA CANTIDAD AL INSUMO <span id="nombreInsumo"></span></b></h4>

            </div>
            <div class="modal-body">
              <div class="col-sm-12">
                   <input type="hidden" name="idInsumoProducto" id="idInsumoProducto" class="form-control" >
                      <div class="form-group col-sm-5">
                          <label for="CantidadInsumo">CANTIDAD</label>
                          <input type="text" name="CantidadRelInsPro" class="form-control" id="CantidadRelInsPro" >
                      </div>
                      </div>
            </div>
         <div class="modal-footer">
                <button type="button" id="btnGuardar" name="bnModificarCantidadRelPro" onclick="modificarCantidadInsumo()" class="btn btn-success" onclick="">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">VOLVER</button>                        
            </div>
    </div>   
             

</div>

</div>



