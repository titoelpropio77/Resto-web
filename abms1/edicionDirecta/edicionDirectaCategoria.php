<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

	
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="opensource jquery bootstrap editable table spreadsheet" />
    <meta name="description" content="" />
    <link rel="shortcut icon" href="../imagenes/logo.png" />
    <link href="external/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="../css/bootstrap/bootstrap.css" rel="stylesheet">
    <script src="../js/plugins/jquery.min.js"></script>
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    <script src="external/google-code-prettify/prettify.js"></script>
		<link href="index.css" rel="stylesheet">
    <script src="mindmup-editabletable.js"></script>
    <script src="numeric-input-example.js"></script>
  </head>
  <body>
<div class="container" style="    margin: 0;
">
    <button class="btn btn-success" onclick="modificarTodo();">GUARDAR DATOS</button>
          <table id="mainTable" class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>NOM_GRUPO</th>
                <th>ESTADO</th>
                <th>COLORES</th>
              <th>GRUPO</th>
              <th>ORDEN</th>  
           
            </tr></thead>
            <tbody id="tbodyMenuGrupo">
    
            </tbody>
			<!-- <tfoot><tr><th><strong>TOTAL</strong></th><th></th><th></th><th></th></tr></thead> -->
          </table>
</div>


     
<script>
  function listarMenuGrupo(){
 $('#tbodyMenuGrupo').empty();
    $.post('../CONTROLADORES/menuGrupoController.php', {proceso: 'mostrarTodo'}, function (res,estado) {
        var json = JSON.parse(res);
     
            if (json.error.length > 0) {
                if ("Error Session" === json.error) {
                    $('#loading').css('display', 'none');

                    alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', "DEBE ENTRAR EN SESION NUEVAMENTE", function () {
                        alertify.message('OK');
                        window.location = "desconectar.php";
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
          $('#tbodyMenuGrupo').append('<tr>'+
            '<td>'+json.result[i].id+
            '<td>'+json.result[i].nom_grupo+
            '<td>'+json.result[i].estado+
            '<td>'+json.result[i].colores+
            '<td>'+json.result[i].grupo+
            '<td>'+json.result[i].orden
            )
       
        }
        $('#mainTable').editableTableWidget().focus();
  $('#textAreaEditor').editableTableWidget({editor: $('<textarea>')});
  window.prettyPrint && prettyPrint();
      });

    }
</script>
<script>
  
  listarMenuGrupo();
</script>


<script>
  function  modificarTodo(){
     var id=new Array();
    var nom_grupo=new Array();
    var estado=new Array();
    var colores=new Array();
    var grupo=new Array();
    var orden=new Array();
    

 tabla = $('tbody tr');

if (tabla.length>0) {


$(tabla).each(function (e) {

     id.push($(this).closest("tr").find("td").eq(0).text());
     nom_grupo.push($(this).closest("tr").find("td").eq(1).text());
     estado.push($(this).closest("tr").find("td").eq(2).text());
     colores.push($(this).closest("tr").find("td").eq(3).text());
     grupo.push($(this).closest("tr").find("td").eq(4).text());
     orden.push($(this).closest("tr").find("td").eq(5).text());

});
}
$.post('../CONTROLADORES/menuGrupoController.php',{proceso:'modificarMenuGrupoTodo',idMenuGrupo:id,nombre:nom_grupo,estado:estado,colores:colores,
grupo:grupo,orden:orden},function(res){
        var json = JSON.parse(res);
            if (json.error.length > 0) {
                if ("Error Session" === json.error) {
                    $('#loading').css('display', 'none');
                    alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', "DEBE ENTRAR EN SESION NUEVAMENTE", function () {
                        alertify.message('OK');
                        window.location = "desconectar.php";
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
});
}


 </script>

      
  </body>
</html>
