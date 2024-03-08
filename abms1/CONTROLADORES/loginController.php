<?php 


function loguear(){

include_once ( "abms1/class/USUARIOS_MYSQL.class.php");
include_once ( "abms1/class/CORRELATIVOS.class.php");
include_once ( "abms1/class/EMPRESA_MYSQL.class.php");


$fechaActual=date("Y")."-".date('m')."-".date("d");
$proceso=$_POST['proceso'];
$con= new Conexion();
$conexion= $con->ConexionDB();
$error = "";
$resultado = "";
if (!$con->estado) {
    $error = "No se pudo establecer conexion. Intente nuevamente.";
    $reponse = array("error" => $error, "result" => $resultado);
    echo  json_encode($reponse);
    return;

}
$usuario=strtoupper($_POST['usuario']);
$password=$_POST['password'];

$usuarios=new USUARIOS_MYSQL($con);
$inguser=new INGUSER_MYSQL($con);
$empresa=new EMPRESA_MYSQL($con);
$verificar=$usuarios->verificarExitencia($usuario,$password,0);



if (count($verificar)>0) {
	$cambio=0;
	$correlativo = new CORRELATIVOS($con);
	$resulEmpresa=$empresa->obtenerUltimo();
	$fechaactual = getdate();


    $nombreTabla = "ven_gral_mysql";
    $listacorre = $correlativo->mostrarUltimo($nombreTabla);
	$listaInsUser=$inguser->CAM_OF($usuario);
	$tipoCambio=$_POST['tipoCambio'];
	$ultimoUser=$inguser->obtenerUltimo();
	ini_set('date.timezone','America/La_Paz'); 
	 $now = date('G:i');
	$inguser->contructor($ultimoUser[0]->INGRESOS+1,$usuario,$fechaActual,$now,$tipoCambio,0);
	$insertar=$inguser->insertar();
	if ($insertar==0) {
		echo "<script> alert('ERROR AL REGISTRAR USUARIO')</script>";
		return;
	}
	$_SESSION['camoff'] =$_POST['tipoCambio'];
	$_SESSION['nombres'] = $verificar[0]->NOMBRES;
	$_SESSION['usuario'] =strtoupper($verificar[0]->USUARIO);
	$_SESSION['nivel'] =  $verificar[0]->NIVEL;

	$_SESSION['cargo'] = $verificar[0]->CARGO;
    $_SESSION['ordenDia']= $listacorre[0]->ordendia;
    $_SESSION['HINITM']=$resulEmpresa[0]->HINITM;
    $_SESSION['HFINTM']=$resulEmpresa[0]->HFINTM;
    
    // $begintime=$_SESSION['HINITM'];
    
    $endtime= $_SESSION['HFINTM'];

              //echo '<script type="text/javascript">  $("#ModalLogin").modal("hide"); </script>';
   header("location:index.php");
return true;
		
}
return false;
}
function logout(){

@session_start();
$_SESSION['nivel']=null;
session_destroy();
header("Location: index.php");
}
 ?>