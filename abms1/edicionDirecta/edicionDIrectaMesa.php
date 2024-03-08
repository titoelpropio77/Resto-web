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
              <tr><th>ID</th>
                <th>NOM_MESA</th>
                <th>ESTADO</th>
                <th>USO</th>
              <th>ORDEN</th>
              <th>COLORES</th>  
              <th>PROCESANDO</th>
              <th>DELETEADO</th>
              <th>NROPERSONA</th>
              <th>NROPERSONA</th>
              <th>NOM_CLI</th>
            </tr></thead>
            <tbody id="tbodyMesa">
              
            </tbody>
			<!-- <tfoot><tr><th><strong>TOTAL</strong></th><th></th><th></th><th></th></tr></thead> -->
          </table>
</div>


     
<script>
  function listarMesa(){
 $('#tbodyMesa').empty();
    $.post('../CONTROLADORES/mesasController.php', {proceso: 'listarTodo'}, function (res,estado) {
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
          $('#tbodyMesa').append('<tr>'+
            '<td>'+json.result[i].ID+
            '<td>'+json.result[i].NRO_MESA+
            '<td>'+json.result[i].ESTADO+
            '<td>'+json.result[i].USO+
            '<td>'+json.result[i].ORDEN+
            '<td>'+json.result[i].COLORES+
            '<td>'+json.result[i].PROCESANDO+
            '<td>'+json.result[i].DELETEADO+
            '<td>'+json.result[i].NROPERSONA+
            '<td>'+json.result[i].NROORDEN+
            '<td>'+json.result[i].NOM_CLI
            )
        
        }
        $('#mainTable').editableTableWidget().focus();
  $('#textAreaEditor').editableTableWidget({editor: $('<textarea>')});
  window.prettyPrint && prettyPrint();
      });

    }
</script>
<script>
  
  listarMesa();
</script>


<script>
  function  modificarTodo(){

     var ID=new Array();
    var NRO_MESA=new Array();
    var ESTADO=new Array();
    var USO=new Array();
    var ORDEN=new Array();
    var COLORES=new Array();
    var PROCESANDO=new Array();
    var DELETEADO=new Array();
    var NROPERSONA=new Array();
    var NROORDEN=new Array();
    var NOM_CLI=new Array();

 tabla = $('tbody tr');

if (tabla.length>0) {


$(tabla).each(function (e) {

     ID.push($(this).closest("tr").find("td").eq(0).text());
     NRO_MESA.push($(this).closest("tr").find("td").eq(1).text());
     ESTADO.push($(this).closest("tr").find("td").eq(2).text());
     USO.push($(this).closest("tr").find("td").eq(3).text());
     ORDEN.push($(this).closest("tr").find("td").eq(4).text());
     COLORES.push($(this).closest("tr").find("td").eq(5).text());
     PROCESANDO.push($(this).closest("tr").find("td").eq(6).text());
     DELETEADO.push($(this).closest("tr").find("td").eq(7).text());
     NROPERSONA.push($(this).closest("tr").find("td").eq(8).text());
     NROORDEN.push($(this).closest("tr").find("td").eq(9).text());
     NOM_CLI.push($(this).closest("tr").find("td").eq(10).text());
    
});
$.post('../CONTROLADORES/mesasController.php',{proceso:'modificarTodo',ID:ID,NRO_MESA:NRO_MESA,ESTADO:ESTADO,USO:USO,
ORDEN:ORDEN,COLORES:COLORES,PROCESANDO:PROCESANDO,DELETEADO:DELETEADO,NROPERSONA:NROPERSONA,NROORDEN:NROORDEN,NOM_CLI:NOM_CLI},function(res){
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
            alert("guardado correctamente");

});
}

}


 </script>

      
  </body>
</html>
