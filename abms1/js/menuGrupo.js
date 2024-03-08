var opcion =0;

$(document).ready(function(){

cargarGrupo();
});

function guardarGrupo(){
	nombre=$('#NombreGrupo').val();
	estado=$('#estadoGrupo').val();
	color=$('#colorGrupo').val();
	orden=$('#orden').val();
    		selectGrupo=$('#selectGrupo');
	
	selectGrupo.empty();

	$('#loading').css('display','block');
	url="CONTROLADORES/menuGrupoController.php";
	$.ajax({
		url:url,
		type:'POST',
		typedata:'json',
		data:{proceso:"guardar",nombre:nombre,estado:estado,color:color,orden:orden},
		success:function(res){
$('#loading').css('display','none');

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
            }else{
        	  alertify.success('GUARDADO CORRECTAMENTE');
			
        	for (var i = 0; i < json.result.length; i++) {
        		selectGrupo.append("<option value='"+json.result[i].grupo+"'' >"+json.result[i].nom_grupo);
        	}
        	$('#ModaAgregarGrupo').modal('hide');
        	$('#ModaListarGrupo').modal('hide');
        	cargarGrupo();
        }


		},
	}).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});
}
idGrupo=""
function cargarDatoGrupo(id){
idGrupo=id;
	nombre=$('#NombreGrupoA');
	estado=$('#estadoGrupoA');
	color=$('#colorGrupoA');
	orden=$('#ordenGrupoA');
url="CONTROLADORES/menuGrupoController.php";
$('#loading').css('display','block');
$.ajax({
		url:url,
		type:'POST',
		typedata:'json',
		data:{proceso:"cargarDatos",id:id},
		success:function(res){
$('#loading').css('display','none');

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
            }else{
        	nombre.val(json.result.nom_grupo);
        	estado.val(json.result.estado);
			color.val(json.result.colores);
			
			orden.val(json.result.orden);
        }


		},
	}).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});

}

function cargarGrupo(){
	var grupo=$('select[name=grupo]');
    grupo.empty();
	var tbodyGrupo=$('#tbodyGrupo');
	$('#ghatableGrupo').DataTable().destroy();
    tbodyGrupo.empty();
$.post('CONTROLADORES/menuGrupoController.php', {proceso: 'mostrarTodo'}, function (res) {
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
 	for (var i = 0; i < json.result.length; i++) {
 		grupo.append('<option value="'+json.result[i].id+'"> '+json.result[i].nom_grupo);
 		tbodyGrupo.append('<tr><td>'+json.result[i].id+
 			'<td>'+json.result[i].cod_grupo+
 			'<td>'+json.result[i].nom_grupo+
 			'<td>'+json.result[i].estado+
 			'<td><button onclick="cargarDatoGrupo('+json.result[i].id+')" class="btn btn-info" title="EDITAR GRUPO" data-toggle="modal" data-target="#ModalModificarGrupo"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>');
 	}
 	paginadorGrupo();
 }).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});
}


function paginadorGrupo() {
    $('#ghatableGrupo').DataTable({
        "pagingType": "full_numbers",
 		"scrollY":        "330px",
        "scrollCollapse": true,
        "paging":         false,
        retrieve: true,
    });
}

function modificarMenuGrupo(){
    nombre=$('#NombreGrupoA').val();
    estado=$('#estadoGrupoA').val();
    color=$('#colorGrupoA').val();
    orden=$('#ordenGrupoA').val();
$.post('CONTROLADORES/menuGrupoController.php',{proceso:'modificarMenuGrupo',id:idGrupo,nombre:nombre,estado:estado,color:color,orden:orden},function(res){
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
cargarGrupo();
$('#ModalModificarGrupo').modal('hide');
}).fail(function(xhr, ajaxOptions, thrownError){
    failErrors(xhr, ajaxOptions, thrownError);  
});
}