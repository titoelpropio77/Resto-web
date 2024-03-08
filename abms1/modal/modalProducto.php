
    <form id="frmFormulario" enctype="multipart/form-data">
<div class="modal fade in" id="myModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <b> Registro de Nuevo producto</b></h4>
            </div>
            <div class="modal-body" style="    height: 477px;
    overflow: auto;">
                <div class="col-sm-12">
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-3 control-label">Nombre: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nombre" id="nom_prod" placeholder="Nombre del elemento terminado">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">Estado:</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="estado" name="estado">
                                    <option value="ACTIVO">-- seleccionar estado --</option>
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INCTIVO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">Cantidad:</label>
                            <div class="col-sm-9">
                                <input type="number" step="0.001" class="form-control" name="cantidad" id="cantidad" placeholder="0.000 cantidad">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">Unidad:</label>
                            <div class="col-sm-9">           
                                <input type="number" step="0.001" class="form-control" name="unidad" id="unid" placeholder="0.000 Unidad">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">Precio:</label>
                            <div class="col-sm-9">           
                                <input type="number" step="0.001" class="form-control" name="pre_venta" id="pre_venta" placeholder="0.000 precio">
                            </div>
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-2 control-label">Grupo:</label>
                            <div class="col-sm-9">                                   
                                <select class="form-control" name="grupo" id="selectGrupo">
                                    <option value="0">SELECCIONE CATEGORIA</option>
                                  
                                </select>

                            </div>
                            <div class="col-xs-1">           
                                <button type="button" class="btn btn-success" title="AGREGAR GRUPO" data-toggle="modal" data-target="#ModaListarGrupo"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-3 control-label" >Disponible:</label>
                            <div class="col-sm-9">              
                                <select class="form-control" id="disponible" name="disponible" >
                                    <option value="SI">-- disponible --</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>                    
                        </div>                    
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-2 control-label">Sugiere:</label>
                            <div class="col-sm-9">             
                                <select class="form-control" id="sujiere" name="sujiere" ">
                                    <option value="">-- Sujiere --</option>
                                    <option value="X">SI</option>
                                    <option value="">NO</option>
                                </select>
                            </div>       
                                              
                        </div>                                    
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-3 control-label">Color:</label>
                            <div class="col-sm-9">  
                                <input type='color' id='colores' value="#140C86" name='colores' type='color' class="form-control" />
                                <input type='hidden'  name='proceso'  value="guardar" />
                            </div>                    
                        </div>                    
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-3 control-label">Codigo de Barra:</label>
                            <div class="col-sm-9"> 
                                <input type="text" class="form-control" name="barcode" id="barcodeI" placeholder="codigo de barra">
                            </div>                    
                        </div>                 
                        <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-3 control-label">Tipo de Producto:</label>
                            <div class="col-sm-9">            
                                <select class="form-control" id="familia" name="familia">
                                    <option value="N">-- Tipo de producto --</option>
                                    <option value="N">NORMAL</option>
                                    <option value="C">CONSUMO</option>
                                    <option value="T">TIEMPO-HORA</option>
                                    <option value="P">COMPUESTO</option>                            
                                </select>
                            </div>                                    
                        </div>   
                        <div class="form-group col-xs-9" style="    margin-bottom: 0;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Foto Producto:</label>
                            <div class="col-sm-9">            
                                <!-- <input type="file" name="foto" id="imagenProducto" size="30"  onclick="cargarImagen2(this,1)"> -->
                                <!-- <canvas id='canvas' style='display: none;'></canvas> -->
                                 <img id="foto" src="imagenes/imagenboton/food.svg" alt="Comida"  onclick="cargarImagen(this,1)"  style="width: 100px;
    height: 78px; cursor: pointer;" />
    <input type="file" name="fotoGuardar" id="fotocargar" style="    visibility: hidden;" onchange="cargarImagen(this, 2)">
                <canvas name="canvas" id="canvas" style="display: none"></canvas>

                            </div>                                    
                        </div> 
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-4 control-label">Puntos de Impresion:</label>
                            <div class="col-sm-8">            
                               <label><input type="checkbox" name="cocina" value="x">cocina</label>
                               <label><input type="checkbox" name="punto1" value="x">punto1</label>
                               <label><input type="checkbox" name="punto2" value="x">punto2</label>
                               <label><input type="checkbox" name="punto3" value="x">punto3</label>
                               <label><input type="checkbox" name="punto4" value="x">punto4</label>
                            </div>                                    
                        </div> 
                      <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-4 control-label">Día de Venta:</label>
                            <div class="col-sm-8">            
                               <label><input type="checkbox" checked="" name="lunes" value="x">lunes</label>
                               <label><input type="checkbox" checked="" name="martes" value="x">martes</label>
                               <label><input type="checkbox" checked="" name="miercoles" value="x">miercoles</label>
                               <label><input type="checkbox" checked="" name="jueves" value="x">jueves</label>
                               <label><input type="checkbox"  checked="" name="viernes" value="x">viernes</label>
                               <label><input type="checkbox" checked="" name="sabado" value="x">sabado</label>
                               <label><input type="checkbox" checked="" name="domingo" value="x">domingo</label>
                            </div>                                    
                        </div> 
                         <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-4 control-label">HORA INICIO VENTA(24 HORAS):</label>
                            <div class="col-sm-8">            
                             <div class="bootstrap-timepicker">
                                  <div class="input-group">
                                    <input type="text" class="form-control horaIni"  name="horaIni">
                                    

                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                              </div>
                              <!-- /.input group -->
                            <!-- /.form group -->
                          </div>
                          </div>                                    
                        </div> 
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-4 control-label">HORA FIN VENTA(24 HORAS):</label>
                            <div class="col-sm-8">            
                             <div class="bootstrap-timepicker">
                                  <div class="input-group">
                                    <input type="text" class="form-control horaFin"  name="horaFin">
                                    

                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                              </div>
                              <!-- /.input group -->
                            <!-- /.form group -->
                          </div>
                          </div>                                    
                        </div> 
                    </div>      <!--   aqui finaliza el div contenedor -->

                </div>                                    
                <div class="modal-footer">
                    <button type="submit" name="bts" class="btn btn-success" >Guardar</button>
                 <input class="btn btn-danger" type="reset" data-dismiss="modal" onclick="$('#frmFormulario')[0].reset();"   value="VOLVER">             

                </div>
            </div>
        </div>  
 

    </div>
   </form>

