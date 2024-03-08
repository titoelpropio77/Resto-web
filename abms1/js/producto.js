$(document).ready(function () {

    listarProducto();
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

});

idProducto = 0;
nombreProd = "";
function verificarError(error){
if (error.length > 0) {
                if (verificarError(json.error)) {
            return;
          }
                alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', error, function () {
                    alertify.message('OK');
                });
                 $('#loading').css('display', 'none');
                return true;
            }
}

var listarProducto = function () {


    datos = $('#datos');

    datos.empty();
    fila = "";
    $.ajax({
        url: 'CONTROLADORES/productoController.php',
        type: 'POST',
        typeData: 'json',
        data: {proceso: 'listar'},
        success: function (res) {

            var json = $.parseJSON(res);
          if (verificarError(json.error)) {
            return;
          }
            fila = json.result;
            datos.append(fila);
            paginadorProducto();
            $('#loading').css('display', 'none');

        }
    }).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});

}

$("#frmFormulario").submit(function (e) {
    errores = ""
    nombreProd = $('#nom_prod').val();
    cantidad = $('#cantidad').val();
    unidad = $('#unid').val();
    pre_venta = $('#pre_venta').val();
    selectGrupo = $('#selectGrupo').val();

    //esto evita que se haga la petición común, es decir evita que se refresque la pagina
    e.preventDefault();

    //ruta la cual recibira nuestro archivo
    // url="@Url.Content("~/Archivo/Recibe")"

    //FormData es necesario para el envio de archivo, 
    //y de la siguiente manera capturamos todos los elementos del formulario
    if (nombreProd == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO NOMBRE NO DEBE ESTAR VACIO.</span><br>";
    }
    if (validar("texto y entero", nombreProd)) {
        errores += "<span style='font-weight: bold;'>* POR FAVOR NO AGREGAR CARACTERES ESPECIALES EN EL CAMPO NOMBRE.</span><br>";
    }
    if (cantidad == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO CANTIDAD NO DEBE ESTAR VACIO.</span><br>";

    }
    if (validar("decimal", cantidad)) {
        errores += "<span style='font-weight: bold;'>* POR FAVOR NO AGREGAR CARACTERES EN EL CAMPO CANTIDAD.</span><br>";
    }
    if (unidad == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO UNIDAD NO DEBE ESTAR VACIO.</span><br>";
    }
    if (validar("decimal", unidad)) {
        errores += "<span style='font-weight: bold;'>* POR FAVOR NO AGREGAR CARACTERES EN EL CAMPO UNIDAD.</span><br>";
    }
    if (pre_venta == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO PRECIO NO DEBE ESTAR VACIO.</span><br>";
    }
    if (validar("decimal", pre_venta)) {
        errores += "<span style='font-weight: bold;'>* POR FAVOR NO AGREGAR CARACTERES EN EL CAMPO PRECIO.</span><br>";
    }
    if (selectGrupo == "0") {
        errores += "<span style='font-weight: bold;'>* DEBE SELECCIONAR UN GRUPO.</span><br>";
    }


    if (errores != "") {
        alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', errores, function () {
            alertify.message('OK');
        });
        return;
    }

    var parametros1 = new FormData($(this)[0]);


    //realizamos la petición ajax con la función de jquery
    $.ajax({
        type: "POST",
        url: "CONTROLADORES/productoController.php",
        data: parametros1,
        contentType: false, //importante enviar este parametro en false
        processData: false, //importante enviar este parametro en false
        success: function (res) {

            var json = $.parseJSON(res);
           if (verificarError(json.error)) {
            return;
          }
            alertify.success("GUARDADO CORRECTAMENTE");
            $('#myModal').modal("hide");

            $('#frmFormulario')[0].reset();
            $('#foto').attr('src', 'imagenes/imagenboton/food.svg');
            listarProducto();

        },
        error: function (r) {

            alert("Error del servidor");
            location.reload();
        }
    }).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});

});



