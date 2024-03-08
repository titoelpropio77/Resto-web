<?php 

include_once "../class/Conexion.php";
include_once "../class/PRODUCTOS_MESAS_MYSQL.class.php";
include_once "../class/PRODUCTOS_MYSQL.class.php";
include_once "../class/MESAS_MYSQL.class.php";
include_once "../class/EMPLEADOS_MYSQL.class.php";

$proceso=$_POST['proceso'];
$con= new Conexion();
$conexion= $con->ConexionDB();
$error = "";
$resultado = "";
$impCoc=array();
$impPunto1=array();
$impPunto2=array();
$impPunto3=array();
$impPunto4=array();
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
	case 'guardar':
		$idProducto=$_POST['idProducto'];
		$idMesa=$_POST['idMesa'];
		$nroMesa=$_POST['nroMesa'];
		$fechaVenta=$_POST['fechaVenta'];
		$turno=$_POST['turno'];
		$idMesero=$_POST['idMesero'];
		$cantidad=$_POST['cantidad'];
		$meserosc=$_POST['meserosc'];
		$nota=$_POST['nota'];
		$persona=$_POST['cantCli'];//este dato obtiene el dato de el promp persona
		$salon=$_POST['salon'];
		$NombrePro=$_POST['NombrePro'];
		$precio=$_POST['precio'];
		$subtotal=$_POST['subtotal'];
		$billar=$_POST['billar'];
		$porcRest=$_POST['porcRest'];

		ini_set('date.timezone', 'America/La_Paz');
        $now = date('G:i');
        $con->transacion();
        $mesa = new MESAS_MYSQL($con);
        $mesero = new EMPLEADOS_MYSQL($con);
		$todoMesa=$mesa->buscarXID($idMesa);
		if ($meserosc=="meserosc") {
			$listaMesero=$mesero->buscarXID($idMesero);	
			
		}else{
			$listaMesero=$mesero->verificarMesero($idMesero);	
		}
		
		$colorMesero=$listaMesero[0]->COLOREMP;
		
		if ($todoMesa[0]->USO=="") {
		 for ($i = 0; $i < count($idProducto); $i++) {
		 	if ($billar=="billar" && $idProducto[$i]=="99999") {
		 		 $idProd="99999";
		 	 $pre_venta="0";
		 	 $nom_prod="ATENCION";
		 	 $grupo="0";
		 	 $familia="0";
		 	 $unid="0";
		 	 $cod_grupo="0";
		 	 $presa="";
		 	 $tiempo="";
		 	}else{
		 	 $producto = new PRODUCTOS_MYSQL($con);
		 	  $productoTodo = $producto->buscarXID($idProducto[$i]);
		 	 $idProd=$idProducto[$i];
		 	 $pre_venta=$productoTodo[0]->pre_venta;
		 	 $nom_prod=$productoTodo[0]->nom_prod;
		 	 $grupo=$productoTodo[0]->grupo;
		 	 $familia=$productoTodo[0]->familia;
		 	 $unid=$productoTodo[0]->unid;
		 	 $cod_grupo=$productoTodo[0]->cod_grupo;
		 	 $presa=$productoTodo[0]->presa;
		 	  $tiempo=$productoTodo[0]->tiempo!=""?$productoTodo[0]->tiempo:"";
		 }
		 	 $nroOrdenMesa=floatval($todoMesa[0]->NROORDEN)+1;
            
             $productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
            
             
             $productoMesa->contructor(0,$nroOrdenMesa,$i+1,$idProd,$cantidad[$i],"0",$pre_venta,$_SESSION['camoff'],$fechaVenta,$now,$nom_prod,"","","",$presa,$grupo,"",$turno,$familia,$unid,"MESA: ".$nroMesa,"0","0","0",$subtotal[$i],"AGRUPA2","AGRUPA3",$cod_grupo,$_SESSION['usuario'],$idMesa,$nota[$i],"",$listaMesero[0]->NOM_EMPL ,"",$tiempo,$now,"",0);
             $insertar=$productoMesa->insertar();
             
             if ($insertar==0) {
             	$error="<span style='font-weight: bold;'>* ERROR AL GUARDAR PRODUCTO.</span><br>";
             	break;
             }
	

		 }
		}
	      else{
		 	 	$error="<span style='font-weight: bold;'>* LA MESA YA ESTA OCUPADA.</span><br>";
             	break;
		 	 	
		 	 }
             
        $modificarMesa=$mesa->modificarUso($idMesa,$nroOrdenMesa,$colorMesero,$persona,$salon);
        if (!$modificarMesa) {
        	$error="<span style='font-weight: bold;'>* ERROR AL MODIFICAR MESA.</span><br>";
        }
        

       
	  $resultado=$nroOrdenMesa;

        if ($error!="") {
             	$con->rollback();
             	
             }else{
             	$con->commit();
             	
             }
		
		break;
	case 'listarDetalleMesa':

			$idMesa=$_POST['idMesa'];
			$nroMesa=$_POST['nroMesa'];
			$fecha=$_POST['fechaVenta'];
			
             $productoMesa= new PRODUCTOS_MESAS_MYSQL($con);

			 $resultado=$productoMesa->listarDetalleMesa($idMesa,$nroMesa,$fecha);
		break;
	case 'habilitarActualizarMesa':
			$opcionItemMesa=$_POST['opcionItemMesa'];
			switch ($opcionItemMesa) {
				case '1'://actualiza las producto mesa
				$productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
       		 $mesa = new MESAS_MYSQL($con);
			$idMesa=$_POST['idMesa'];
			$idProducto=$_POST['idProducto'];
			$cantidad=$_POST['cantidad'];
			$idDetalleMesa=$_POST['idDetalle'];
			$modificarMesa=$mesa->hablilitarMesaProcesando($idMesa);
			if (!$modificarMesa) {
				$error="ERROR al modificar mesa procesando";
			}
			for ($i=0; $i < count($idProducto); $i++) { 
				$obtenerDetalle=$productoMesa->buscarXID($idDetalleMesa[$i]);
				$cantidadActual=floatval($obtenerDetalle[0]->CANTIDAD-$cantidad[$i]);
				$modifcarProductoMesa=$productoMesa->modifcarProductoMesa($idDetalleMesa[$i],$cantidadActual);
				if (!$modifcarProductoMesa) {
				$error="ERROR al modifcar producto mesa";
			}
			}
			
					break;
				case '2'://cierra todos los productos mesa y habilita la mesa 
				$productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
       		 $mesa = new MESAS_MYSQL($con);
       		
			$idMesa=$_POST['idMesa'];
			$idProducto=$_POST['idProducto'];
			$cantidad=$_POST['cantidad'];
			$idDetalleMesa=$_POST['idDetalle'];
		   
			$modificarMesa=$mesa->habilitarMesa($idMesa);
			if (!$modificarMesa) {
				$error="ERROR al modificar mesa";
			}
			for ($i=0; $i < count($idProducto); $i++) { 
				
				
				$modifcarProductoMesa=$productoMesa->modifcarProductoMesaCerrado($idDetalleMesa[$i]);
				if (!$modifcarProductoMesa) {
				$error="ERROR al modifcar producto mesa";
			}
			}
					break;
				default:
					# code...
					break;
			}

			
		break;
		case 'traspasarItemMesa':
			ini_set('date.timezone', 'America/La_Paz');
       			 $now = date('G:i');
			$idDetalle=$_POST['idDet'];
			$cantidad=$_POST['cantidad'];
			$idMesaTraspaso=$_POST['idMesaTraspaso'];//id de la mesa a traspasar
			$idMesaDisminuir=$_POST['idMesaDisminuir'];//iod de la mesa a disminuir
			$fecha=$_POST['fecha'];
			$nroMesaTraspaso=$_POST['nroMesaTraspaso'];
			$habilitarMesa=$_POST['habilitarMesa'];//0 no habilita la mesa, 1 habilita la mesa que disminuye
			$estadoMesa=$_POST['estadoMesa'];
			$salon=$_POST['salon'];

			$con->transacion();
       		 $mesa = new MESAS_MYSQL($con);

			$contador1=0;
			$inser=0;
			$listarMesa=$mesa->buscarXID($idMesaDisminuir);
			if ($estadoMesa=="abierta") {
				$persona=$salon=="nosalon"?$listarMesa[0]->NROPERSONA:$listarMesa[0]->NOM_CLI;
			$modificarMesa=$mesa->modificarUso($idMesaTraspaso,"1",$listarMesa[0]->COLORES,$persona,$salon);
			}
			$productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
			$listarDetalleMesa=$productoMesa->listarDetalleMesa($idMesaTraspaso,"0",$fecha);
			
			for ($i=0; $i <count($idDetalle) ; $i++) { //recorro el detalle del la mesa a disminuir
				
				$contador=0;
				$listarDetalleMesaDismin=$productoMesa->buscarXID($idDetalle[$i]);//obtengo los datos del id del detalle
				$listarDetalleMesaAumt=$productoMesa->listarDetalleMesa($idMesaTraspaso,"",$fecha);//obtengo todo el detalle de la mesa a traspasar
				$cantidad[$i]=$listarDetalleMesaDismin[0]->TIEMPO=="T"?1:$cantidad[$i];
				$cantidadDisminuir=floatval($listarDetalleMesaDismin[0]->CANTIDAD-$cantidad[$i]);//resta la cantidad del detalle a la cantidad entrante
				if ($cantidadDisminuir<0) {
					$error="NO EXISTE ESA CANTIDAD EN EN ESA MESA";
				}
				if ($cantidadDisminuir==0) {//si el resultado de cantidad diminuir es =0 entra y deltea la cantidad
					$modificarDismin=$productoMesa->modificarDeleteadoCantidad($idDetalle[$i]);//
					$contador1++;
				}else{
					$modificarDismin=$productoMesa->modifcarProductoMesa($idDetalle[$i],$cantidadDisminuir);
				}
				if (!$modificarDismin) {
						$error="ERROR al modifcar deletado";
						break;
					}
				if ($estadoMesa!="abierta") {
			   for ($j=0; $j < count($listarDetalleMesaAumt); $j++) { 
			
			   	if($listarDetalleMesaDismin[0]->COD_PROD==$listarDetalleMesaAumt[$j]->COD_PROD && $listarDetalleMesaDismin[0]->NOTA==$listarDetalleMesaAumt[$j]->NOTA){

			   		$cantidadAumentar=floatval($listarDetalleMesaAumt[$j]->CANTIDAD+$cantidad[$i]);
					$modificarDismin=$productoMesa->modifcarProductoMesa($listarDetalleMesaAumt[$j]->ID,$cantidadAumentar);
					if (!$modificarDismin) {
						$error="ERROR al modifcar deletado";
						return;
					}
					break;
			   	}
			   	$contador++;
			   }
			   if ($contador==count($listarDetalleMesaAumt)) {
			   	   
			   
			   	$orden=$listarDetalleMesaDismin[0]->ORDEN;
			   	$item=$listarDetalleMesaDismin[0]->ITEM;
			   	$codPro=$listarDetalleMesaDismin[0]->COD_PROD;
			   	$precioVen=$listarDetalleMesaDismin[0]->PRE_VENTA;
			   	$nomProd=$listarDetalleMesaDismin[0]->NOM_PROD;
			   	$presa=$listarDetalleMesaDismin[0]->PRESA;
			   	$grupo=$listarDetalleMesaDismin[0]->GRUPO;
			   	$turno=$listarDetalleMesaDismin[0]->TURNO;
			   	$presa=$listarDetalleMesaDismin[0]->PRESA;
			   	$unid=$listarDetalleMesaDismin[0]->UNID;
			   	$nota=$listarDetalleMesaDismin[0]->NOTA;
			   	$tiempo=$listarDetalleMesaDismin[0]->TIEMPO;
			   	$tiempoIni=$listarDetalleMesaDismin[0]->TIEMPO_INI;
			   	$tiempoFin=$listarDetalleMesaDismin[0]->TIEMPO_FIN;
			   	 $productoMesa->contructor(0,$orden,$listarDetalleMesaDismin[0]->ITEM,$codPro,$cantidad[$i],"0",$precioVen,$_SESSION['camoff'],$fecha,$now,$nomProd,"","","",$presa,$grupo,"",$turno,"",$unid,$nroMesaTraspaso,"0","0","0","AGRUPA1","AGRUPA2","AGRUPA3",$grupo,$_SESSION['usuario'],$idMesaTraspaso,$nota,"",$_SESSION['nombres'] ,"",$tiempo,$tiempoIni,
			   	 	$tiempoFin,0);
			   	 $insertarProMesa=$productoMesa->insertar();
			   	 if ($insertarProMesa=="") {
			   	 	$error="ERROR AL INSERTAR MESA";
			   	 }
			   }
			   }else{
				$orden=$listarDetalleMesaDismin[0]->ORDEN;
			   	$item=$listarDetalleMesaDismin[0]->ITEM;
			   	$codPro=$listarDetalleMesaDismin[0]->COD_PROD;
			   	$precioVen=$listarDetalleMesaDismin[0]->PRE_VENTA;
			   	$nomProd=$listarDetalleMesaDismin[0]->NOM_PROD;
			   	$presa=$listarDetalleMesaDismin[0]->PRESA;
			   	$grupo=$listarDetalleMesaDismin[0]->GRUPO;
			   	$turno=$listarDetalleMesaDismin[0]->TURNO;
			   	$presa=$listarDetalleMesaDismin[0]->PRESA;
			   	$unid=$listarDetalleMesaDismin[0]->UNID;
			   	$nota=$listarDetalleMesaDismin[0]->NOTA;
			   	$tiempo=$listarDetalleMesaDismin[0]->TIEMPO;
			   	$tiempoIni=$listarDetalleMesaDismin[0]->TIEMPO_INI;
			   	$tiempoFin=$listarDetalleMesaDismin[0]->TIEMPO_FIN;
			   	 $productoMesa->contructor(0,$orden,$listarDetalleMesaDismin[0]->ITEM,$codPro,$cantidad[$i],"0",$precioVen,$_SESSION['camoff'],$fecha,$now,$nomProd,"","","",$presa,$grupo,"",$turno,"",$unid,$nroMesaTraspaso,"0","0","0","AGRUPA1","AGRUPA2","AGRUPA3",$grupo,$_SESSION['usuario'],$idMesaTraspaso,$nota,"",$_SESSION['nombres'] ,"",$tiempo,$tiempoIni,
			   	 	$tiempoFin,0);
			   	 $insertarProMesa=$productoMesa->insertar();
			   	 if ($insertarProMesa=="") {
			   	 	$error="ERROR AL INSERTAR MESA";
			   	 }
			   }
			   
			}
			
		if($habilitarMesa=="1"){
			$modificarMesa=$mesa->habilitarMesa($idMesaDisminuir);

		}
		if ($error!="") {
			$con->rollback();
		}else{
			$con->commit();

		}
			break;

		case 'aumentarProductoMesa':
			$con->transacion();
			ini_set('date.timezone', 'America/La_Paz');
	        $now = date('G:i');
			$fechaVenta=$_POST['fechaVenta'];
			$idProducto=$_POST['idProducto'];
			$idMesa=$_POST['idMesa'];
			$nroMesa=$_POST['nroMesa'];
			$cantidad=$_POST['cantidad'];
			$notaProducto=$_POST['notaProducto'];
			$tipoProducto=$_POST['tipoProducto'];
			$productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
        	$mesa = new MESAS_MYSQL($con);
			$listarDetalleMesa=$productoMesa->listarDetalleMesa($idMesa,"0",$fechaVenta);
			// if ($listarDetalleMesa=="") {
			// 	$error="* NO ES DE LA FECHA ACTUAL";
   //           	break;
			// }
			
			 if($tipoProducto=="T" && $productoMesa->verificarPrdT($idMesa,$fechaVenta)!=""){
             	$error="* DEBE PARA TIEMPO MESA";
             	break;
             }
             $listarMesa=$mesa->buscarXID($idMesa);
			 for ($i = 0; $i < count($idProducto); $i++) {
		 	 $producto = new PRODUCTOS_MYSQL($con);
             $productoTodo = $producto->buscarXID($idProducto[$i]);
		 
		 	 $nroOrdenMesa=floatval($listarMesa[0]->NROORDEN)+1;
             $productoTodo = $producto->buscarXID($idProducto[$i]);
            $tiempo=$productoTodo[0]->tiempo!=""?$productoTodo[0]->tiempo:"";
             $productoMesa->contructor(0,$nroOrdenMesa,$i+1,$idProducto[$i],
             	$cantidad[$i],"0",$productoTodo[0]->pre_venta,$_SESSION['camoff'],$fechaVenta,$now,$productoTodo[0]->nom_prod,"","","",
             	$productoTodo[0]->presa,$productoTodo[0]->grupo,"",$listarDetalleMesa[0]->TURNO,$productoTodo[0]->familia,$productoTodo[0]->unid,$nroMesa,"0","0","0","AGRUPA1","AGRUPA2","AGRUPA3",$productoTodo[0]->cod_grupo,$_SESSION['usuario'],$idMesa,$notaProducto[$i],"",$_SESSION['nombres'] ,"",$tiempo,$now,"",0);
             $insertar=$productoMesa->insertar();
             
                }
               
		 
		 $modificarMesa=$mesa->aumentarNroOrden(intval($listarMesa[0]->NROORDEN)+1,$idMesa);
		  $resultado=$nroOrdenMesa;
		 if (!$modificarMesa) {
		 	$error="<span style='font-weight: bold;'>* ERROR AL GUARDAR PRODUCTO.</span><br>";
             	break;
		 }
		 if ($error!="") {
		 	$con->rollback();
		 }else{
		 	$con->commit();
		 }
			break;
	case 'anularMesa':
	$con->transacion();
	$fechaVenta=$_POST['fechaVenta'];
	$idMesa=$_POST['idMesa'];
	$mesa = new MESAS_MYSQL($con);
	$productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
	$listarDetalleMesa=$productoMesa->listarDetalleMesa($idMesa,"0",$fechaVenta);
	for ($i=0; $i < count($listarDetalleMesa); $i++) { 
				$modifcarProductoMesa=$productoMesa->modifcarProductoMesaCerrado($listarDetalleMesa[$i]->ID);
				if (!$modifcarProductoMesa) {
				$error="ERROR al modifcar producto mesa";
				break;
			}
		}
			$modificarMesa=$mesa->habilitarMesa($idMesa);
			if (!$modificarMesa) {
				$error="ERROR al modificar mesa";
			}
		if ($error!="") {
			$con->rollback();
		}else{
			$con->commit();

		}
		break;
	case 'eliminarItem':
	$con->transacion();
	$idDetalle=$_POST['idDetalle'];
	$idMesa=$_POST['idMesa'];
	$totalDetalle=$_POST['totalDetalle'];
	$mesa = new MESAS_MYSQL($con);
	$productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
	$modifcarProductoMesa=$productoMesa->modificarItemElim($idDetalle);
	if (!$modifcarProductoMesa) {
				$error="ERROR al modifcar producto mesa";
				break;
	}
	if ($totalDetalle=="abrirmesa") {
		$modificarMesa=$mesa->habilitarMesa($idMesa);
			if (!$modificarMesa) {
				$error="ERROR al modificar mesa";
			}
	}
	if ($error!="") {
			$con->rollback();
		}else{
			$con->commit();

		}
		break;
	case 'listarProductosMesas2Fechas':
		$fechaInicio=$_POST['fechaInicial'];
		$fechaFinal=$_POST['fechaFinal'];
		$idMesa=$_POST['idMesa'];
			$productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
			$resultado=$productoMesa->listarProductosMesas2Fechas($fechaInicio,$fechaFinal,$idMesa);
		break;
	case 'listarProductosMeseros2Fechas':
		$fechaInicio=$_POST['fechaInicial'];
		$fechaFinal=$_POST['fechaFinal'];
		$nomMesero=$_POST['nomMesero'];
			$productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
			$resultado=$productoMesa->listarProductosMeseros2Fechas($fechaInicio,$fechaFinal,$nomMesero);
		break;
	case 'listarItemAnulado2Fechas':
		$fechaInicio=$_POST['fechaInicial'];
		$fechaFinal=$_POST['fechaFinal'];
		$productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
		$resultado=$productoMesa->listarItemAnulado2Fechas($fechaInicio,$fechaFinal);
		break;
	case 'listarMesasAnuladas2Fechas':
		$fechaInicio=$_POST['fechaInicial'];
		$fechaFinal=$_POST['fechaFinal'];
		$productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
		$resultado=$productoMesa->listarMesasAnuladas2Fechas($fechaInicio,$fechaFinal);
		break;
	case 'listarItemElimDadaFecha':
		$fecha=$_POST['fecha'];
		
		$productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
		$resultado=$productoMesa->listarItemAnuladoFechas($fecha);
		
		break;
	case 'pararTiempoBillar':
	
	$con->transacion();
		$idDetalle=$_POST['idDetalle'];
		$horaA=$_POST['horaA'];
		$idMesa=$_POST['idMesa'];
		$productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
		$modificar=$productoMesa->pararTiempoBillar($idDetalle,$horaA);
		if (!$modificar) {
				$error="ERROR al modificar mesa";
			}
	if ($error!="") {
			$con->rollback();
		}else{
			$con->commit();

		}
		break;
	case 'verificarPrdT':
		$idMesa=$_POST['idMesa'];
		$fecha=$_POST['fecha'];
		$productoMesa= new PRODUCTOS_MESAS_MYSQL($con);
		$resultado=$productoMesa->verificarPrdT($idMesa,$fecha);
		break;
	default:
		# code...
		break;
}

$reponse = array("error" => $error, "result" => $resultado,'impCoc'=>$impCoc,'impPunto1'=>$impPunto1,'impPunto2'=>$impPunto2,'impPunto3'=>$impPunto3,'impPunto4'=>$impPunto4);
echo  json_encode($reponse);
 ?>