<div class="modal fade in" id="ModaListarGrupo" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center"><b>NUEVA CATEGORIA</b></h4>

            </div>
            <div class="modal-body">

                    <!-- <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">Agregar Categorias</button> -->
                    <div class="col-sm-6">   

                        <table id="ghatableGrupo" class="ghatableGrupo display table table-bordered table-stripe table-hover table-responsive" cellspacing="0" width="100%"> <!--jquery.dataTables.min.js -->
                            <thead style="text-align: center">

                            <th>ID</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Operacion</th>

                            </thead>
                            <tbody id="tbodyGrupo">
                             
                            </tbody>
                        </table>   
                    </div>                   
                    <div class="col-sm-6">   
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-3 control-label">Nombre: </label>
                            <div class="col-sm-9">

                                <input type="text" class="form-control" id="NombreGrupo" placeholder="Nombre Grupo">
                            </div>
                        </div> <!-- form-goup -->
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-3 control-label">Estado: </label>
                            <div class="col-sm-9">

                                <select class="form-control" id="estadoGrupo" name="estado">
                                    <option value="0">-- seleccionar estado --</option>
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INCTIVO</option>
                                </select>
                            </div>
                        </div> <!-- form-goup -->
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-3 control-label">Color:</label>
                            <div class="col-sm-9">  
                           <!--   <input type='color' id='colores' name='colores' type='color' value='<?php // if(isset($_POST['submit'])){echo $colores;}  ?>' /> -->
                                <input class="form-control" type="color" value="#563d7c"  id="colorGrupo">
                            </div>                    
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-3 control-label" >Orden: </label>
                            <div class="col-sm-9">

                                <input type="number" class="form-control" id="orden" placeholder="ORDEN" value="0">
                            </div>
                        </div> <!-- form-goup -->
                    </div>

                               
            </div>
            <div class="modal-footer">
      <button type="submit" name="bts" class="btn btn-success" onclick="guardarGrupo()">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">VOLVER</button>                                    
            </div>
        </div>
    </div>      
</div>


<div class="modal fade in" id="ModalEliminarProducto" role="dialog" data-backdrop="static">
    <div class="modal-dialog">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center"><b>DESEA ELIMINAR EL PRODUCTO <span id="nombreProductoModal"></span></b></h4>

            </div>
            <div class="modal-body">
                  <input type="hidden" id="idProductoEliminar" name="idProductoEliminar">
            </div>
            <div class="modal-footer">
                <button type="submit" name="btnEliminarPro" class="btn btn-success" onclick="desactivarProducto()">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">VOLVER</button>                        
            </div>
        </div>
    </div>      
