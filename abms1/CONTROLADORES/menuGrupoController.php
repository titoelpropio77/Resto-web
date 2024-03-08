<?php 

include_once "../class/Conexion.php";
include_once "../class/menugrupo.php";

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
$nombre=$_POST['nombre'];
$estado=$_POST['estado'];
$color=$_POST['color'];
$orden=$_POST['orden'];
if ($orden=="") {
	$orden=NULL;
}
	$con->transacion();
	$menugrupo= new menugrupo($con);
	$menugrupo->contructor(0,0,$nombre,$estado,$color,0,$orden);
	$insertar= $menugrupo->insertar();
	$menugrupo->contructor(0,$insertar,'','','',$insertar,0);
	$modificar= $menugrupo->modificarCodigoGrupo($insertar);

	if ($insertar===0) {
		  $error = "No se pudo insertar EL GRUPO. Intente nuevamente.";
		  $con->rollback();
	}else{
		$con->commit();
		$resultado=$menugrupo->todo();
	}
}
if ($proceso==="cargarDatos") {
$id=$_POST['id'];
$con->transacion();
	$menugrupo= new menugrupo($con);
	
	$resultado= $menugrupo->ListarDadaId($id);

}


if ($proceso==="mostrarTodo") {

 $menugrupo=new menugrupo($con);
 $resultado= $menugrupo->todo();
}
if ($proceso=="modificarMenuGrupo") {
	$con->transacion();
	$id=$_POST['id'];
	$nombre=$_POST['nombre'];
    $estado=$_POST['estado'];
    $color=$_POST['color'];
    $orden=$_POST['orden']==""?0:$_POST['orden'];
$menugrupo= new menugrupo($con);
	$menugrupo->contructor(0,0,$nombre,$estado,$color,0,$orden);
	$modificarMenuGrupo=$menugrupo->modificarMenuGrupo($id,$orden);
if (!$modificarMenuGrupo) {
		  $error = "No se pudo modificar  Intente nuevamente.";
		  $con->rollback();
	}else{
		$con->commit();
	}

}
if ($proceso=="modificarMenuGrupoTodo") {
	$con->transacion();
	$id=$_POST['idMenuGrupo'];
	$nombre=$_POST['nombre'];
    $estado=$_POST['estado'];
    $color=$_POST['colores'];
    $orden=$_POST['orden'];
$menugrupo= new menugrupo($con);
for ($i=0; $i <count($id) ; $i++) { 
	$menugrupo->contructor(0,0,$nombre[$i],$estado[$i],$color[$i],0,$orden[$i]);
	$modificarMenuGrupo=$menugrupo->modificarMenuGrupo($id[$i],$orden[$i]);
	if (!$modificarMenuGrupo) {
		$error="ERROR AL MODIFICAR GRUPO";

	}

}
if ($error!="") {
	$con->rollback();
}else $con->commit();

}
$reponse = array("error" => $error, "result" => $resultado);
echo  json_encode($reponse);
 ?>