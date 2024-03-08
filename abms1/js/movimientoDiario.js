$(document).ready(function(){
  var hoy = new Date();
var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1; //hoy es 0!
    var yyyy = hoy.getFullYear();
    if (dd < 10) {  dd = '0' + dd }
    if (mm < 10) {  mm = '0' + mm  }
    hoy = yyyy + '-' + mm + '-' +dd ;
    listarMovimientoDiario(hoy);
	
$('#calendar').fullCalendar({
   
       lang: 'es',
      editable: true,
      disableDragging: true,
      navLinks: false, // can click day/week names to navigate views
      selectable: true,
      selectHelper: true,
     
      eventMouseover: function( event, jsEvent, view ) { 
      	 background: 'red';
      	 textColor: 'red'
      },
      select: function(date,start, end) {
           var moment = date;
           fecha=moment.format('YYYY-MM-DD ');
    listarMovimientoDiario(fecha);

	
      },

      editable: false,
      eventLimit: true,
      color: 'yellow',   // an option!
    textColor: 'red' // an option!
      // events:
    });
});



function listarMovimientoDiario(fecha){
   $('#tbodyKardex').empty();
  $.post('../CONTROLADORES/kardexController.php',{proceso:'listarMovimientoDiario',fecha:fecha},function(res){
     var json = $.parseJSON(res);
     for (var i = 0; i < json.result.length; i++) {
       $('#tbodyKardex').append("<tr><td style='width: 10%;'>"+json.result[i].ID+
          "<td style='width: 23%;'>"+json.result[i].NOM_INSUMO+
          "<td style='width: 33%;'>"+json.result[i].MOVIMIENTO+
          "<td style='width: 12%;'>"+json.result[i].ENTRADA+
          "<td style='width: 10%;'>"+json.result[i].SALIDA+
          "<td style='width: 10%;'>"+json.result[i].SALDO
        );
     }
      
  });
}