</div>



<div class="modal fade in" id="myModaledit" role="dialog" data-backdrop="static">
    <form id="frmFormularioEditProdu" enctype="multipart/form-data2">
    <div class="modal-dialog  ">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center"><b>EDITAR PRODUCTO</b></h4>
            </div>
            <div class="modal-body" >
                <div class="col-sm-12" style="    height: 477px;
    overflow: auto;">

                    <input type="hidden" name="idProducto" id="idProductoA">
                    <div class="form-group col-xs-9">
                        <label for="inputEmail3" class="col-sm-3 control-label">Nombre: </label>
                        <div class="col-sm-9">

                            <input type="text" name="nombre" class="form-control" id="NombreProcA" placeholder="Nombre Producto">
                        </div>
                    </div> <!-- form-goup -->

                    <div class="form-group col-xs-6">
                        <label for="inputEmail3" class="col-sm-3 control-label">Estado:</label>
                        <input type='hidden' id='colores'  name='proceso'  value="modificarPoducto" />
                        <div class="col-sm-9">
                            <select class="form-control" id="estadoA" name="estado">
                                <option value="ACTIVO">-- seleccionar estado --</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="inputEmail3" class="col-sm-3 control-label">Cantidad:</label>
                        <div class="col-sm-9">
                            <input type="number" step="0.001" class="form-control" name="cantidad" id="cantidadA" placeholder="0.000 cantidad">
                        </div>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="inputEmail3" class="col-sm-3 control-label">Unidad:</label>
                        <div class="col-sm-9">            
                            <input type="number" step="0.001" class="form-control" name="unidad" id="unidA" placeholder="0.000 Unidad">
                        </div>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="inputEmail3" class="col-sm-3 control-label">Precio:</label>
                        <div class="col-sm-9">           
                            <input type="number" step="0.001" class="form-control" name="precioVenta" id="pre_ventaA" placeholder="0.000 precio">
                        </div>
                    </div>

                    <div class="form-group col-xs-12">
                        <label for="inputEmail3" class="col-sm-2 control-label">Categoria:</label>
                        <div class="col-sm-9">           
                            <select class="form-control" name="grupo" id="grupoA">
                                <option value="0">SELECCIONE CATEGORIA</option>
                               
                            </select>

                        </div>

                    </div>

                    <div class="form-group col-xs-9">
                        <label for="inputEmail3" class="col-sm-3 control-label" >Disponible:</label>
                        <div class="col-sm-9">               
                            <select class="form-control" id="disponibleA" name="disponible">
                                <option value="0">-- DISPONIBLE --</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>                    
                    </div>                    
                    <div class="form-group col-xs-9">
                        <label for="inputEmail3" class="col-sm-2 control-label">Sugiere:</label>
                        <div class="col-sm-9">             
                            <select class="form-control" id="sugiereA" name="sugiere" onchange="sugerirPresa(this)">
                                <option value="">-- Sugiere --</option>
                                <option value="X">SI</option>
                                <option value="">NO</option>
                            </select>
                        </div>   
                        <div class="col-sm-1" id="divSujiere" style="display: none">           
                                <button onclick="listarOpProducto()" type="button" class="btn btn-success" title="AGREGAR SUGERENCIA" data-toggle="modal" data-target="#ModaOpProducto"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>                                       
                    </div>                                    
                    <div class="form-group col-xs-9">
                        <label for="inputEmail3" class="col-sm-3 control-label">Color:</label>
                        <div class="col-sm-9">  
                       <!--   <input type='color' id='colores' name='colores' type='color' value='<?php // if(isset($_POST['submit'])){echo $colores;}  ?>' /> -->
                            <input class="form-control" type="color"  name="colores" id="colorProductoA">
                        </div>                    
                    </div>                    
                    <div class="form-group col-xs-9">
                        <label for="inputEmail3" class="col-sm-3 control-label">Codigo de Barra:</label>
                        <div class="col-sm-9"> 

                            <input type="text" class="form-control" name="barcode" id="barcode" placeholder="codigo de barra">
                        </div>                    
                    </div>                    
                    <div class="form-group col-xs-9">
                        <label for="inputEmail3" class="col-sm-3 control-label">Tipo de Producto:</label>
                        <div class="col-sm-9">           
                            <select class="form-control" id="familiaA" name="familia">
                                <option value="N">-- Tipo de producto --</option>
                                <option value="N">NORMAL</option>
                                <option value="C">CONSUMO</option>
                                <option value="T">TIEMPO-HORA</option>
                                <option value="P">COMPUESTO</option>                            
                            </select>
                        </div>                                    
                    </div>   
                     <div class="form-group col-xs-9">
                            <label for="inputEmail3" class="col-sm-3 control-label">Foto Producto:</label>
                            <div class="col-sm-9">            
                                <!-- <input type="file" name="foto" id="imagenProducto" size="30"  onclick="cargarImagen2(this,1)"> -->
                                <!-- <canvas id='canvas' style='display: none;'></canvas> -->
                                 <img id="imgfoto" src="imagenes/imagenboton/food.svg" alt="Comida"  onclick="cargarImagen2(this,1)"  style="width: 100px;
    height: 78px; cursor: pointer;" />
    <input type="file" name="foto" id="fotocargar2" style="    visibility: hidden;" onchange="cargarImagen2(this, 2)">
                <canvas id="canvas2" name="canvas" style="display: none"></canvas>

                            </div>                                    
                        </div> 
                            <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-4 control-label">Puntos de Impresion:</label>
                            <div class="col-sm-8">            
                               <label><input type="checkbox" name="cocina" value="x" id="impCocina">cocina</label>
                               <label><input type="checkbox" name="punto1" value="x" id="impPunto1">punto1</label>
                               <label><input type="checkbox" name="punto2" value="x" id="impPunto2">punto2</label>
                               <label><input type="checkbox" name="punto3" value="x" id="impPunto3">punto3</label>
                               <label><input type="checkbox" name="punto4" value="x" id="impPunto4">punto4</label>
                            </div>                                    
                        </div> 
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-4 control-label">Día de Venta:</label>
                            <div class="col-sm-8">            
                               <label><input type="checkbox"  name="lunes" value="x" id="lun">lunes</label>
                               <label><input type="checkbox"  name="martes" value="x" id="mar">martes</label>
                               <label><input type="checkbox"  name="miercoles" value="x" id="mier">miercoles</label>
                               <label><input type="checkbox"  name="jueves" value="x" id="jue">jueves</label>
                               <label><input type="checkbox"  name="viernes" value="x" id="vie">viernes</label>
                               <label><input type="checkbox"  name="sabado" value="x" id="sab">sabado</label>
                               <label><input type="checkbox"  name="domingo" value="x" id="dom">domingo</label>
                            </div>                                    
                        </div> 
                         <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-4 control-label">HORA INICIO VENTA(24 HORAS):</label>
                            <div class="col-sm-8">            
                             <div class="bootstrap-timepicker">
                                  <div class="input-group">
                                    <input type="text" class="form-control horaIni"  name="horaIni" id="horaIni">
                                    

                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                              </div>
                              <!-- /.input group -->
                            <!-- /.form group -->
                          </div>
                          </div>                                    
                        </div> 
                        <div class="form-group col-xs-12">
                            <label for="inputEmail3" class="col-sm-4 control-label">HORA FIN VENTA(24 HORAS):</label>
                            <div class="col-sm-8">            
                             <div class="bootstrap-timepicker">
                                  <div class="input-group">
                                    <input type="text" class="form-control horaFin"  name="horaFin" id="horaFin">
                                    

                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                              </div>
                              <!-- /.input group -->
                            <!-- /.form group -->
                          </div>
                          </div>                                    
                        </div> 
                </div>                                    
                <div class="modal-footer">
                    <button type="submit" name="bts" class="btn btn-success" >GUARDAR</button>
                    <input type="reset" class="btn btn-danger" data-dismiss="modal" onclick="$('#frmFormularioEditProdu')[0].reset();$('#impCocina').attr('checked', false);$('#impPunto1').attr('checked', false);$('#impPunto2').attr('checked', false);$('#impPunto3').attr('checked', false);$('#impPunto4').attr('checked', false);$('#lun').attr('checked', false);$('#mar').attr('checked', false);$('#mier').attr('checked', false);$('#jue').attr('checked', false);$('#vie').attr('checked', false);$('#sab').attr('checked', false);$('#dom').attr('checked', false);"  value="VOLVER">                       
                </div>
            </div>
        </div>      
    </div>
    </form>
</div> <!--  modal editar producto -->

