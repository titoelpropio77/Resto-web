 <form id="frmMesaGuardar" enctype="multipart/form-data">
<div class="modal fade in" id="modalMesa" role="dialog" data-backdrop="static">
    <div class="modal-dialog">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <b> Registro de Nuevo Mesa</b></h4>
            </div>
            <div class="modal-body" style="    max-height: 477px;
    overflow: auto;">
                <div class="col-sm-12">
                    <input type="hidden" value="guardar" name="proceso">
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-3 control-label">MESA: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nombreMesa" id="nombreMesa" placeholder="Nro de Mesa">
                            </div>
                        </div>
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-3 control-label">ORDEN: </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="orden" id="orden" placeholder="Orden de Mesa">
                            </div>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-2 control-label">Estado: </label>
                            <div class="col-sm-10">
                                <select id="estadoMesa" class="form-control" name="estadoMesa">
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                </select>
                            </div>
                        </div>
                       
                        
                 </div>                                    
                </div>                                    
                <div class="modal-footer">
                    <button type="submit" name="bts" class="btn btn-success" >Guardar</button>
                 <input class="btn btn-danger" type="reset" data-dismiss="modal" onclick="$('#frmFormulario')[0].reset();"   value="VOLVER">             

                </div>
            </div>
        </div>  
 

    </div>
   </form>


    <form id="frmMesaModificar" enctype="multipart/form-data">
<div class="modal fade in" id="modalMesaModificar" role="dialog" data-backdrop="static">
    <div class="modal-dialog">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <b> MODIFICAR MESA</b></h4>
            </div>
            <div class="modal-body" style="    max-height: 477px;
    overflow: auto;">
                 <div class="col-sm-12">
                    <input type="hidden" value="modificar" name="proceso">
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-3 control-label">MESA: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nombreMesa" id="nombreMesaA" placeholder="Nro de Mesa">
                            </div>
                        </div>
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-3 control-label">ORDEN: </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="orden" id="ordenA" placeholder="Orden de Mesa">
                            </div>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-2 control-label">Estado: </label>
                            <div class="col-sm-10">
                                <select id="estadoMesaA" class="form-control" name="estadoMesa">
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                </select>
                            </div>
                        </div>
                 </div>             
                </div>                                    
                <div class="modal-footer">
                    <button type="submit" name="bts" class="btn btn-success" >Guardar</button>
                 <input class="btn btn-danger" type="reset" data-dismiss="modal" onclick="$('#frmFormulario')[0].reset();"   value="VOLVER">             

                </div>
            </div>
        </div>  
 

    </div>
   </form>