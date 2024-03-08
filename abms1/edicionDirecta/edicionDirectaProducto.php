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
    <style type="text/css">
     /* #mainTable thead th, #mainTable tbody td{
            width: 10%;
      }*/
    </style>
  </head>
  <body>
<div class="" style="     width: 2749px;   margin: 0;
">
    <button class="btn btn-success" onclick="modificarTodo();">GUARDAR DATOS</button>
    <div class="">
          <table  style="margin: 0;" class="table table-striped" border="1">
            <thead>
              <tr><td style="    width: 2%;">ID</td>
                <th style="    width: 11%;">NOM_PROD</th>
                <th>CANTIDAD</th>
                <th>PRE_VENTA</th>
              <th>UNID</th>
              <th>GRUPO</th>  
              <th>ESTADO</th>
              <th>PRESA</th>
              <th>UNIDAD</th>
              <th>COLORES</th>
              <th>BARCODE</th>
              <th>INDICE</th>
              <th>CODEQR</th>
              <th>F_VENCE</th>
              <th>TIEMPO</th>
              <th>TIEMPO_INI</th>
              <th>TIEMPO_FIN</th>
              <th>IMPCOC</th>
              <th>IMPPUNT1</th>
              <th>IMPPUNT2</th>
              <th>IMPPUNT3</th>
              <th>IMPPUNT4</th>
              <th>IMGNORMAL</th>
              <th>LUN</th>
              <th>MAR</th>
              <th>MIER</th>
              <th>JUE</th>
              <th>VIE</th>
              <th>SAB</th>
              <th>DOM</th>
              <th>HORA_INICIO</th>
              <th>HORA_FIN</th>
            </tr></thead>
            
			<!-- <tfoot><tr><th><strong>TOTAL</strong></th><th></th><th></th><th></th></tr></thead> -->
          </table>
          </div>
          <div style="    height: 592px;    overflow: auto;">
            <table id="mainTable" border="1">

              <tbody id="tbodyProducto">
              
            </tbody>
            </table>
          </div>
</div>


     
<script>
  function listarProducto(){
 $('#tbodyProducto').empty();
    $.post('../CONTROLADORES/productoController.php', {proceso: 'mostrarTodo'}, function (res,estado) {
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
          $('#tbodyProducto').append('<tr>'+
            '<td style="    width: 2%;">'+json.result[i].id+
              '<td style="width:  11%">'+json.result[i].nom_prod+
              '<td style="width:  4%">'+json.result[i].cantidad+
              '<td style="width:  4%">'+json.result[i].pre_venta+
              '<td style="width:  2%">'+json.result[i].unid+
              '<td style="width:  3%">'+json.result[i].grupo+
              '<td style="width:  3%">'+json.result[i].estado+
              '<td style="width:  3%">'+json.result[i].presa+
              '<td style="width:  3%">'+json.result[i].unidad+
              '<td style="width:  3%">'+json.result[i].colores+
              '<td style="width:  3%">'+json.result[i].barcode+
              '<td style="width:  3%">'+json.result[i].indice+
              '<td style="width:  4%">'+json.result[i].codeqr+
              '<td style="width:  3%">'+json.result[i].f_vence+
              '<td style="width:  3%">'+json.result[i].tiempo+
              '<td style="width:  4%">'+json.result[i].tiempo_ini+
              '<td style="width:  4%">'+json.result[i].tiempo_fin+
              '<td style="width:  2%">'+json.result[i].impcoc+
              '<td style="width:  4%">'+json.result[i].imppunt1+
              '<td style="width:  3%">'+json.result[i].imppunt2+
              '<td style="width:  4%">'+json.result[i].imppunt3+
              '<td style="width:  3%">'+json.result[i].imppunt4+
              '<td style="width:  5%">'+json.result[i].imgnormal+
              '<td style="width:  1%">'+json.result[i].lun+
              '<td style="width:  2%">'+json.result[i].mar+
              '<td style="width:  2%">'+json.result[i].mier+
              '<td style="width:  2%">'+json.result[i].jue+
              '<td style="width:  1%">'+json.result[i].vie+
              '<td style="width:  2%">'+json.result[i].sab+
              '<td style="width:  2%">'+json.result[i].dom+
              '<td style="width:  4%">'+json.result[i].hora_inicio+
              '<td style="width:  7%">'+json.result[i].hora_fin
            )
         
        }
        $('#mainTable').editableTableWidget().focus();
  $('#textAreaEditor').editableTableWidget({editor: $('<textarea>')});
  window.prettyPrint && prettyPrint();
      });

    }