$("#frmFormularioEditProdu").submit(function (e) {
    //esto evita que se haga la petición común, es decir evita que se refresque la pagina
    e.preventDefault();
    nombreProd = $('#NombreProcA').val();
    cantidad = $('#cantidadA').val();
    unidad = $('#unidA').val();
    pre_venta = $('#pre_ventaA').val();
    selectGrupo = $('#grupoA').val();

    errores = "";
    //ruta la cual recibira nuestro archivo
    // url="@Url.Content("~/Archivo/Recibe")"

    //FormData es necesario para el envio de archivo, 
    //y de la siguiente manera capturamos todos los elementos del formulario
    if (nombreProd == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO NOMBRE NO DEBE ESTAR VACIO.</span><br>";
    }
    if (validar("texto y entero", nombreProd)) {
        errores += "<span style='font-weight: bold;'>* POR FAVOR NO AGREGAR CARACTERES ESPECIALES EN EL CAMPO NOMBRE.</span><br>";
    }
    if (cantidad == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO CANTIDAD NO DEBE ESTAR VACIO.</span><br>";

    }
    if (validar("decimal", cantidad)) {
        errores += "<span style='font-weight: bold;'>* POR FAVOR NO AGREGAR CARACTERES EN EL CAMPO CANTIDAD.</span><br>";
    }
    if (unidad == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO UNIDAD NO DEBE ESTAR VACIO.</span><br>";
    }
    if (validar("decimal", unidad)) {
        errores += "<span style='font-weight: bold;'>* POR FAVOR NO AGREGAR CARACTERES EN EL CAMPO UNIDAD.</span><br>";
    }
    if (pre_venta == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO PRECIO NO DEBE ESTAR VACIO.</span><br>";
    }
    if (validar("decimal", pre_venta)) {
        errores += "<span style='font-weight: bold;'>* POR FAVOR NO AGREGAR CARACTERES EN EL CAMPO PRECIO.</span><br>";
    }
    if (selectGrupo == "0") {
        errores += "<span style='font-weight: bold;'>* DEBE SELECCIONAR UN GRUPO.</span><br>";
    }

    if (errores != "") {
        alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', errores, function () {
            alertify.message('OK');
        });
        return;
    }
    var parametros = new FormData($(this)[0]);

    //realizamos la petición ajax con la función de jquery
    $.ajax({
        type: "POST",
        url: "CONTROLADORES/productoController.php",
        data: parametros,
        contentType: false, //importante enviar este parametro en false
        processData: false, //importante enviar este parametro en false
        success: function (res) {
            var json = $.parseJSON(res);
            if (verificarError(json.error)) {
            return;
          } else {
                alertify.success('MODIFICADO CORRECTAMENTE');
                $('#myModaledit').modal("hide");
                $('#frmFormularioEditProdu')[0].reset();
                $('#imgfoto').attr('src', 'imagenes/imagenboton/food.svg');


            }

            listarProducto();
        },
        error: function (r) {

            alert("Error del servidor");
        }
    }).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});

});
function cargarDatosProducto(id) {
    var url = "CONTROLADORES/productoController.php";
    idProducto = $('#idProductoA');

    nombreProducto = $('#NombreProcA');
    estado = $('#estadoA');
    cantidad = $('#cantidadA');
    unidad = $('#unidA');
    precioVenta = $('#pre_ventaA');
    unid = $('#unidA');
    grupo = $('#grupoA');
    disponible = $('#disponibleA');
    sugiere = $('#sugiereA');
    colorProducto = $('#colorProductoA');
    barcode = $('#barcode');
    familia = $('#familiaA');
    imgfoto = $('#imgfoto');
    cocina = $('#impCocina');
    punto1 = $('#impPunto1');
    punto2 = $('#impPunto2');
    punto3 = $('#impPunto3');
    punto4 = $('#impPunto4');
    lun = $('#lun');
    mar = $('#mar');
    mier = $('#mier');
    jue = $('#jue');
    vie = $('#vie');
    sab = $('#sab');
    dom = $('#dom');
    horaIni = $('#horaIni');
    horaFin = $('#horaFin');
    $('#loading').css('display', 'block');
    $.ajax({
        url: url,
        type: 'POST',
        typedata: 'json',
        data: {proceso: 'cargarDatos', id: id},
        success: function (res) {
            var json = $.parseJSON(res);
            if (verificarError(json.error)) {
            return;
          }
            if (json.result != "") {
                idProducto.val(json.result['id']);
                nombreProd = json.result['nom_prod'];
                nombreProducto.val(json.result['nom_prod']);
                estado.val(json.result['estado']);
                precioVenta.val(json.result['pre_venta']);
                unid.val(json.result['unid']);
                grupo.val(json.result['grupo']);
                disponible.val(json.result['disponible']);
                sugiere.val(json.result['presa']);
                cantidad.val(json.result['cantidad']);
                colorProducto.val(json.result['colores']);
                barcode.val(json.result['barcode']);
                tiempo=json.result['tiempo']==""?"N":json.result['tiempo'];
                familia.val(tiempo);
                horaIni.val(json.result['hora_inicio']);
                horaFin.val(json.result['hora_fin']);
                if (json.result['impcoc'] != "") {
                    cocina.prop('checked', true);

                }
                if (json.result['imppunt1'] != "") {
                    punto1.prop('checked', true);

                }
                if (json.result['imppunt2'] != "") {
                    punto2.prop('checked', true);

                }
                if (json.result['imppunt3'] != "") {
                    punto3.prop('checked', true);

                }
                if (json.result['imppunt4'] != "") {
                    punto4.prop('checked', true);

                }
                if (json.result['lun'] != "") {
                    lun.prop('checked', true);

                }
                if (json.result['mar'] != "") {
                    mar.prop('checked', true);

                }
                if (json.result['mier'] != "") {
                    mier.prop('checked', true);

                }
                if (json.result['jue'] != "") {
                    jue.prop('checked', true);

                }
                if (json.result['vie'] != "") {
                    vie.prop('checked', true);

                }
                if (json.result['sab'] != "") {
                    sab.prop('checked', true);

                }
                if (json.result['dom'] != "") {
                    dom.prop('checked', true);

                }
                if (json.result['']) {
                }
                var letra = json.result['imgnormal'].charAt(0);
                if (letra == 'a') {
                    if (json.result['imgnormal'] != "") {
                        imgfoto.attr('src', "../" + json.result['imgnormal']);
                    } else {
                        imgfoto.attr('src', 'imagenes/imagenboton/food.svg');

                    }
                } else {
                    imgfoto.attr('src', 'imagenes/imagenboton/food.svg');
                }

                if (json.result['presa'] != "") {
                    $('#divSujiere').css('display', 'block');
                } else {
                    $('#divSujiere').css('display', 'none');
                }

                $('#myModaledit').modal('show');
            } else {
                alertify.error("ERROR INTENTE NUEVAMENTE");

            }
            $('#loading').css('display', 'none');

        }



    }).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});

}




function cargarIdEliminar(boton) {
    id = $(boton).attr('id');
    nombre = $(boton).attr('nombre');
    $('#nombreProductoModal').text('"' + nombre + '"');
    $('#idProductoEliminar').val(id);


}


function paginadorProducto() {
    $('#ghatable').DataTable({
        "pagingType": "full_numbers",
        "scrollY": "330px",
        "scrollCollapse": true,
        "paging": false,
        retrieve: true

    });
}

function sugerirPresa(select) {
    opcion = $(select).val();
    if (opcion == "X") {
        $('#divSujiere').css('display', 'block');
    } else {
        $('#divSujiere').css('display', 'none');

    }
    // ModificarProducto();
}

function edicionDirectaProducto(){
    window.open("../edicionDirecta/edicionDirectaProducto.php");
    
}


function desactivarProducto(){
    
     idProducto=$('#idProductoEliminar').val();
      $.post('CONTROLADORES/productoController.php', {proceso: 'desactivarProducto', idProducto: idProducto}, function (res) {
            var json = JSON.parse(res);
            if (verificarError(json.error)) {
            return;
          }
          
         
            alertify.success("PRODUCTO ELIMINADO CORRECTAMENTE");
            location.reload();
        }).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});
}