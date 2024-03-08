

<div class="modal fade in" id="ModalGuardarInsumos" role="dialog" data-backdrop="static">
    <form role="form" method="post">
    <div class="modal-dialog modal-lg" style="width: 100%">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center"><b>MODIFICAR GRUPO</b></h4>

            </div>
            <div class="modal-body">
               

            </div>
            <div class="modal-footer">
                <button type="submit" name="bts" class="btn btn-success" onclick="guardarInsumos()">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">VOLVER</button>                        
            </div>
      
        </div>
    </div>   
          </form>   
</div>



<div class="modal fade in" id="ModalModificarInsumos" role="dialog" data-backdrop="static">ç
    <form id="frmModificarInsumos"  enctype="multipart/form-data">   

    <div class="modal-dialog modal-lg"  style="width: 100%">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center"><b>MODIFICAR GRUPO</b></h4>

            </div>
            <div class="modal-body">
                               <div class="col-sm-12">   
   <div class="col-sm-10">   
                    <div class="form-group col-xs-3">
                    <input type="hidden" name="idInsumo" value="" id="idInsumo">
                        <label for="inputEmail3" >NOMBRE DEL INSUMO:  </label> 
                            <input type="text" class="form-control" name="nombreInsumo" id="NombreInsumoA" placeholder="Nombre Producto">
                            <input type="hidden" name="proceso" value="modificar">
                    </div> <!-- form-goup -->
                    <div class="form-group col-xs-3">
                        <label for="inputEmail3" >MEDIDA  VENTA: </label>

                           <input type="text"  id="MedidaVentaA" name="medidaVenta" class="form-control">
                    </div> <!-- form-goup -->
                        <div class="form-group col-xs-3">
                        <label for="inputEmail3" >STOCK MINIMO: </label>

                            <input type="number"  step="0.001" class="form-control" name="stockMinimo" id="StockMinimoA" placeholder=" INSTRODUZCA STOCK MINIMO">
                    </div>
                        <div class="form-group col-xs-3">
                        <label for="inputEmail3" >STOCK ACTUAL: </label>

                            <input type="number" step="0.001" class="form-control" name="stockActual" id="StockActualA" placeholder="INSTRODUZCA STOCK ACTUAL">
                    </div>
                     
                    </div>
                    
                  <div class="col-sm-10">   
                       <div class="form-group col-xs-3">
                        
                    </div> <!-- form-goup -->
                    <div class="form-group col-xs-3">
                        <label for="inputEmail3" >MEDIDA MEDIA : </label>

                             <input class="form-control" name="medidaMedia" id="MedidaMediaA" type="text">
                    </div> <!-- form-goup -->
                        <div class="form-group col-xs-3">
                        <label for="inputEmail3" >OPERADOR: </label>

                            <input type="text" class="form-control" name="operadorMedia" id="OperadorMediaA" placeholder="INSTRODUZCA OPERADOR">
                    </div>
                        <div class="form-group col-xs-3">
                        <label for="inputEmail3" >EQUIVALENCIA: </label>

                            <input type="number"  step="0.001" class="form-control" name="equivalenciaMedia" id="EquivalenciaMediaA" placeholder="INSTRODUZCA EQUIVALENCIA">
                    </div>
                   
                    </div>
                    
                  <div class="col-sm-10">   

                     <div class="form-group col-xs-3">
                        
                    </div> <!-- form-goup -->
                     <div class="form-group col-xs-3">
                        <label for="inputEmail3" >MEDIDA MAXIMA : </label>

                            
                             <input type="text" class="form-control" name="medidaMaxima" id="MedidaMaximaA">
                             
                    </div> <!-- form-goup -->
                     <div class="form-group col-xs-3">
                        <label for="inputEmail3" >OPERADOR: </label>

                            <input type="text" class="form-control" name="operadorMaxima" id="OperadorMaximaA" placeholder="INSTRODUZCA OPERADOR">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="inputEmail3" >EQUIVALENCIA: </label>

                            <input type="number" step="0.001" class="form-control" name="equivalenciaMaxima" id="EquivalenciaMaximaA" placeholder="INSTRODUZCA EQUIVALENCIA">
                    </div>
                    </div>
                   
                   
                  
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" name="bts" class="btn btn-success" onclick="">GUARDAR</button>
                <button type="reset" class="btn btn-danger" data-dismiss="modal">VOLVER</button>                        
            </div>
        </div>
    </div>    
                </form>  

</div>




<div class="modal fade in" id="ModalAumentarStock" role="dialog" data-backdrop="static">
    <form  id="frmAumentarStock" enctype="multipart/form-data">
    <div class="modal-dialog modal-sm" >    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center"><b>AUMENTAR STOCK AL INSUMO <label id="labelNInsumo"></label></b></h4>

            </div>
            <div class="modal-body">
               <div class="row">
                   <div class="col-xs-12">
                        <input type="hidden" name="proceso" value="aumentarStock">
                       <input type="hidden" name="fechaActual">
                       <input type="hidden" name="idInsumo" id="idInsumoStock" class="form-control">
                        <label>RECEPCION DE INSUMO</label>
                       <input type="number" name="recepcion" id="iRecepcion" class="form-control" onchange="InsumoRecepcionPerdida()" step="0.01">
                       <label>PERDIDA DE INSUMO</label>
                       <input type="number" name="perdida" id="iPerdida" class="form-control" onchange="InsumoRecepcionPerdida()" step="0.01">
                        <label>TOTAL STOCK </label>
                       <input type="number" name="total" id="totalStock" class="form-control" step="0.01">
                   </div>
               </div>

            </div>
            <div class="modal-footer">
                <button type="submit" name="bts" class="btn btn-success" >Guardar</button>
                <button type="reset" class="btn btn-danger" data-dismiss="modal" onclick="$('#frmAumentarStock')[0].reset()">VOLVER</button>                        
            </div>
      
        </div>
    </div>   
          </form>   
</div>

