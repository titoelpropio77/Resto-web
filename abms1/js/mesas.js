$(document).ready(function(){
    listarTodoMesa();
});

$("#frmMesaGuardar").submit(function (e) {
    errores = ""
  

    //esto evita que se haga la petición común, es decir evita que se refresque la pagina
    e.preventDefault();

    //ruta la cual recibira nuestro archivo
    // url="@Url.Content("~/Archivo/Recibe")"

    //FormData es necesario para el envio de archivo, 
    //y de la siguiente manera capturamos todos los elementos del formulario
    mesa=$('#nombreMesa').val();
   if (mesa == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO MESA NO DEBE ESTAR VACIO.</span><br>";
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
        url: "CONTROLADORES/mesasController.php",
        data: parametros1,
        contentType: false, //importante enviar este parametro en false
        processData: false, //importante enviar este parametro en false
        success: function (res) {

            var json = $.parseJSON(res);
            if (json.error.length > 0) {
                if ("Error Session" === json.error) {
                    $('#loading').css('display', 'none');

                    alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', "DEBE ENTRAR EN SESION NUEVAMENTE", function () {
                        alertify.message('OK');
                        window.location = "../desconectar.php";
                    });


                    return;
                }
                alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', json.error, function () {
                    alertify.message('OK');
                });
                $('#loading').css('display', 'none');
                return;
            }
            alertify.success("GUARDADO CORRECTAMENTE");
            listarTodoMesa();
            $('#modalMesa').modal("hide");

            $('#frmMesaGuardar')[0].reset();
            
            
        },
        error: function (r) {

            alert("Error del servidor");
        }
    }).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});

});


function listarTodoMesa(){
    // tbodyHistorico.empty();
    $('#tablaMesa').DataTable().destroy();
    $('#tbodyMesa').empty();

    $.post("CONTROLADORES/mesasController.php", {proceso: "listarTodo"}, function (res) {
        var json = JSON.parse(res);
        if (json.error.length > 0) {
                if ("Error Session" === json.error) {
                    $('#loading').css('display', 'none');

                    alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', "DEBE ENTRAR EN SESION NUEVAMENTE", function () {
                        alertify.message('OK');
                        window.location = "../desconectar.php";
                    });


                    return;
                }
                alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', json.error, function () {
                    alertify.message('OK');
                });
                $('#loading').css('display', 'none');
                return;
            }
        for (var i = 0; i < json.result.length; i++) {
            if (json.result[i].ESTADO=="ACTIVO") {
            $('#tbodyMesa').append("<tr>"+
                "<td>"+json.result[i].ID+
                "<td><button style='     width: 45px;    height: 24px;background: "+json.result[i].COLORES+"'>"+
                "<td>"+json.result[i].NRO_MESA+
                "<td><button onclick='cargarMesa("+json.result[i].ID+")' class='btn btn-info'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"+
                "<button onclick='eliminarMesa("+json.result[i].ID+")' class='btn btn-danger'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"
                );   
            }
        }
        paginatorMesa();
    }).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});
}
function paginatorMesa(){
 $('#tablaMesa').DataTable({
        "pagingType": "full_numbers",
        "destroy": true,
        "order": [[0, "asc"]],
        "scrollY": "418px",
        "scrollCollapse": true,
        "paging": false,
        retrieve: true

    });
}
idMesa="";
function cargarMesa(id){
idMesa=id;
    mesa=$('#nombreMesaA');
    orden=$('#ordenA');
    estado=$('#estadoA');


$.post('CONTROLADORES/mesasController.php',{proceso:'buscarXID',id:idMesa},function(res){
      var json = JSON.parse(res);
        if (json.error.length > 0) {
                if ("Error Session" === json.error) {
                    $('#loading').css('display', 'none');

                    alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', "DEBE ENTRAR EN SESION NUEVAMENTE", function () {
                        alertify.message('OK');
                        window.location = "../desconectar.php";
                    });


                    return;
                }
                alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', json.error, function () {
                    alertify.message('OK');
                });
                $('#loading').css('display', 'none');
                return;
            }
            mesa.val(json.result[0].NRO_MESA);
            orden.val(json.result[0].ORDEN);
            estado.val(json.result[0].ESTADO);
            $('#modalMesaModificar').modal('show');

}).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});
}


$("#frmMesaModificar").submit(function (e) {
  

    //esto evita que se haga la petición común, es decir evita que se refresque la pagina
    e.preventDefault();
    errores = ""

    //ruta la cual recibira nuestro archivo
    // url="@Url.Content("~/Archivo/Recibe")"

    //FormData es necesario para el envio de archivo, 
    //y de la siguiente manera capturamos todos los elementos del formulario
     mesa=$('#nombreMesaA').val();
   if (mesa == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO MESA NO DEBE ESTAR VACIO.</span><br>";
    }
    if (errores != "") {
        alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', errores, function () {
            alertify.message('OK');
        });
        return;
    }

    var parametros1 = new FormData($(this)[0]);
    parametros1.append("id",idMesa);
    //realizamos la petición ajax con la función de jquery
    $.ajax({
        type: "POST",
        url: "CONTROLADORES/mesasController.php",
        data: parametros1,
        contentType: false, //importante enviar este parametro en false
        processData: false, //importante enviar este parametro en false
        success: function (res) {

            var json = $.parseJSON(res);
            if (json.error.length > 0) {
                if ("Error Session" === json.error) {
                    $('#loading').css('display', 'none');

                    alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', "DEBE ENTRAR EN SESION NUEVAMENTE", function () {
                        alertify.message('OK');
                        window.location = "../desconectar.php";
                    });


                    return;
                }
                alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', json.error, function () {
                    alertify.message('OK');
                });
                $('#loading').css('display', 'none');
                return;
            }
            alertify.success("MODIFICAR CORRECTAMENTE");
            listarTodoMesa();
            $('#modalMesaModificar').modal("hide");

            $('#frmMesaModificar')[0].reset();
            
            
        },
        error: function (r) {

            alert("Error del servidor");
        }
    }).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});

});



function eliminarMesa(id){
$.post('CONTROLADORES/mesasController.php',{proceso:'eliminarMesa',id:id},function(res){
     var json = $.parseJSON(res);
            if (json.error.length > 0) {
                if ("Error Session" === json.error) {
                    $('#loading').css('display', 'none');

                    alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', "DEBE ENTRAR EN SESION NUEVAMENTE", function () {
                        alertify.message('OK');
                        window.location = "../desconectar.php";
                    });


                    return;
                }
                alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', json.error, function () {
                    alertify.message('OK');
                });
                $('#loading').css('display', 'none');
                return;
            }
            alertify.success("ELIMINADO CORRECTAMENTE");
            listarTodoMesa();
}).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});

}