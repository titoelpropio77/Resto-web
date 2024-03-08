<?php 

include_once "../class/Conexion.php";
include_once "../class/EMPLEADOS_MYSQL.class.php";

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
    $direccion=$_POST['direccion'];
    $ci=$_POST['ci'];
    $cargo=$_POST['cargo'];
    $salario=$_POST['salario']==""?"0":$_POST['salario'];
    $porcentajeV=$_POST['porcentajeV']==""?"0":$_POST['porcentajeV'];
    $clave=$_POST['clave'];
    $colores=$_POST['colores'];
    $con->transacion();
    $empleado=new EMPLEADOS_MYSQL($con);
    $empleado->contructor(0,$nombre,$direccion,$ci,$cargo,$salario,"ACTIVO",$porcentajeV,$colores,$clave,0);
    $insertar=$empleado->insertar();
    $modificar=$empleado->modificarCodigo($insertar);
    if ($insertar==0 || !$modificar) {
        $error.="<span style='font-weight: bold;'>* ERROR AL GUARDAR PERSONAL.</span><br>";
    }

    if ($error!="") {
        $con->rollback();
    }else{
        $con->commit();
    }
}
if ($proceso==="modificar") {
    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $direccion=$_POST['direccion'];
    $ci=$_POST['ci'];
    $cargo=$_POST['cargo'];
    $salario=$_POST['salario']==""?"0":$_POST['salario'];
    $porcentajeV=$_POST['porcentajeV']==""?"0":$_POST['porcentajeV'];
    $clave=$_POST['clave'];
    $colores=$_POST['colores'];
    $con->transacion();
    $empleado=new EMPLEADOS_MYSQL($con);
    $empleado->contructor(0,$nombre,$direccion,$ci,$cargo,$salario,"",$porcentajeV,$colores,$clave,0);
    $modificar=$empleado->modificarPersonal($id);
    if (!$modificar) {
        $error.="<span style='font-weight: bold;'>* ERROR AL MODIFICAR PERSONAL.</span><br>";
    }

    if ($error!="") {
        $con->rollback();
    }else{
        $con->commit();
    }
}
if ($proceso=="eliminarPersonal") {
    $id=$_POST['id'];
    $empleado=new EMPLEADOS_MYSQL($con);
    $eliminar=$empleado->eliminarPersonal($id);
    if (!$eliminar) {
        $error.="<span style='font-weight: bold;'>* ERROR AL ELIMINAR PERSONAL.</span><br>";
    }
}
if ($proceso==="listarTodo") {
	$empleado=new EMPLEADOS_MYSQL($con);
	$resultado=$empleado->todo();
}
if ($proceso==="verificarMesero") {
	$empleado=new EMPLEADOS_MYSQL($con);
	
}
if ($proceso==="buscarXID") {
    $id=$_POST['id'];
    $empleado=new EMPLEADOS_MYSQL($con);
    $resultado=$empleado->buscarXID($id);
}
$con->closed();
$reponse = array("error" => $error, "result" => $resultado);
echo  json_encode($reponse);
 ?>