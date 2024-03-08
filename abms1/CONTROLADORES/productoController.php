<?php 

include_once "../class/Conexion.php";

include_once "../class/producto.php";

include_once "../class/PRODUCTOS_MYSQL.class.php";
include_once "../class/DETALLES_MYSQL.class.php";

include_once "../class/RELPROINS_MYSQL.class.php";

include_once "../class/RELPROGRU_MYSQL.class.php";

$con = new Conexion();
$conexion=$con->ConexionDB();
$proceso=$_POST['proceso'];

$resultado = "";
$resultado2 = "";
$error = "";
$tabla="";
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
	 $impCocina="";
       $impPunto1="";
        $impPunto2="";
        $impPunto3="";
        $impPunto4="";
  $lun="";
  $mar="";
  $mier="";
  $jue="";
  $vie="";
  $sab="";
	$dom="";
   $nombreProd=trim($_POST["nombre"]);
  $estado=$_POST["estado"];
  $cantidad=$_POST["cantidad"];
  $unidad=$_POST["unidad"];
  $pre_venta=$_POST["pre_venta"];
  $selectGrupo=$_POST["grupo"];
  $disponible=$_POST["disponible"];
  $sujiere=$_POST["sujiere"];
  $colores=$_POST["colores"];
  $barcode=$_POST["barcode"];
  $familia=$_POST["familia"];

  $horaIni=$_POST["horaIni"]==""?"00:00":$_POST["horaIni"];
  $horaFin=$_POST["horaFin"]==""?"00:00":$_POST["horaFin"];
  if (isset($_POST['lunes'])) {
   $lun=$_POST['lunes'];
  }
  if (isset($_POST['martes'])) {
   $mar=$_POST['martes'];
  }
  if (isset($_POST['miercoles'])) {
   $mier=$_POST['miercoles'];
  }
  if (isset($_POST['jueves'])) {
   $jue=$_POST['jueves'];
  }
  if (isset($_POST['viernes'])) {
   $vie=$_POST['viernes'];
  }
  if (isset($_POST['sabado'])) {
   $sab=$_POST['sabado'];
  }
  if (isset($_POST['domingo'])) {
   $dom=$_POST['domingo'];
  }
  if (isset($_POST['cocina'])) {
   $impCocina=$_POST['cocina'];
  }
  if (isset($_POST['punto1'])) {
       $impPunto1=$_POST['punto1'];
  }
  if (isset($_POST['punto2'])) {
        $impPunto2=$_POST['punto2'];
  }
   if (isset($_POST['punto3'])) {
        $impPunto3=$_POST['punto3'];
  }
   if (isset($_POST['punto4'])) {
        $impPunto4=$_POST['punto4'];
  }

  //datos del arhivo  
  $uploadfile1="../../abms1/imagenes/imagenboton";
  $nombre_archivo = $_FILES["fotoGuardar"]["name"];  
 $tipo_archivo = $_FILES["fotoGuardar"]["type"];  
 $tamano_archivo = $_FILES["fotoGuardar"]["size"]; 
  $temporal = $_FILES["fotoGuardar"]["tmp_name"]; 
  $name = basename($_FILES["fotoGuardar"]["name"]);
  $rutaImagen="$uploadfile1/$name";
  $ruta="abms1/imagenes/imagenboton/".$name;

  if ($nombre_archivo!="") {
  	
  
if (move_uploaded_file($temporal, $rutaImagen)) {

} else {
$error="error al guardar imagen";
}
}else{
	$ruta="";
}
	$producto=new producto($con);
  $con->transacion();
  if (count($producto->verificarNombre($nombreProd,0))>0) {
    $error.="<span style='font-weight: bold;'>* YA EXISTE ESE NOMBRE DE PRODUCTO.</span><br>";
  }
	$producto->contructor(0, 0,$nombreProd,$cantidad,$pre_venta,$estado,$sujiere,$unidad,"0",$colores,"","","",$selectGrupo,$disponible,$barcode,$sujiere,$ruta,$impCocina,$impPunto1,$impPunto2,$impPunto3,$impPunto4,$lun,$mar,$mier,$jue,$vie,$sab,$dom,$horaIni,$horaFin,$familia);
	$insertar= $producto->insertar($ruta);

	$modificar=$producto->modificarCodigo($insertar);
	if ($insertar === 0 or !$modificar) {
			$error.="<span style='font-weight: bold;'>* error al insertar o modificar producto.</span><br>";
		}
		
    if ($error!="") {
      $con->rollback();      
    }else{
      $con->commit();
      $resultado="INSERTADO CORRECTAMENTE";
    }
}//fin proceso guardar

