<?php

include_once "../class/Conexion.php";
include_once "../class/VEN_GRAL_MYSQL.class.php";
include_once "../class/DETALLES_MYSQL.class.php";
include_once "../class/PRODUCTOS_MYSQL.class.php";
include_once "../class/CLIENTES_MYSQL.class.php";
include_once "../class/CORRELATIVOS.class.php";
include_once "../class/RELPROINS_MYSQL.class.php";
include_once "../class/INSUMOS_MYSQL.class.php";
include_once "../class/KARDEXINS_MYSQL.class.php";
include_once "../class/EMPRESA_MYSQL.class.php";
require "../CodigoControl/GenerarQr.php";
require "../CodigoControl/sin/ControlCode.php";

$proceso = $_POST['proceso'];
$con = new Conexion();
$conexion = $con->ConexionDB();
$error = "";
$resultado = "";
$resultado2 = "";
$productoImp = "";
$impCoc = array();
$impPunto1 = array();
$impPunto2 = array();
$impPunto3 = array();
$impPunto4 = array();
$nroFacturaImpresa = "";
$facact="";
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
    case 'guardar'://GUARDA UNA VENTA

    $con->transacion();
    $impCoc = array();
    $impPunto1 = array();
    $impPunto2 = array();
    $impPunto3 = array();
    $impPunto4 = array();
    $productoImp = array();
    $venta = new VEN_GRAL_MYSQL($con);
    $detalle = new DETALLES_MYSQL($con);
    $relProIns = new RELPROINS_MYSQL($con);
    $insumo = new INSUMOS_MYSQL($con);
    $kardex = new KARDEXINS_MYSQL($con);
    $empresa = new EMPRESA_MYSQL($con);
    $restar = 0;
    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['cantidad'];
    $nombreCli = $_POST['nombreCli'];
    $nitCli = $_POST['nitCli']==""?0:$_POST['nitCli'];
    $cambioBs = $_POST['cambioBs'];
    $cambioUsd = $_POST['cambioUsd'];
    $direccionCli=$_POST['direccionCli'];
    $telefonoCli=$_POST['telefonoCli'];
    $precio=$_POST['precio'];
    $qr=$_POST['qr'];

        $pagoFacturaBs = $_POST['totalFacturaBs']; //valor del modal factura
        $pagoFacturaUs = $_POST['totalFacturaUs']; //valor del modal factura
        $totalBs = $_POST['totalBs'];
        $totalUsd = $_POST['totalUsd'];
        $formaPago = $_POST['formaPago'];
        $vendedor = $_POST['vendedor'];
        $turno = $_POST['turno'];
        $salida = $_POST['salidaProducto'];
        $nota = $_POST['nota'];
        $nombreProduc = $_POST['nombreProduc'];
        $subTotal = $_POST['subTotal'];
        $billar = $_POST['billar'];

        $selectPrepago = $_POST['selectPrepago']==""?"":"P".$_POST['selectPrepago'];
        $totalPrepago= $_POST['selectPrepago']=="0"?"":$totalBs;
        $fechaVenta = date("Y-m-d", strtotime($_POST['fechaVenta']));
        $resulEmpresa = $empresa->obtenerUltimo();
        // $fechaactual1 = getdate();
        // $hoy=" $fechaactual1[year]-$fechaactual1[mon]-$fechaactual1[mday]";


        $date1 = date_create($fechaVenta);
        $date2 = date_create($resulEmpresa[0]->FECHA_LIM);
        $diff = date_diff($date1, $date2);

        $dateFormat = date_format($date2, 'd/m/Y');
        $res = $diff->format('%R%a');
        if (intval($res) < 0) {
            $error = "SU DOFICIFICACION YA SE VENCIÓ, NO PODRÁ VENDER";

            break;
        }

        // $familia=str_replace(search, replace, subject)
        // substr_replace(string, replacement, start)
        $codCli=verificarCliente($con, $nombreCli, $nitCli,$telefonoCli,$direccionCli);
        if ($codCli>0 || !$codCli) {
            
        }else{
            $error = "error al guardar cliente";
            break;
        }


        ini_set('date.timezone', 'America/La_Paz');
        $now = date('G:i');
        $fechaActual = $resulEmpresa[0]->FECHA_LIM;

        $correlativo = new CORRELATIVOS($con);
        $nombreTabla = "ven_gral_mysql";
        $listacorre = $correlativo->mostrarUltimo($nombreTabla);
        $ultimofolio = $listacorre[0]->folio;
        $ultimofolior = $listacorre[0]->folior;
        $ultimorondedia = $listacorre[0]->ordendia + 1;
        $imprimir = $listacorre[0]->imprimir;
        $contador = 0;


        if ($imprimir == "") {

            if ($nitCli == "") {

                if ($listacorre[0]->mult != "" || intval($listacorre[0]->mult) > 0) {

                    $ultimofolior++;
                    $contador = intval($listacorre[0]->multcon) + 1;
                    $modificar = $correlativo->contadorMul($nombreTabla, $contador);
                    $modificar1 = $correlativo->modificarF($nombreTabla, $ultimofolior, $ultimorondedia);
                    if (!$modificar || !$modificar1) {
                        $error = "error al modificar f";
            break;

                    }
                    if ($contador == intval($listacorre[0]->mult)) {
                        $ultimofolio++;
                        $ultimofolior = $ultimofolio;
                        $modificar = $correlativo->modificarTodoMul($nombreTabla, $ultimofolio, 0);
                        if (!$modificar) {
                            $error = "error al modificar f";
                        }
                    }
                } else {

                    $ultimofolior++;
                    $modificar = $correlativo->modificarF($nombreTabla, $ultimofolior, $ultimorondedia);

                    if (!$modificar) {
                        $error = "error al modificar f";
                    }
                 

                }
            } else {
                if ($listacorre[0]->mult != "" || intval($listacorre[0]->mult) > 0) {

                    $ultimofolio++;
                    $modificar=$correlativo->modificarFr($nombreTabla,$ultimofolio,$ultimorondedia);
                    $ultimofolior = $ultimofolio;
                } else {
                    $ultimofolio++;
                    $modificar = $correlativo->modificarFr($nombreTabla, $ultimofolio, $ultimorondedia);
                    if (!$modificar) {
                        $error = "error al modificar fr";
                    }
                    $ultimofolior = $ultimofolio;
                }
            }
        } else {
            $ultimofolio++;
            $modificar = $correlativo->modificarFi($nombreTabla, $ultimofolio, $ultimorondedia);
            if (!$modificar) {
                $error = "error al modificar fi";
            }
            $ultimofolior = 0;
        }

        $nroFacturaImpresa = $ultimofolio ;
        $facact=$imprimir==""?$ultimofolior:$ultimofolio;
        $controlCode = new ControlCode();
       
         $codigoControl= $controlCode->generarCodControl($resulEmpresa[0]->NROAUTORI, $facact, $nitCli, str_replace('-', '', $fechaVenta), $totalBs, $resulEmpresa[0]->LLAVE);
        $empresa = $empresa->modificarFacAt($resulEmpresa[0]->ID, $nroFacturaImpresa,$facact);
        $venta->contructor('0', $ultimorondedia, $fechaVenta, $_SESSION['usuario'], $formaPago, 'ACTIVO', '', $salida, $turno, $codCli, '1', $now, $_SESSION['camoff'], $totalBs, 0, 0, 'P', '', '', '', $ultimofolio, $ultimofolior, '', $selectPrepago, $totalUsd, $cambioUsd, $pagoFacturaBs, $cambioBs, '', '0', $nitCli, '0', $nombreCli, $resulEmpresa[0]->LLAVE, $resulEmpresa[0]->NROAUTORI, $fechaActual, $codigoControl, $totalPrepago, '0', '0', 0);

        $insertarVenta = $venta->insertar();
        if (!$insertarVenta) {

            $error = "error al instertar venta";
        } else {
            $modificar = $venta->modificarFactura($insertarVenta);
            for ($i = 0; $i < count($idProducto); $i++) {
                $agrupar3="";
                $agrupar2="";
                if ($nombreProduc[$i]=="Consumo Adicional de Tarjeta" && $i==0) {
                 $grupoProd="0";
                 $presaProd="0";
                 $nom_prodProd="Consumo Adicional de Tarjeta";
                 $pre_ventaProd=$precio[$i];
                 $unidProd="0";
                 $barcodeProd="0";
                 $cod_grupoProd="0";
                 $subTotales=$subTotal[$i];
                }
                if($billar=="billar"  && $idProducto[$i]=="99999"){
                     $grupoProd="0";
                 $presaProd="0";
                 $nom_prodProd="Atencion";
                 $pre_ventaProd=$precio[$i];
                 $unidProd="0";
                 $agrupar2=$precio[$i];
                 $barcodeProd="0";
                 $cod_grupoProd="0";
                  $subTotales=$subTotal[$i];
                }else{

                 $producto = new PRODUCTOS_MYSQL($con);
                 $todo = $producto->buscarXID($idProducto[$i]);
                 $grupoProd=$todo[0]->grupo;
                 $presaProd=$todo[0]->presa;
                 $nom_prodProd=$todo[0]->nom_prod;
                 $pre_ventaProd=$todo[0]->pre_venta;
                 $unidProd=$todo[0]->unid;
                 $barcodeProd=$todo[0]->barcode;
                 $cod_grupoProd=$todo[0]->cod_grupo;
                 $subTotales=$subTotal[$i];
                 $agrupar3=$todo[0]->tiempo=="T"?$subTotal[$i]:"";
                }

                $detalle->contructor($insertarVenta, $ultimorondedia, $i + 1, $idProducto[$i], $cantidad[$i], 0, $pre_ventaProd, $_SESSION['camoff'], $fechaVenta, $now, $nom_prodProd, 'duni', '', '', $presaProd, $grupoProd, '', $turno, $formaPago, $unidProd, $salida, $ultimofolio, $ultimofolior, 0, $subTotales, $agrupar2,$qr[$i], $cod_grupoProd, $_SESSION['usuario'], '0', $nota[$i], $barcodeProd, '2', 's', 0);

                $verificarInsumos = $relProIns->buscarXID($idProducto[$i]);

                if (count($verificarInsumos) > 0 && $verificarInsumos!="") {

                    foreach ($verificarInsumos as $key => $value) {

                        $mostrarInsumo = $insumo->buscarXID($value->COD_INS);
                        
                        $resta = floatval($mostrarInsumo[0]->STOCK_ACT - ($cantidad[$i] * $value->CANTIDAD));
                        $alterarStock = $insumo->alterarStock($value->COD_INS, $resta);

                        if (!$alterarStock) {
                            $error = "ERROR AL MODIFICAR INSUMO";
                        } else {
                            $kardex->contructor('0', $insertarVenta, $value->COD_INS, $mostrarInsumo[0]->NOM_INSUMO, $cantidad[$i], $fechaVenta, $nombreCli, 0, $cantidad[$i], 0, "VENTA", 0, 0, 0);
                            $insertarkardex = $kardex->insertar();
                            if ($insertarkardex == 0) {
                                $error = "ERROR AL INSERTAR KARDEX";
                            }
                        }
                    }
                }
                $insertarDetalle = $detalle->insertar();

                if ($insertarDetalle == 0) {
                    $error = "ERROR AL GUARDAR DETALLE";
                    break;
                }
            }
        }
        if ($error != "") {
            $con->rollback();
        } else {
            $con->commit();
           
        }

        $resultado = $insertarVenta;

        $_SESSION['ordenDia'] = $ultimorondedia;

        $resultado2 = $ultimorondedia;

        break;
         default:

        break;
    }

    function verificarCliente($con, $nombre, $nit,$tel_cli,$direccionCli) {
        $cliente = new CLIENTES_MYSQL($con);
        $resu = $cliente->buscarNombreNit($nombre, $nit);
        if (count($resu) > 0) {
            if ($tel_cli!=""  && $direccionCli!="") {
                
                    $modificarC=$cliente->modificarClient($resu[0]->ID,$tel_cli,$direccionCli);
                    if (!$modificarC) {
                        $error="ERROR AL MODIFICAR";
                        return false;
                    }
                    


            }
            return $resu[0]->ID;
        } else {
            $cliente->contructor(0, '0', $nombre, $tel_cli, '', $nit, $direccionCli, '', '', 'foto', 0, 0);
            $insertar = $cliente->insertar();
            if ($insertar == 0) {
                $error = "error";
                return false;
            } else {
                return $insertar;
            }
        }
    }

    $con->closed();
    $reponse = array("error" => $error, "result" => $resultado, 'productoImp' => $productoImp, 'impCoc' => $impCoc, 'impPunto1' => $impPunto1, 'impPunto2' => $impPunto2, 'impPunto3' => $impPunto3, 'impPunto4' => $impPunto4, 'result2' => $resultado2, 'nroFac' => $facact);
    echo json_encode($reponse);
    ?>