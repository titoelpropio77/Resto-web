$(document).ready(function(){
    listarTodoUsuario();
});

$("#frmUsuarioGuardar").submit(function (e) {
    errores = ""
    nombrePers = $('#nom_usuario').val();
    login = $('#login').val();
    cargo = $('#selectNivel option:selected').html();
    clave = $('#clave').val();

    //esto evita que se haga la petición común, es decir evita que se refresque la pagina
    e.preventDefault();

    //ruta la cual recibira nuestro archivo
    // url="@Url.Content("~/Archivo/Recibe")"

    //FormData es necesario para el envio de archivo, 
    //y de la siguiente manera capturamos todos los elementos del formulario
    if (nombrePers == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO NOMBRE NO DEBE ESTAR VACIO.</span><br>";
    }
  
   if (login == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO LOGIN NO DEBE ESTAR VACIO.</span><br>";
    }
  
    if (clave == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO CLAVE NO DEBE ESTAR VACIO.</span><br>";

    }
    if (errores != "") {
        alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', errores, function () {
            alertify.message('OK');
        });
        return;
    }

    var parametros1 = new FormData($(this)[0]);
   parametros1.append('cargo',cargo);

    //realizamos la petición ajax con la función de jquery
    $.ajax({
        type: "POST",
        url: "CONTROLADORES/usuarioController.php",
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
            listarTodoUsuario();
            $('#modalUsuario').modal("hide");

            $('#frmUsuarioGuardar')[0].reset();
            
            
        },
        error: function (r) {

            alert("Error del servidor");
        }
    }).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});

});


function listarTodoUsuario(){
    // tbodyHistorico.empty();
    $('#tablaUsuario').DataTable().destroy();
    $('#tbodyUsuario').empty();

    $.post("CONTROLADORES/usuarioController.php", {proceso: "listarTodo"}, function (res) {
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
            
            $('#tbodyUsuario').append("<tr>"+
                "<td>"+json.result[i].ID+
                "<td>"+json.result[i].NOMBRES+
                "<td>"+json.result[i].CARGO+
                "<td>"+json.result[i].USUARIO+
                "<td>"+json.result[i].ESTADO+
                "<td><button onclick='cargarUsuario("+json.result[i].ID+")' class='btn btn-info'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"+
                "<button onclick='eliminarUsuario("+json.result[i].ID+")' class='btn btn-danger'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"
                );   
        }
        paginatorUsuario();
    }).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});
}
function paginatorUsuario(){
 $('#tablaUsuario').DataTable({
        "pagingType": "full_numbers",
        "destroy": true,
        "order": [[0, "asc"]],
        "scrollY": "418px",
        "scrollCollapse": true,
        "paging": false,
        retrieve: true

    });
}
idUsuario="";
function cargarUsuario(id){
idUsuario=id;
nombrePers = $('#nom_usuarioA');
    login = $('#loginA');
    cargo = $('#selectCargoA');
    clave = $('#claveA');
$.post('CONTROLADORES/usuarioController.php',{proceso:'buscarXID',id:idUsuario},function(res){
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
            nombrePers.val(json.result[0].NOMBRES);
    login.val(json.result[0].USUARIO);
    clave.val(json.result[0].CLAVES);
    cargo.val(json.result[0].NIVEL);
            $('#modalUsuarioModificar').modal('show');

}).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});
}


$("#frmUsuarioModificar").submit(function (e) {


    //esto evita que se haga la petición común, es decir evita que se refresque la pagina
    e.preventDefault();
        errores = ""
    
    nombrePers = $('#nom_usuarioA');
    login = $('#loginA');
    cargo = $('#selectCargoA option:selected').html();
    
    clave = $('#claveA');
    //ruta la cual recibira nuestro archivo
    // url="@Url.Content("~/Archivo/Recibe")"

    //FormData es necesario para el envio de archivo, 
    //y de la siguiente manera capturamos todos los elementos del formulario
    if (nombrePers == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO NOMBRE NO DEBE ESTAR VACIO.</span><br>";
    }
   
   if (login == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO LOGIN NO DEBE ESTAR VACIO.</span><br>";
    }
  
    if (clave == "") {
        errores += "<span style='font-weight: bold;'>* EL CAMPO CLAVE NO DEBE ESTAR VACIO.</span><br>";

    }
    if (errores != "") {
        alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', errores, function () {
            alertify.message('OK');
        });
        return;
    }

    var parametros1 = new FormData($(this)[0]);
   parametros1.append('cargo',cargo);
    parametros1.append("id",idUsuario);
    //realizamos la petición ajax con la función de jquery
    $.ajax({
        type: "POST",
        url: "CONTROLADORES/usuarioController.php",
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
            listarTodoUsuario();
            $('#modalUsuarioModificar').modal("hide");

            $('#frmUsuarioModificar')[0].reset();
            
            
        },
        error: function (r) {

            alert("Error del servidor");
        }
    }).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});

});



function eliminarUsuario(id){
$.post('CONTROLADORES/usuarioController.php',{proceso:'eliminarUsuario',id:id},function(res){
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
            listarTodoUsuario();
}).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});

}