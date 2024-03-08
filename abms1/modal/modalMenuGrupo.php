<div class="modal fade in" id="ModaAgregarGrupo" role="dialog" data-backdrop="static">
    <div class="modal-dialog">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center"><b>NUEVO GRUPO</b></h4>

            </div>
            <div class="modal-body">


            </div>
            <div class="modal-footer">
                           
            </div>
        </div>
    </div>      
</div>
<div class="modal fade in" id="ModalModificarGrupo" role="dialog" data-backdrop="static">
    <div class="modal-dialog">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center"><b>MODIFICAR GRUPO</b></h4>

            </div>
            <div class="modal-body">
                <div class="col-sm-12">   
                    <div class="form-group col-xs-9">
                        <label for="inputEmail3" class="col-sm-3 control-label">Nombre: </label>
                        <div class="col-sm-9">

                            <input type="email" class="form-control" id="NombreGrupoA" placeholder="Nombre Producto">
                        </div>
                    </div> <!-- form-goup -->
                    <div class="form-group col-xs-9">
                        <label for="inputEmail3" class="col-sm-3 control-label">Estado: </label>
                        <div class="col-sm-9">

                            <select class="form-control" id="estadoGrupoA" name="estado">
                                <option value="ACTIVO">-- seleccionar estado --</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>
                    </div> <!-- form-goup -->
                    <div class="form-group col-xs-9">
                        <label for="inputEmail3" class="col-sm-3 control-label">Color:</label>
                        <div class="col-sm-9">  
                       <!--   <input type='color' id='colores' name='colores' type='color' value='<?php // if(isset($_POST['submit'])){echo $colores;}  ?>' /> -->
                            <input class="form-control" type="color" value="#563d7c"  id="colorGrupoA">
                        </div>                    
                    </div>
                    <div class="form-group col-xs-9">
                        <label for="inputEmail3" class="col-sm-3 control-label">Orden: </label>
                        <div class="col-sm-9">

                            <input type="number" class="form-control" id="ordenGrupoA" placeholder="ORDEN">
                        </div>
                    </div> <!-- form-goup -->
                </div>


            </div>
            <div class="modal-footer">
                <button type="submit" name="bts" class="btn btn-success" onclick="modificarMenuGrupo()">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">VOLVER</button>                        
            </div>
        </div>
    </div>      
</div>

