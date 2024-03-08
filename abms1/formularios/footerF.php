
	      </div>
	    </div>	    
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/plugins/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    <script src="../js/plugins/jquery.dataTables.min.js"></script>
    <script src="../js/bootstrap/dataTables.bootstrap.js"></script>
    <script src="../js/plugins/alertify.js"></script>
    <script src="../js/plugins/jquery-editable-select.js"></script>
    <script src="../js/plugins/HERRAMIENTAS.js"></script>
    <script type="text/javascript" src="../fullcalendar/lib/jquery-ui.custom.min.js"></script>
  <script src="../js/plugins/moment.min.js"></script>
  <script type="text/javascript" src="../fullcalendar/js/fullcalendar.js"></script>
  <script type="text/javascript" src='../fullcalendar/lang/es.js'></script>
    <script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
     $('.ghatable').dataTable({
        "pagingType": "full_numbers",
        "destroy": true,
        "order": [[0, "asc"]],
        "scrollY": "250px",
        "scrollCollapse": true,
        "paging": false,
        retrieve: true

    }); 
       $('#loading').css('display','none');  
     
	});
     function failErrors(xhr, ajaxOptions, thrownError){
    console.log(xhr.status)
    console.log(xhr.responseText)
    console.log(thrownError)
    error="";
    if (xhr.status === 0) {
        error="<span style='font-weight:bold'>* Error de conexión, verifica tu instalación de RED.</span><br>";
                 
    } else if (xhr.status == 302) {
           error="<span style='font-weight:bold'>* La página ha sido movida. error 302.</span><br>";
    } else if (xhr.status == 404) {
           error="<span style='font-weight:bold'>* La página no ha sido encontrada. error 404.</span><br>";
    } else if (xhr.status == 500) {
           error="<span style='font-weight:bold'>* Internal Server Error error 500.</span><br>";
    } else if (thrownError === 'parsererror') {
        error="<span style='font-weight:bold'>* Error parse JSON.</span><br>";
    } else if (thrownError === 'timeout') {
        error="<span style='font-weight:bold'>* Exceso tiempo.</span><br>";
    } else if (thrownError === 'abort') {
        error="<span style='font-weight:bold'>* Petición post abortada.</span><br>";
    } else {
        error="<span style='font-weight:bold'>* ERROR desconocido:  "+ xhr.responseText+".</span><br>";
    }    
    if (error!="") {
        alertify.alert('<span style="font-weight: bold;    color: red;">ERROR</span>', error, function () {
                    alertify.message('OK');
                });
    }   
}
    </script>
  </body>
</html> 