</script>
<script>
  
  listarProducto();
</script>


<script>
  function  modificarTodo(){
     var id=new Array();
    var nom_prod=new Array();
    var cantidad=new Array();
    var pre_venta=new Array();
    var unid=new Array();
    var grupo=new Array();
    var estado=new Array();
    var presa=new Array();
    var unidad=new Array();
    var colores=new Array();
    var barcode=new Array();
    var indice=new Array();
    var codqr=new Array();
    var f_vence=new Array();
    var tiempo=new Array();
    var tiempo_ini=new Array();
    var tiempo_fin=new Array();
    var impcoc=new Array();
    var imppunt1=new Array();
    var imppunt2=new Array();
    var imppunt3=new Array();
    var imppunt4=new Array();
    var imgnormal=new Array();
    var lun=new Array();
    var mar=new Array();
    var mier=new Array();
    var jue=new Array();
    var vie=new Array();
    var sab=new Array();
    var dom=new Array();
    var hora_inicio=new Array();
    var hora_fin=new Array();
 tabla = $('tbody tr');

if (tabla.length>0) {


$(tabla).each(function (e) {

     id.push($(this).closest("tr").find("td").eq(0).text());
     nom_prod.push($(this).closest("tr").find("td").eq(1).text());
     cantidad.push($(this).closest("tr").find("td").eq(2).text());
     pre_venta.push($(this).closest("tr").find("td").eq(3).text());
     unid.push($(this).closest("tr").find("td").eq(4).text());
     grupo.push($(this).closest("tr").find("td").eq(5).text());
     estado.push($(this).closest("tr").find("td").eq(6).text());
     presa.push($(this).closest("tr").find("td").eq(7).text());
     unidad.push($(this).closest("tr").find("td").eq(8).text());
     colores.push($(this).closest("tr").find("td").eq(9).text());
     barcode.push($(this).closest("tr").find("td").eq(10).text());
     indice.push($(this).closest("tr").find("td").eq(11).text());
     codqr.push($(this).closest("tr").find("td").eq(12).text());
     f_vence.push($(this).closest("tr").find("td").eq(13).text());
     tiempo.push($(this).closest("tr").find("td").eq(14).text());
     tiempo_ini.push($(this).closest("tr").find("td").eq(15).text());
     tiempo_fin.push($(this).closest("tr").find("td").eq(16).text());
     impcoc.push($(this).closest("tr").find("td").eq(17).text());
     imppunt1.push($(this).closest("tr").find("td").eq(18).text());
     imppunt2.push($(this).closest("tr").find("td").eq(19).text());
     imppunt3.push($(this).closest("tr").find("td").eq(20).text());
     imppunt4.push($(this).closest("tr").find("td").eq(21).text());
     imgnormal.push($(this).closest("tr").find("td").eq(22).text());
     lun.push($(this).closest("tr").find("td").eq(23).text());
     mar.push($(this).closest("tr").find("td").eq(24).text());
     mier.push($(this).closest("tr").find("td").eq(25).text());
     jue.push($(this).closest("tr").find("td").eq(26).text());
     vie.push($(this).closest("tr").find("td").eq(27).text());
     sab.push($(this).closest("tr").find("td").eq(28).text());
     dom.push($(this).closest("tr").find("td").eq(29).text());
     hora_inicio.push($(this).closest("tr").find("td").eq(30).text());
     hora_fin.push($(this).closest("tr").find("td").eq(31).text());
     
});

}
$.post('../CONTROLADORES/productoController.php',{proceso:'modificarProductoTodo',idProducto:id,nombre:nom_prod,pre_venta:pre_venta,unid:unid,
grupo:grupo,estado:estado,presa:presa,unidad:unidad,cantidad:cantidad,colores:colores,barcode:barcode,indice:indice,codqr:codqr,f_vence:f_vence,tiempo:tiempo,tiempo_ini:tiempo_ini,tiempo_fin:tiempo_fin,impcoc:impcoc,imppunt1:imppunt1,imppunt2:imppunt2,imppunt3:imppunt3,imppunt4:imppunt4,imgnormal:imgnormal,lun:lun,mar:mar,mier:mier,jue:jue,vie:vie,sab:sab,dom:dom,hora_inicio:hora_inicio,hora_fin:hora_fin},function(res){
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
            alert("GUARDADO CORRECTAMENTE");

});
}


 </script>

      
  </body>
</html>
