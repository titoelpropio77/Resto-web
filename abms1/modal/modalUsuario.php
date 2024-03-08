 <form id="frmUsuarioGuardar" enctype="multipart/form-data">
<div class="modal fade in" id="modalUsuario" role="dialog" data-backdrop="static">
    <div class="modal-dialog">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <b> Registro de Nuevo Usuario</b></h4>
            </div>
            <div class="modal-body" style="    max-height: 477px;
    overflow: auto;">
                <div class="col-sm-12">
                    <input type="hidden" value="guardar" name="proceso">
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-3 control-label">NOMBRE DEL USUARIO: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nom_usuario" id="nom_usuario" placeholder="Nombre del usuario">
                            </div>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-2 control-label">LOGIN: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="login" id="login" placeholder="Login">
                            </div>
                        </div>
                       <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">CLAVE: </label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="clave" id="clave" placeholder="Clave">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">Cargo: </label>
                            <div class="col-sm-9">
                                <select id="selectNivel" name="nivel" class="form-control">
                                        <option value="1">ADMINISTRADOR</option>
                                        <option value="2">CAJERO</option>
                                </select>
                            </div>
                        </div>
                        
                        
                          </div>                                    

                </div>                                    
                <div class="modal-footer">
                    <button type="submit" name="bts" class="btn btn-success" >Guardar</button>
                 <input class="btn btn-danger" type="reset" data-dismiss="modal" onclick="$('#frmUsuarioGuardar')[0].reset();"   value="VOLVER">             

                </div>
            </div>
        </div>  
 

    </div>
   </form>


<form id="frmUsuarioModificar" enctype="multipart/form-data">
<div class="modal fade in" id="modalUsuarioModificar" role="dialog" data-backdrop="static">
    <div class="modal-dialog">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <b> MODIFICAR Usuario</b></h4>
            </div>
            <div class="modal-body" style="    max-height: 477px;
    overflow: auto;">
                <div class="col-sm-12">
                    <input type="hidden" value="modificar" name="proceso">
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-3 control-label">NOMBRE DEL USUARIO: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nom_usuario" id="nom_usuarioA" placeholder="Nombre del Usuario">
                            </div>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-2 control-label">LOGIN: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="login" id="loginA" placeholder="Login">
                            </div>
                        </div>
                       <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">CLAVE: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="clave" id="claveA" placeholder="Clave">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">Cargo: </label>
                            <div class="col-sm-9">
                                <select id="selectCargoA" name="nivel" class="form-control">
                                        <option value="1">ADMINISTRADOR</option>
                                        <option value="2">CAJERO</option>
                                </select>
                            </div>
                        </div>
                        
                          </div>                                    

                </div>                                    
                <div class="modal-footer">
                    <button type="submit" name="bts" class="btn btn-success" >Guardar</button>
                 <input class="btn btn-danger" type="reset" data-dismiss="modal" onclick="$('#frmUsuarioModificar')[0].reset();"   value="VOLVER">             

                </div>
            </div>
        </div>  
 

    </div>
   </form>