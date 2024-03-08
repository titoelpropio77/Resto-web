<?php 

include_once "../class/Conexion.php";
include_once "../class/DETALLES_MYSQL.class.php";
include_once "../class/VEN_GRAL_MYSQL.class.php";
include_once "../class/DETTARJETA_MYSQL.class.php";
include_once "../class/PRODUCTOS_MYSQL.class.php";
include_once "../class/RELPROINS_MYSQL.class.php";
include_once "../class/INSUMOS_MYSQL.class.php";
$proceso=$_POST['proceso'];
$con= new Conexion();
$conexion= $con->ConexionDB();
$error = "";
$resultado = "";
$resultado2 = "";
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


if ($proceso==="buscarTarjetaGift") {
    $tarjeta=$_POST['tarjeta'];
    $venta = new VEN_GRAL_MYSQL($con);
    $detalle=new DETTARJETA_MYSQL($con);
    $resultado=$venta->buscarTarjetaGift($tarjeta);
    $resultado2=$detalle->buscarDetTarjetaGift($tarjeta);
}
if ($proceso==="guardar") {
   $tarjeta=$_POST['tarjeta'];
   $idProducto = $_POST['idProducto'];
   $cantidad = $_POST['cantidad'];
   $turno = $_POST['turno'];
   $nota = $_POST['notaPducto'];
   $totalBs=$_POST['totalBs'];
   $fechaVenta = $_POST['fechaVenta'];
   $nuevoSaldo = $_POST['nuevoSaldo'];
   $nomCli = $_POST['nomCli'];

    $insumo = new INSUMOS_MYSQL($con);
   $venta = new VEN_GRAL_MYSQL($con);
   $detalle=new DETTARJETA_MYSQL($con);
   $relProIns = new RELPROINS_MYSQL($con);
   ini_set('date.timezone', 'America/La_Paz');
        $now = date('G:i');
          $con->transacion();
   for ($i=0; $i < count($idProducto); $i++) { 
        $producto = new PRODUCTOS_MYSQL($con);
         $todoProd = $producto->buscarXID($idProducto[$i]);
        $detalle->contructor($tarjeta,$_SESSION['ordenDia'],$i+1,$todoProd[0]->id,$cantidad[$i],'0',$todoProd[0]->pre_venta,$_SESSION['camoff'],$fechaVenta,$now,$todoProd[0]->nom_prod,'0','','0',$todoProd[0]->presa,$todoProd[0]->grupo,'',$turno,'',$todoProd[0]->unid,'','0','0','0','AGRUPA1','AGRUPA2','AGRUPA3','0',$_SESSION['usuario'],'',0);
        $verificarInsumos = $relProIns->buscarXID($idProducto[$i]);

                if (count($verificarInsumos) > 0 && $verificarInsumos!="") {

                    foreach ($verificarInsumos as $key => $value) {

                        $mostrarInsumo = $insumo->buscarXID($value->COD_INS);
                        
                        $resta = floatval($mostrarInsumo[0]->STOCK_ACT - ($cantidad[$i] * $value->CANTIDAD));
                        $alterarStock = $insumo->alterarStock($value->COD_INS, $resta);

                        if (!$alterarStock) {
                            $error = "ERROR AL MODIFICAR INSUMO";
                        } else {
                            $kardex->contructor('0', $insertarVenta, $value->COD_INS, $mostrarInsumo[0]->NOM_INSUMO, $cantidad[$i], $fechaVenta, $nomCli, 0, $cantidad[$i], 0, "VENTA", 0, 0, 0);
                            $insertarkardex = $kardex->insertar();
                            if ($insertarkardex == 0) {
                                $error = "ERROR AL INSERTAR KARDEX";
                            }
                        }
                    }
                }
                $insertarDetalle = $detalle->insertar();
                
                $modificarVenta=$venta->modificarVentaTarjeta($tarjeta,$nuevoSaldo);
                if ($insertarDetalle == 0  || !$modificarVenta) {
                    $con->rollback();
                    $error = "ERROR AL GUARDAR DETALLE";
                    break;
                }else {
            $con->commit();
           
        }

    } 
}

$reponse = array("error" => $error, "result" => $resultado, "result2" => $resultado2);
echo  json_encode($reponse);
?>