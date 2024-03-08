
<div class="modal fade in" id="ModaOpProducto" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center"><b>NUEVA SUGERENCIA PARA EL PRODUCTO: <span id="spanOpProducto"></span></b></h4>

            </div>
            <div class="modal-body">

                    <!-- <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">Agregar Categorias</button> -->
                    <div class="col-sm-6">   

                        <table id="ghatableOpProducto" class="ghatableGrupo display table table-bordered table-stripe table-hover table-responsive" cellspacing="0" width="100%"> <!--jquery.dataTables.min.js -->
                            <thead style="text-align: center">

                            <th>Nro.</th>
                            <th>Nombre Sugerencia</th>
                            <th>Precio Venta</th>
                            <th>Operacion</th>

                            </thead>
                            <tbody id="tbodyOpProducto">
                             
                            </tbody>
                        </table>   
                    </div>                   
                    <div class="col-sm-6">   
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-3 control-label">Nombre: </label>
                            <div class="col-sm-9">

                                <input type="text" class="form-control" id="NombreSugerencia" placeholder="Nombre Sugerencia">
                            </div>
                        </div> <!-- form-goup -->
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-3 control-label">Estado: </label>
                            <div class="col-sm-9">

                                <select class="form-control" id="estadoSugerencia" name="estado">
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INCTIVO</option>
                                </select>
                            </div>
                        </div> <!-- form-goup -->
                     
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-3 control-label" >Precio: </label>
                            <div class="col-sm-9">

                                <input type="number" class="form-control" id="precioSugerencia" placeholder="Precio" value="0">
                            </div>
                        </div> <!-- form-goup -->
                    </div>
            </div>
            <div class="modal-footer">
               <button type="submit" name="bts" class="btn btn-success" onclick="guardarOpProducto()">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="$('#myModaledit').css('overflow-y','auto')">VOLVER</button>                                    
            </div>
        </div>
    </div>      
</div>