if ($proceso==="mostrarProductoMenu") {

	$producto= new PRODUCTOS_MYSQL($con);
$idMenu=$_POST['id'];
$resultado=$producto->mostrar($idMenu);	
}

if ($proceso==="cargarDatos") {
$producto= new producto($con);

 $idProducto=$_POST['id'];

$resultado=$producto->ListarDadaId($idProducto);
}

if ($proceso==="modificarPoducto") {

$idProducto=$_POST['idProducto'];
	 $con->transacion();
	$producto= new producto($con);
  $lun="";
  $mar="";
  $mier="";
  $jue="";
  $vie="";
  $sab="";
  $dom="";

 $impCocina="";
       $impPunto1="";
        $impPunto2="";
        $impPunto3="";
        $impPunto4="";
         $horaIni=$_POST["horaIni"]==""?"00:00":$_POST["horaIni"];
  $horaFin=$_POST["horaFin"]==""?"00:00":$_POST["horaFin"];
  if (isset($_POST['lunes'])) {
   $lun=$_POST['lunes'];
  }
  if (isset($_POST['martes'])) {
   $mar=$_POST['martes'];
  }
  if (isset($_POST['miercoles'])) {
   $mier=$_POST['miercoles'];
  }
  if (isset($_POST['jueves'])) {
   $jue=$_POST['jueves'];
  }
  if (isset($_POST['viernes'])) {
   $vie=$_POST['viernes'];
  }
  if (isset($_POST['sabado'])) {
   $sab=$_POST['sabado'];
  }
  if (isset($_POST['domingo'])) {
   $dom=$_POST['domingo'];
  }
  if (isset($_POST['cocina'])) {
   $impCocina=$_POST['cocina'];
  }
  if (isset($_POST['punto1'])) {
       $impPunto1=$_POST['punto1'];
  }
  if (isset($_POST['punto2'])) {
        $impPunto2=$_POST['punto2'];
  }
   if (isset($_POST['punto3'])) {
        $impPunto3=$_POST['punto3'];
  }
   if (isset($_POST['punto4'])) {
        $impPunto4=$_POST['punto4'];
  }
          if (isset($_POST['cocina'])) {
   $impCocina=$_POST['cocina'];
  }
  if (isset($_POST['punto1'])) {
       $impPunto1=$_POST['punto1'];
  }
  if (isset($_POST['punto2'])) {
        $impPunto2=$_POST['punto2'];
  }
   if (isset($_POST['punto3'])) {
        $impPunto3=$_POST['punto3'];
  }
   if (isset($_POST['punto4'])) {
        $impPunto4=$_POST['punto4'];
  }
	$estado=$_POST['estado'];
$nombreProducto=trim($_POST["nombre"]);
$cantidad=$_POST['cantidad'];
$unid=$_POST['unidad'];
$grupo=$_POST['grupo'];
$disponible=$_POST['disponible'];
$sugiere=$_POST['sugiere'];
$colorProducto=$_POST['colores'];
$barcode=$_POST['barcode'];
$precioVenta=$_POST['precioVenta'];
$familia=$_POST['familia'];
$uploadfile1="../../abms1/imagenes/imagenboton";
 $nombre_archivo = $_FILES["foto"]["name"];  
 $tipo_archivo = $_FILES["foto"]["type"];  
 $tamano_archivo = $_FILES["foto"]["size"]; 
  $temporal = $_FILES["foto"]["tmp_name"]; 
  $name = basename($_FILES["foto"]["name"]);
  $rutaImagen="$uploadfile1/$name";
  $ruta="abms1/imagenes/imagenboton/".$name;
  if ( $nombre_archivo!="") {
if (move_uploaded_file($temporal, $rutaImagen)) {

} else {
$error="<span style='font-weight: bold;'>* error al guardar imagen.</span><br>";
}
  }else{
  	$ruta="";
  }
   
 if (count($producto->verificarNombre($nombreProducto,$idProducto))>0) {
    $error.="<span style='font-weight: bold;'>* YA EXISTE ESE NOMBRE DE PRODUCTO.</span><br>";
  }

$producto->contructor($idProducto,$idProducto,$nombreProducto,$cantidad,$precioVenta,$estado,$sugiere,$unid,"43",$colorProducto,"",""," ",$grupo,$disponible,
$barcode,$sugiere,$ruta,$impCocina,$impPunto1,$impPunto2,$impPunto3,$impPunto4,$lun,$mar,$mier,$jue,$vie,$sab,$dom,$horaIni,$horaFin,$familia);
$modificardo=$producto->modificar($idProducto,$ruta);
if (!$modificardo) {
 $error = "<span style='font-weight: bold;'>* No se pudo modificar al producto  Intente nuevamente.</span><br>";
}

if ($error!="") {
   
   $con->rollback();
}
else{
  $resultado="MODIFICADO CORRECTAMENTE";
  $con->commit();
}
	}
