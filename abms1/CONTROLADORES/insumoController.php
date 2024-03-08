<?php 

include_once "../class/Conexion.php";
include_once "../class/INSUMOS_MYSQL.class.php";
include_once "../class/KARDEXINS_MYSQL.class.php";

$proceso=$_POST['proceso'];
$con= new Conexion();
$conexion= $con->ConexionDB();
$error = "";
$resultado = "";
session_start();

if (!isset($_SESSION['usuario'])) {
    $error = "Error Session";
    $reponse = array("error" => $error, "result" => $resultado);
    echo json_encode($reponse);
    return;
}
if (!$conexion) {

	 $error = "No se pudo establecer conexion. Intente nuevamente.";
    $reponse = array("error" => $error, "result" => $resultado);
    // echo  json_encode($reponse);
    return;
}
if ($proceso==="guardar") {
	$fecha=$_POST['fecha'];

$NombreInsumo=$_POST['NombreInsumo'];
$MedidaVenta=$_POST['MedidaVenta'];
$StockMinimo=$_POST['StockMinimo'];
$StockActual=$_POST['StockActual'];
$MedidaMedia=$_POST['MedidaMedia'];
$OperadorMedia=$_POST['OperadorMedia'];
$EquivalenciaMedia=$_POST['EquivalenciaMedia']==""?"0":$_POST['EquivalenciaMedia'];
$MedidaMaxima=$_POST['MedidaMaxima'];
$EquivalenciaMaxima=$_POST['EquivalenciaMaxima']==""?"0":$_POST['EquivalenciaMaxima'];
$OperadorMaxima=$_POST['OperadorMaxima'];
$con->transacion();
	$insumos= new INSUMOS_MYSQL($con);
	$kardex= new KARDEXINS_MYSQL($con);
	if (count($insumos->verificarNombre($NombreInsumo,0))>0) {
		$error.="<span style='font-weight: bold;'>* YA EXISTE ESE NOMBRE DE INSUMO.</span><br>";
	}
	$insumos->contructor(0,$NombreInsumo,$StockMinimo,$StockActual,$MedidaVenta,$MedidaMedia,$OperadorMedia,$EquivalenciaMedia,$OperadorMaxima,$MedidaMaxima,$EquivalenciaMaxima,'0','0','ACTIVO','0','0',0);
	$insertar= $insumos->insertar();
$modificar=$insumos->modificarCodigoinsumo($insertar);

$kardex->contructor(0,0,$insertar,$NombreInsumo,$StockActual,$fecha,$_SESSION['usuario'],$StockActual,0,$StockActual,"COMPRA",'0','0',0);
      $insertarkardex=$kardex->insertar();

      if ($insertarkardex===0) {
      	$error="<span style='font-weight: bold;'>* ERROR AL INSERTAR KARDEX.</span><br>";
      }
	if (!$modificar) {
		  $error = "<span style='font-weight: bold;'>* NO SE PUDO MODIFICAR EL INSUMO INTENTE NUEVAMENTE.</span><br>";
		
	}
	if ($insertar===0) {
		  $error = "<span style='font-weight: bold;'>* NO SE PUDO INSERTAR EL INSUMO INTENTE NUEVAMENTE.</span><br>";
		
	}
	if ($error!="") {
		  $con->rollback();
	}
	else{
			$con->commit();
		$resultado=$insumos->todo();
	}
}
if ($proceso==="cargarDatos") {
$id=$_POST['id'];

$con= new Conexion();
$conexion= $con->ConexionDB();
	$insumos= new INSUMOS_MYSQL($con);

 $resultado= $insumos->buscarXID($id);


}

if ($proceso==="modificar") {
$NombreInsumo=$_POST['nombreInsumo'];
$MedidaVenta=$_POST['medidaVenta'];
$StockMinimo=$_POST['stockMinimo'];
$StockActual=$_POST['stockActual'];
$MedidaMedia=$_POST['medidaMedia'];
$OperadorMedia=$_POST['operadorMedia'];
$EquivalenciaMedia=$_POST['equivalenciaMedia']==""?"0":$_POST['equivalenciaMedia'];
$MedidaMaxima=$_POST['medidaMaxima'];
$EquivalenciaMaxima=$_POST['equivalenciaMaxima'];
$OperadorMaxima=$_POST['operadorMaxima'];

$id=$_POST['idInsumo'];
$con->transacion();
	$insumos= new INSUMOS_MYSQL($con);
	if (count($insumos->verificarNombre($NombreInsumo,$id))>0) {
		$error.="<span style='font-weight: bold;'>* YA EXISTE ESE NOMBRE DE INSUMO.</span><br>";
	}
	$insumos->contructor(0,$NombreInsumo,$StockMinimo,$StockActual,$MedidaVenta,$MedidaMedia,$OperadorMedia,$EquivalenciaMedia,$OperadorMaxima,$MedidaMaxima,$EquivalenciaMaxima,'0','0','ACTIVO','0','0',0);
	$insertar= $insumos->modificarInsumo($id);
$insumos->modificarCodigoinsumo($insertar);

	if ($insertar===0) {
		  $error = "<span style='font-weight: bold;'>*No se pudo insertar al proveedor Intente nuevamente.</span><br>";
		 
	}
	if ($error!="") {
		  $con->rollback();
	}
	else{
			$con->commit();
		$resultado=$insumos->todo();
	}
}

if ($proceso==="aumentarStock") {
	session_start();
	$con= new Conexion();
$conexion= $con->ConexionDB();
	$insumos= new INSUMOS_MYSQL($con);
	$kardex= new KARDEXINS_MYSQL($con);
	$con->transacion();

	$idInsumo=$_POST['idInsumo'];
	$resInsumo= $insumos->buscarXID($idInsumo);
	$fecha=$_POST['fechaActual'];
	$recepcion=$_POST['recepcion'];
	$perdida=$_POST['perdida'];

	$total=$_POST['total'];
	if ($perdida=="") {
		$total=$recepcion;
		$perdida=0;
	}
	$saldo=$resInsumo[0]->STOCK_ACT+$total;

	if (!$insumos->alterarStock($idInsumo,$saldo)) {
	 	$error="error al actualizar  stock";
	 } 

	 if (!$insumos->modificarStockAumentado($idInsumo,$total)) {
	 	$error="error al actualizar  stock";
	 	
	 }
	$kardex->contructor(0,0,$idInsumo,$resInsumo[0]->NOM_INSUMO,$total,$fecha,$_SESSION['usuario'],$total,0,$saldo,"COMPRA",$recepcion,$perdida,0);
      $insertarkardex=$kardex->insertar();
      if ($insertarkardex===0) {
      	$error="ERROR AL INSERTAR KARDEX";
      }
      if ($error!="") {
      	  $error = "No se pudo insertar los datos.";
		  $con->rollback();
      }else{
			$con->commit();
      }
}

if ($proceso=="mostrarTodo") {
$con= new Conexion();
$conexion= $con->ConexionDB();
	$insumos= new INSUMOS_MYSQL($con);
	
	$resultado= $insumos->todo();
}
	
$reponse = array("error" => $error, "result" => $resultado);
echo  json_encode($reponse);
 ?>