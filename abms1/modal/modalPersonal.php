 <form id="frmPersonalGuardar" enctype="multipart/form-data">
<div class="modal fade in" id="modalPersonal" role="dialog" data-backdrop="static">
    <div class="modal-dialog">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <b> Registro de Nuevo Personal</b></h4>
            </div>
            <div class="modal-body" style="    max-height: 477px;
    overflow: auto;">
                <div class="col-sm-12">
                    <input type="hidden" value="guardar" name="proceso">
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-3 control-label">Nombre Completo: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nombre" id="nom_personal" placeholder="Nombre del Empleado">
                            </div>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-2 control-label">Direccion: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion del Empleado">
                            </div>
                        </div>
                       <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">C.I.: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ci" id="ci" placeholder="Carnet de Identidad">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">Cargo: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo del Empleado">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">Salario: </label>
                            <div class="col-sm-9">
                                <input type="number" step="0.001" class="form-control" name="salario" id="salario" placeholder="Salario de Empleado">
                            </div>
                        </div>
                         <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-6 control-label">% de venta: </label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="porcentajeV" step="0.001" id="porcentajeV" placeholder="Porcentaje">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">Clave: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="clave" id="clave" placeholder="clave">
                            </div>
                        </div>
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-7 control-label">Color (OSCURO COMO PREFERENCIA):</label>
                            <div class="col-sm-5">  
                                <input type='color' id='colores' value="#140C86" name='colores' type='color' class="form-control" />
                                <input type='hidden'  name='proceso'  value="guardar" />
                            </div>                    
                        </div>                    
                        
                          </div>                                    

                </div>                                    
                <div class="modal-footer">
                    <button type="submit" name="bts" class="btn btn-success" >Guardar</button>
                 <input class="btn btn-danger" type="reset" data-dismiss="modal" onclick="$('#frmPersonalGuardar')[0].reset();"   value="VOLVER">             

                </div>
            </div>
        </div>  
 

    </div>
   </form>


    <form id="frmPersonalModificar" enctype="multipart/form-data">
<div class="modal fade in" id="modalPersonalModificar" role="dialog" data-backdrop="static">
    <div class="modal-dialog">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <b> MODIFICAR PERSONAL</b></h4>
            </div>
            <div class="modal-body" style="    max-height: 477px;
    overflow: auto;">
                <div class="col-sm-12">
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-3 control-label">Nombre Completo: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nombre" id="nom_personalA" placeholder="Nombre del Empleado">
                            </div>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-2 control-label">Direccion: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="direccion" id="direccionA" placeholder="Direccion del Empleado">
                            </div>
                        </div>
                       <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">C.I.: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ci" id="ciA" placeholder="Carnet de Identidad">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">Cargo: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="cargo" id="cargoA" placeholder="Cargo del Empleado">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">Salario: </label>
                            <div class="col-sm-9">
                                <input type="number" step="0.001" class="form-control" name="salario" id="salarioA" placeholder="Salario de Empleado">
                            </div>
                        </div>
                         <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-6 control-label">% de venta: </label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="porcentajeV" step="0.001" id="porcentajeVA" placeholder="Porcentaje">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">Clave: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="clave" id="clave" placeholder="claveA">
                            </div>
                        </div>
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-5 control-label">Color (OSCURO COMO PREFERENCIA):</label>
                            <div class="col-sm-7">  
                                <input type='color' id='coloresA' value="#140C86" name='colores' type='color' class="form-control" />
                                <input type='hidden'  name='proceso'  value="modificar" />
                            </div>                    
                        </div>                    
                        
                          </div>                                    

                </div>                                    
                <div class="modal-footer">
                    <button type="submit" name="bts" class="btn btn-success" >Guardar</button>
                 <input class="btn btn-danger" type="reset" data-dismiss="modal" onclick="$('#frmPersonalModificar')[0].reset();"   value="VOLVER">             

                </div>
            </div>
        </div>  
 

    </div>
   </form>