if ($proceso==="listar") {
	
	$producto= new producto($con);


	$resultado= $producto->listarProductosActivos();
	for ($i=0; $i <count($resultado) ; $i++) { 
		$tabla.="<tr style=''><td>".$resultado[$i]->id.
		"<td style='white-space: pre; border:solid ".$resultado[$i]->colores." 1px;    padding-right: 0;'>".$resultado[$i]->nom_prod.
		"<td style='  text-align: right;'>".$resultado[$i]->cantidad.
		"<td style='  text-align: right;'>".$resultado[$i]->unid.    
		"<td style='  text-align: right;'>".$resultado[$i]->pre_venta.
		"<td>".$resultado[$i]->nom_grupo.
		"<td>".$resultado[$i]->estado.
		"<td style='    padding-left: 2px;'><button onclick='cargarDatosProducto(".$resultado[$i]->id.")' class='btn btn-info' title='EDITAR PRODUCTO' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>
        <button id='".$resultado[$i]->id."' onclick='cargarIdEliminar(this)' nombre='".$resultado[$i]->nom_prod."'  class='btn btn-danger' title='ELIMINAR PRODUCTO' data-toggle='modal' data-target='#ModalEliminarProducto'><i class='fa fa-trash-o' aria-hidden='true'></i></button>";
		 $proins=new RELPROINS_MYSQL($con);
		 $resultado2=$proins->buscarXID($resultado[$i]->id);
		if ($resultado2) {
			$tabla.='<td style="    text-align: center;"><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo'.$i.'"><i class="fa fa-plus"></i></button>
  <div id="demo'.$i.'" class="collapse">
  <button  class="btn btn-success btn-xs" nombreProducto="'.$resultado[$i]->nom_prod.'" data-toggle="modal" data-target="#ModalaAgregarInsumo" onclick="listarInsumoProducto('.$resultado[$i]->id.',this)" >AGREGAR INSUMO</button>
  <table class="table-striped table-bordered  ">
                <thead><tr><th><center>INSUMO</center></th><th><center>CANTIDAD</center></th><th><center>OPERACION</center></th>
                 </tr></thead><tbody>';
			for ($j=0; $j <count($resultado2) ; $j++) { 
				$tabla.='<tr> <td>'.$resultado2[$j]->NOM_INSUMO.
				         '<td>'.$resultado2[$j]->CANTIDAD.
				         '<td><button onclick="CargarDatosModal(this)" idrelproins="'.$resultado2[$j]->ID.'" class="btn btn-warning btn-xs" data-toggle="modal" cantidad="'.$resultado2[$j]->CANTIDAD.'" data-target="#ModalModificarCantidadInsumo" nombre="'.$resultado2[$j]->NOM_INSUMO.'">EDITAR</button><button idrelproinsE="'.$resultado2[$j]->ID.'" onclick="CargarIdEliminarInsumo(this)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#ModalEliminarInsumoProducto" nombreE="'.$resultado2[$j]->NOM_INSUMO.'">Eliminar</button>' ;
			}
$tabla.="</tbody>
             </table>";
		}
		else{
			$tabla.='<td style="text-align: center;"><button class="btn btn-success btn-sm" nombreProducto="'.$resultado[$i]->nom_prod.'"  data-toggle="modal" data-target="#ModalaAgregarInsumo" onclick="listarInsumoProducto('.$resultado[$i]->id.',this)" >Agregar Insumo</button>';		}
			$progru=new RELPROGRU_MYSQL($con);
 $resultado2=$progru->buscarXID($resultado[$i]->id);
		if ($resultado2) {
			$tabla.='<td style="text-align: center;"><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demoa'.$i.'"><i class="fa fa-plus"></i></button>
  <div id="demoa'.$i.'" class="collapse">
  <button data-toggle="modal" data-target="#ModalaAgregarGrupoProducto" class="btn btn-success btn-xs" onclick="listarProductoGrupo(this)" id="'.$resultado[$i]->id.'" nombre="'.$resultado[$i]->nom_prod.'"  cantidad="'.$resultado[$i]->cantidad.'" unidad="'.$resultado[$i]->unid.'"  >Agregar a Grupo</button>
  <table class="table-striped table-bordered  ">
                <thead><tr><th><center>GRUPO</center></th><th><center>FACTOR</center></th><th><center>OPERACION</center></th>
                 </tr></thead><tbody>';
			for ($j=0; $j <count($resultado2) ; $j++) { 
				$tabla.='<tr> <td>'.$resultado2[$j]->NOM_GRUPO.'
								    <td>'.$resultado2[$j]->FACTOR.
				         '<td><button onclick="cargarModalFactor(this)" idrelprogru="'.$resultado2[$j]->ID.'" class="btn btn-warning btn-xs" data-toggle="modal" factor="'.$resultado2[$j]->FACTOR.'" nombregrupo="'.$resultado2[$j]->NOM_GRUPO.'" data-target="#ModalModificarFactor">EDITAR</button><button id="'.$resultado2[$j]->ID.'"  onclick="cargarModalEliminarRelProGrupo(this)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#ModalEliminarGrupo" nombregrupo="'.$resultado2[$j]->NOM_GRUPO.'" >Eliminar</button>' ;
			}
$tabla.="</tbody>
             </table>";
		}
		else{
			$tabla.='<td style="text-align: center;"><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalaAgregarGrupoProducto" onclick="listarProductoGrupo(this)" id="'.$resultado[$i]->id.'" nombre="'.$resultado[$i]->nom_prod.'" cantidad="'.$resultado[$i]->cantidad.'" unidad="'.$resultado[$i]->unid.'" name="btnInsumoProducto">Agregar a Grupo</button>';		}
	

	}

$resultado=$tabla;
	}
  if($proceso=="mostrarTodo"){
  $producto= new PRODUCTOS_MYSQL($con);
  $resultado=$producto->todo();
  }
  if ($proceso=="modificarProductoTodo") {
     $id=$_POST['idProducto'];
    $nom_prod=$_POST['nombre'];
    $cantidad=$_POST['cantidad'];
    $pre_venta=$_POST['pre_venta'];
    $unid=$_POST['unid'];
    $grupo=$_POST['grupo'];
    $estado=$_POST['estado'];
    $presa=$_POST['presa'];
    $unidad=$_POST['unidad'];
    $colores=$_POST['colores'];
    $barcode=$_POST['barcode'];
    $indice=$_POST['indice'];

    $codeqr=$_POST['codqr'];
    $f_vence=$_POST['f_vence'];
    $tiempo=$_POST['tiempo'];
    $tiempo_ini=$_POST['tiempo_ini'];
    $tiempo_fin=$_POST['tiempo_fin'];
    $impcoc=$_POST['impcoc'];
    $imppunt1=$_POST['imppunt1'];
    $imppunt2=$_POST['imppunt2'];
    $imppunt3=$_POST['imppunt3'];
    $imppunt4=$_POST['imppunt4'];
    $imgnormal=$_POST['imgnormal'];
    $lun=$_POST['lun'];
    $mar=$_POST['mar'];
    $mier=$_POST['mier'];
    $jue=$_POST['jue'];
    $vie=$_POST['vie'];
    $sab=$_POST['sab'];
    $dom=$_POST['dom'];
    $hora_inicio=$_POST['hora_inicio'];
    $hora_fin=$_POST['hora_fin'];
    $con->transacion();
    $detalle=new DETALLES_MYSQL($con);
  for ($i=0; $i <count($id) ; $i++) { 
  $producto= new PRODUCTOS_MYSQL($con);

  $modificar=$producto->modificarTodo($id[$i],$nom_prod[$i],$cantidad[$i],$pre_venta[$i],$unid[$i],$grupo[$i],$estado[$i],$presa[$i],$unidad[$i],$colores[$i],$barcode[$i],$indice[$i],$codeqr[$i],$f_vence[$i],$tiempo[$i],$tiempo_ini[$i],$tiempo_fin[$i],$impcoc[$i],$imppunt1[$i],$imppunt2[$i],$imppunt3[$i],$imppunt4[$i],$imgnormal[$i],$lun[$i],$mar[$i],$mier[$i],$jue[$i],$vie[$i],$sab[$i],$dom[$i],$hora_inicio[$i],$hora_fin[$i]);
  $modificarDetalle=$detalle->modificarIndice($id[$i],$indice[$i]);
  if (!$modificar || !$modificarDetalle) {
    $error="<span style='font-weight: bold;'>* No se pudo modificar al producto  Intente nuevamente.</span><br>";
    break;
  }
  
  }
  if ($error!="") {
    $con->rollback();
  }else{
    $con->commit();
  }
    
  }
  if ($proceso=="buscarProductoKeyUp") {
 $nomProd=$_POST['nomProd'];
  $producto= new PRODUCTOS_MYSQL($con);
  $resultado=$producto->buscarProductoKeyUp($nomProd);
    
  }
  if ($proceso=="buscarProductoCodBarra") {
    $codProdBarra=$_POST['codProdBarra'];
  $producto= new PRODUCTOS_MYSQL($con);
  $resultado=$producto->buscarProductoCodBarra($codProdBarra);
    
  }
  if ($proceso=="desactivarProducto") {
    $idProducto=$_POST['idProducto'];
    $con->transacion();
  $producto= new PRODUCTOS_MYSQL($con);
  $modificar=$producto->desactivarProducto($idProducto);
  if (!$modificar) {
    $error="<span style='font-weight: bold;'>* No se pudo modificar al producto  Intente nuevamente.</span><br>";
  }
    if ($error!="") {
    $con->rollback();
  }else{
    $con->commit();
  }


  }
if ($proceso=="moverProductoMenu") {
  $idProducto=$_POST['idProducto'];
  $grupo=$_POST['grupo'];
    $con->transacion();
  $producto= new PRODUCTOS_MYSQL($con);
  $modificar=$producto->moverProductoMenu($idProducto,$grupo);
  if (!$modificar) {
    $error="<span style='font-weight: bold;'>* No se pudo modificar al producto  Intente nuevamente.</span><br>";
  }
    if ($error!="") {
    $con->rollback();
  }else{
    $con->commit();
  }
}

$con->closed();
$reponse = array("error" => $error, "result" => $resultado);
echo  json_encode($reponse);

 ?>