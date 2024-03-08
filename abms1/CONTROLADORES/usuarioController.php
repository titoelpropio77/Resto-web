<?php 

include_once "../class/Conexion.php";
include_once "../class/USUARIOS_MYSQL.class.php";
include_once "../class/VEN_GRAL_MYSQL.class.php";

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
switch ($proceso) {
	case 'listarTodo':
		$usuario=new USUARIOS_MYSQL($con);
		$resultado=$usuario->todo();

		break;
	case 'listarUsuarioVenta':
	$fecha=$_POST['fecha'];
			$usuario=new VEN_GRAL_MYSQL($con);

		$resultado=$usuario->listarUsuarioVenta($fecha);
		break;
	case 'guardar':
	    $nom_usuario = $_POST['nom_usuario'];
    	$login = trim($_POST['login']);
    	$cargo = trim($_POST['cargo']);
    	$clave = trim($_POST['clave']);
    	$nivel = $_POST['nivel'];
		$con->transacion();
		$usuario=new USUARIOS_MYSQL($con);
		$existe=$usuario->verificarExitencia($login,$clave,0);
		if (count($existe)>0) {
			$error="YA EXISTE ESE USUARIO";
		}
		$usuario->contructor(0,$nom_usuario,$cargo,$login,"ACTIVO",$clave,$nivel,"","","","","",0);
		$insertar=$usuario->insertar();
		if ($insertar==0) {
			$error="ERROR AL INSERTAR USUARIO";
		}
		if ($error!="") {
			$con->rollback();
		}else{
			$con->commit();
		}
		break;
		case 'buscarXID':
			$id=$_POST['id'];
			$usuario=new USUARIOS_MYSQL($con);
			$resultado=$usuario->buscarXID($id);
			break;
	case 'modificar':
		$id=$_POST['id'];
		$nom_usuario = $_POST['nom_usuario'];
    	$login = trim($_POST['login']);
    	 $cargo = trim($_POST['cargo']);
    	$clave = trim($_POST['clave']);
    	$nivel = $_POST['nivel'];
		$con->transacion();
 		$usuario=new USUARIOS_MYSQL($con);
 		$existe=$usuario->verificarExitencia($login,$clave,$id);
		if (count($existe)>0) {
			$error="YA EXISTE ESE USUARIO";
		}
 		$usuario->contructor(0,$nom_usuario,$cargo,$login,"ACTIVO",$clave,$nivel,"","","","","",0);
 		$modificar=$usuario->modificarTodo($id);
 		if (!$modificar) {
			$error="ERROR AL MODIFICAR USUARIO";
		}
		if ($error!="") {
			$con->rollback();
		}else{
			$con->commit();
		}
		break;
	case 'eliminarUsuario':
		$id=$_POST['id'];
		$con->transacion();
 		$usuario=new USUARIOS_MYSQL($con);
		$eliminar=$usuario->eliminar($id);
		if (!$eliminar) {
			$error="ERROR AL ELIMINAR USUARIO";
		}
		if ($error!="") {
			$con->rollback();
		}else{
			$con->commit();
		}
		break;
	case 'listarCajero':
 		$usuario=new USUARIOS_MYSQL($con);
 		$resultado=$usuario->listarCajero();
		break;
	default:

		# code...
		break;
}

$reponse = array("error" => $error, "result" => $resultado);
echo  json_encode($reponse);
 ?>