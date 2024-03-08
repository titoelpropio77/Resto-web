<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="imagenes/logo.png" type="image/x-icon" />
	<title>Sistema PosGooN</title>
	<!-- bootstrap -->
<?php 
session_start();
  if (!isset($_SESSION['nombres'])) {
      echo header("location: ../index.php");
  }
  if (isset($_SESSION['nivel'])) {
                                    if ($_SESSION['nivel'] != 1) {
                                      echo header("location: ../index.php");
                                    }

                                }
 ?>
    <link href="css/cargando.css" rel="stylesheet">
    
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet">
    <link href="css/puglins/font-awesome.css" rel="stylesheet">

    <link href="css/puglins/AdminLTE.css" rel="stylesheet">
    <link href="css/puglins/alertify.css" rel="stylesheet">
    <link href="css/puglins/toastr.css" rel="stylesheet">
     <link href="css/bootstrap/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/puglins/jquery.datatable.css" rel="stylesheet">
    <link href="css/bootstrap/bootstrap-timepicker.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/datepicker3.css">

</head>
<body style=" box-shadow: 0 0 35px 8px black;">
	
	<div class="container">
    <nav class="navbar  navbar-inverse bg-primary" style="    background: #337ab7;
    border: solid #337ab7;">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
       <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
              </button>

      <a class="navbar-brand" href="../" style="background: red;
    color: white;">VOLVER A VENTAS</a>
      <!-- <a class="navbar-brand" href="#">Brand</a> -->
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="myNavbar">      
      <ul class="nav navbar-nav " style="      font-weight: bold;  font-size: 9pt;
">        
        <li id="navDashboard" name="liCierreDiario"><a      style="border-right: 1px solid #ccff00;" href="index.php"></i>Cierre diario</a></li>                      
        <li id="navDashboard" name="liReporteCaja"><a style="border-right: 1px solid #ccff00;" href="frmReproteCaja.php"></i>Reporte de Caja</a></li>                      
        <li id="navDashboard" name="liReporteProducto"><a style="border-right: 1px solid #ccff00;" href="frmReporteProducto.php"></i>Reporte de Productos</a></li>                      
        <li id="navDashboard" name="liReporteServicio"><a style="border-right: 1px solid #ccff00;" href="frmReporteServicios.php"></i>Reporte de Servicios</a></li>                      
        <li id="navDashboard" name="liReporteCliente"><a style="border-right: 1px solid #ccff00;" href="frmReporteCliente.php"></i>Reporte de Clientes</a></li>                      
        <li id="navDashboard" name="liMantenimiento"><a style="border-right: 1px solid #ccff00;" href="productos.php" > <i class="glyphicon glyphicon-cog"></i> Mantenimiento</span></a></li>  
    
        <li id="navBrand" name="liContabilidad"><a style="border-right: 1px solid #ccff00;" href="brand.php"><i class="glyphicon glyphicon-btc"></i>Contabilidad</a></li>        
        <!-- <li id="navReport"><a href="report.php"> <i class="glyphicon glyphicon-check"></i> Report </a></li> -->
        <li class="dropdown" id="navSetting">
          <a style="border-right: 1px solid #ccff00;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Ajuestes</a></li>            
            <li id="topNavLogout"><a id="btnlogout" href="../desconectar.php" name="btnlogout"> <i class="glyphicon glyphicon-log-out"></i> Cerrar Sesion</a></li>            
          </ul>
        </li>                       
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

  </nav>

