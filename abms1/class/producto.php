<?php 
/**
* 
*/
class producto 
{		
	public $id;
	public $cod_prod;
	public $nom_prod;
	public $nom_grupo;
	public $cantidad;
	public $pre_venta;
	public $unid;
	public $grupo;
	public $disponible;
	public $estado;
	public $presa;
	public $unidad;
	public $pre_costo;
	public $colores;
	public $nomb_grupo;
	public $stock;
	public $cantidadac;
	public $barcode;
	public $familia;
    public $imgnormal;
    public $impcoc;
    public $imppunt1;
    public $imppunt2;
    public $imppunt3;
    public $imppunt4;
    public $lun;
    public $mar;
    public $mier;
    public $jue;
    public $vie;
    public $sab;
    public $dom;
    public $hora_inicio;
    public $hora_fin;
    public $tiempo;//EN ESTA VARIABLE SE GUARDA LOS TIPOS DE PRODUCTOS
	public $CON;
 
	  function producto($con) {
        $this->CON = $con;
    }
	
	function contructor($id, $cod_prod,$nom_prod,$cantidad,$pre_venta,$estado,$presa,$unid,$pre_costo,$colores,$nomb_grupo,$stock,$unidad,$grupo,$disponible,$barcode,$familia,$imgnormal,$impcoc,$imppunt1,$imppunt2,$imppunt3,$imppunt4,$lun,$mar,$mier,$jue,$vie,$sab,$dom,$hora_inicio,$hora_fin,$tiempo){
		$this->nom_prod=$nom_prod;
		$this->id = $id;
		$this->cod_prod = $cod_prod;
		$this->cantidad = $cantidad;
		$this->pre_venta = $pre_venta;
		$this->estado = $estado;
		$this->presa = $presa;
		$this->unidad = $unidad;
		$this->pre_costo = $pre_costo;
		$this->colores = $colores;
		$this->nomb_grupo = $nomb_grupo;
		$this->stock = $stock;
		$this->unid = $unid;
		$this->grupo = $grupo;
		$this->disponible = $disponible;
		$this->barcode= $barcode;
		$this->familia=$familia;
        $this->imgnormal=$imgnormal;
        $this->impcoc=$impcoc;
        $this->imppunt1=$imppunt1;
        $this->imppunt2=$imppunt2;
        $this->imppunt3=$imppunt3;
        $this->imppunt4=$imppunt4;
        $this->lun=$lun;
        $this->mar=$mar;
        $this->mier=$mier;
        $this->jue=$jue;
        $this->vie=$vie;
        $this->sab=$sab;
        $this->dom=$dom;
        $this->hora_inicio=$hora_inicio;
        $this->hora_fin=$hora_fin;
        $this->tiempo=$tiempo;

	}

    function rellenar($resultado) {
        if (count($resultado)> 0) {
            $lista = array();
            while ($row = $resultado->fetch_assoc()) {
                $producto = new producto("");
                $producto->id = $row['id'] == null ? "" : $row['id'];
                $producto->cod_prod = $row['cod_prod'] == null ? "" : $row['cod_prod'];
                $producto->nom_prod = $row['nom_prod'] == null ? "" : $row['nom_prod'];
                $producto->nom_grupo = $row['nom_grupo'] == null ? "" : $row['nom_grupo'];
                $producto->cantidad = $row['cantidad'] == null ? "" : $row['cantidad'];
                $producto->pre_venta = $row['pre_venta'] == null ? "" : $row['pre_venta'];
                $producto->estado = $row['estado'] == null ? "" : $row['estado'];
                $producto->unid = $row['unid'] == null ? "" : $row['unid'];
                $producto->colores = $row['colores'] == null ? "" : $row['colores'];
                $producto->grupo = $row['grupo'] == null ? "" : $row['grupo'];
                $producto->disponible = $row['disponible'] == null ? "" : $row['disponible'];
                $producto->barcode = $row['barcode'] == null ? "" : $row['barcode'];
                $producto->familia = $row['familia'] == null ? "" : $row['familia'];
                $producto->presa = $row['presa'] == null ? "" : $row['presa'];
                $producto->imgnormal = $row['imgnormal'] == null ? "" : $row['imgnormal'];
                $producto->impcoc = $row['impcoc'] == null ? "" : $row['impcoc'];
                $producto->imppunt1 = $row['imppunt1'] == null ? "" : $row['imppunt1'];
                $producto->imppunt2 = $row['imppunt2'] == null ? "" : $row['imppunt2'];
                $producto->imppunt3 = $row['imppunt3'] == null ? "" : $row['imppunt3'];
                $producto->imppunt4 = $row['imppunt4'] == null ? "" : $row['imppunt4'];
                $producto->lun = $row['lun'] == null ? "" : $row['lun'];
                $producto->mar = $row['mar'] == null ? "" : $row['mar'];
                $producto->mier = $row['mier'] == null ? "" : $row['mier'];
                $producto->jue = $row['jue'] == null ? "" : $row['jue'];
                $producto->vie = $row['vie'] == null ? "" : $row['vie'];
                $producto->sab = $row['sab'] == null ? "" : $row['sab'];
                $producto->dom = $row['dom'] == null ? "" : $row['dom'];
                $producto->hora_inicio = $row['hora_inicio'] == null ? "" : $row['hora_inicio'];
                $producto->hora_fin = $row['hora_fin'] == null ? "" : $row['hora_fin'];
                $producto->tiempo = $row['tiempo'] == null ? "" : $row['tiempo'];

                // $provedor->Contacto = $row['Contacto'] == null ? "" : $row['Contacto'];
                // $provedor->Telefono_Contacto = $row['Telefono_Contacto'] == null ? "" : $row['Telefono_Contacto'];
                // $provedor->sucursal_id = $row['sucursal_id'] == null ? "" : $row['sucursal_id'];
                $lista[] = $producto;
            }
            return $lista;
        } else {
            return null;
        }
    }
	function ListarDadaId($id){
			 $consulta="select  productos_mysql.id,
            productos_mysql.cod_prod,
            productos_mysql.nom_prod,
            productos_mysql.barcode,
            productos_mysql.disponible,
            productos_mysql.familia,
            productos_mysql.cantidad,
            productos_mysql.unid,
            productos_mysql.pre_venta,
            productos_mysql.estado,
            productos_mysql.grupo,
            productos_mysql.presa,
            productos_mysql.colores,
            productos_mysql.impcoc,
            productos_mysql.imppunt1,
            productos_mysql.imppunt2,
            productos_mysql.imppunt3,
            productos_mysql.imppunt4,
            productos_mysql.lun,
            productos_mysql.mar,
            productos_mysql.mier,
            productos_mysql.jue,
            productos_mysql.vie,
            productos_mysql.sab,
            productos_mysql.dom,
            productos_mysql.hora_inicio,
            productos_mysql.hora_fin,
            productos_mysql.tiempo,
              productos_mysql.imgnormal,            
            menugrupo_mysql.nom_grupo from productos_mysql,menugrupo_mysql where productos_mysql.GRUPO=menugrupo_mysql.ID AND productos_mysql.id=".$id;
			   $result = $this->CON->consulta($consulta);
        $producto = $this->rellenar($result);
        if ($producto == null) {
            return "";
        }
        return $producto[0];
   		 }

   		 function modificar($id,$ruta) {
        $consulta = "update productos_mysql set  nom_prod ='" . $this->nom_prod . "', cantidad ='" . $this->cantidad . "', estado ='" . $this->estado . "', pre_venta ='" . $this->pre_venta . "', presa='".$this->presa."',  colores ='" . $this->colores . "', disponible ='" . $this->disponible . "', barcode ='" . $this->barcode . "', grupo =" . $this->grupo . ", familia ='" . $this->familia . "', imgnormal='".$ruta."', 
            impcoc='".$this->impcoc."', imppunt1='".$this->imppunt1."', imppunt2='".$this->imppunt2."',imppunt3='".$this->imppunt3."', imppunt4='".$this->imppunt4."', lun='".$this->lun."', mar='".$this->mar."', mier='".$this->mier."', jue='".$this->jue."', vie='".$this->vie."', sab='".$this->sab."', dom='".$this->dom."', hora_inicio='".$this->hora_inicio."', hora_fin='".$this->hora_fin."', tiempo='".$this->tiempo."'   
         where id=" . $id;
        return $this->CON->manipular($consulta);
    }
   		 
	
function todo(){
        $consulta="SELECT
            productos_mysql.id,
            productos_mysql.cod_prod,
            productos_mysql.nom_prod,
            productos_mysql.barcode,
            productos_mysql.disponible,
            productos_mysql.familia,
            productos_mysql.cantidad,
            productos_mysql.unid,
            productos_mysql.pre_venta,
            productos_mysql.estado,
            productos_mysql.grupo,
            productos_mysql.presa,
            productos_mysql.colores,            
            menugrupo_mysql.nom_grupo,
            productos_mysql.impcoc,
            productos_mysql.imppunt1,
            productos_mysql.imppunt2,
            productos_mysql.imppunt3,
            productos_mysql.imppunt4,
            productos_mysql.lun,
            productos_mysql.mar,
            productos_mysql.mier,
            productos_mysql.jue,
            productos_mysql.vie,
            productos_mysql.sab,
            productos_mysql.dom,
            productos_mysql.hora_inicio,
            productos_mysql.tiempo,
            productos_mysql.hora_fin,
            productos_mysql.imgnormal
            FROM
            productos_mysql
            INNER JOIN menugrupo_mysql ON productos_mysql.grupo = menugrupo_mysql.grupo order by productos_mysql.id";
        $result=$this->CON->consulta($consulta);
        $relproins_mysql=$this->rellenar($result);
        if($relproins_mysql==null){
            return null;
        }
        return $relproins_mysql;
    }


    function mostrar($id){
        $consulta="select productos_mysql.id,
            productos_mysql.cod_prod,
            productos_mysql.nom_prod,
            productos_mysql.barcode,
            productos_mysql.disponible,
            productos_mysql.familia,
            productos_mysql.cantidad,
            productos_mysql.unid,
            productos_mysql.pre_venta,
            productos_mysql.estado,
            productos_mysql.grupo,
            productos_mysql.presa,
            productos_mysql.colores,   
            productos_mysql.imgnormal,  
            productos_mysql.impcoc,
            productos_mysql.imppunt1,
            productos_mysql.imppunt2,
            productos_mysql.imppunt3,
            productos_mysql.imppunt4,
            productos_mysql.lun,
            productos_mysql.mar,
            productos_mysql.mier,
            productos_mysql.jue,
            productos_mysql.vie,
            productos_mysql.sab,
            productos_mysql.dom,       
            productos_mysql.hora_inicio,
            productos_mysql.hora_fin,
            productos_mysql.tiempo,
            menugrupo_mysql.nom_grupo from productos_mysql,menugrupo_mysql where productos_mysql.grupo=menugrupo_mysql.GRUPO and  productos_mysql.grupo=".$id;
          $result=$this->CON->consulta($consulta);
        $relproins_mysql=$this->rellenar($result);
        if($relproins_mysql==null){
            return "";
        }
        return $relproins_mysql;
    }
      

      function insertar($imgnormal) { 
        // echo "fdfd". $this->imgnormal;
        // echo $this->impcoc;
        // echo $this->imppunt1;
 
     $consulta = sprintf("INSERT INTO productos_mysql (id, nom_prod, estado, cantidad, unid, pre_venta, grupo, disponible, presa, colores, barcode, familia,imgnormal, impcoc, imppunt1, imppunt2, imppunt3, imppunt4, lun, mar, mier, jue, vie, sab, dom, hora_inicio, hora_fin,tiempo) values(null, '".$this->nom_prod."', '".$this->estado."',".$this->cantidad.",".$this->unid.",".$this->pre_venta.",".$this->grupo.",'".$this->disponible."'
    ,'".$this->presa."','".$this->colores."','".$this->barcode."','".$this->familia."' , '".$imgnormal."','".$this->impcoc."','".$this->imppunt1."','".$this->imppunt2."','".$this->imppunt3."','".$this->imppunt4."','".$this->lun."','".$this->mar."','".$this->mier."','".$this->jue."','".$this->vie."','".$this->sab."','".$this->dom."','".$this->hora_inicio."','".$this->hora_fin."','".$this->tiempo."')");     


if (!$this->CON->manipular($consulta)) 
            return 0;

        $consulta = "SELECT LAST_INSERT_ID() as id";
        $resultado = $this->CON->consulta($consulta);
       
        return $resultado->fetch_assoc()['id'];
  
}

function modificarCodigo($id){

     $consulta="update productos_mysql 
    set cod_prod=".$id."
    where id=".$id;
    if (!$this->CON->manipular($consulta)) 
            return false;

            return true;
}
function verificarNombre($nombre,$id){
  $consulta="SELECT
            productos_mysql.id,
            productos_mysql.cod_prod,
            productos_mysql.nom_prod,
            productos_mysql.barcode,
            productos_mysql.disponible,
            productos_mysql.familia,
            productos_mysql.cantidad,
            productos_mysql.unid,
            productos_mysql.pre_venta,
            productos_mysql.estado,
            productos_mysql.grupo,
            productos_mysql.presa,
            productos_mysql.colores,            
            menugrupo_mysql.nom_grupo,
            productos_mysql.impcoc,
            productos_mysql.imppunt1,
            productos_mysql.imppunt2,
            productos_mysql.imppunt3,
            productos_mysql.imppunt4,
             productos_mysql.lun,
            productos_mysql.mar,
            productos_mysql.mier,
            productos_mysql.jue,
            productos_mysql.vie,
            productos_mysql.sab,
            productos_mysql.dom,
            productos_mysql.hora_inicio,
            productos_mysql.hora_fin,
            productos_mysql.tiempo,
            productos_mysql.imgnormal
            FROM
            productos_mysql
            INNER JOIN menugrupo_mysql ON productos_mysql.grupo = menugrupo_mysql.grupo where productos_mysql.nom_prod='".$nombre."' and productos_mysql.estado='ACTIVO' and productos_mysql.id<>".$id;
$result=$this->CON->consulta($consulta);
        $producto=$this->rellenar($result);
        if($producto==null){
            return null;
        }
        return $producto;
}

function listarProductosActivos(){
     $consulta="SELECT
            productos_mysql.id,
            productos_mysql.cod_prod,
            productos_mysql.nom_prod,
            productos_mysql.barcode,
            productos_mysql.disponible,
            productos_mysql.familia,
            productos_mysql.cantidad,
            productos_mysql.unid,
            productos_mysql.pre_venta,
            productos_mysql.estado,
            productos_mysql.grupo,
            productos_mysql.presa,
            productos_mysql.colores,            
            menugrupo_mysql.nom_grupo,
            productos_mysql.impcoc,
            productos_mysql.imppunt1,
            productos_mysql.imppunt2,
            productos_mysql.imppunt3,
            productos_mysql.imppunt4,
             productos_mysql.lun,
            productos_mysql.mar,
            productos_mysql.mier,
            productos_mysql.jue,
            productos_mysql.vie,
            productos_mysql.sab,
            productos_mysql.dom,
            productos_mysql.hora_inicio,
            productos_mysql.hora_fin,
            productos_mysql.tiempo,
            productos_mysql.imgnormal
            FROM
            productos_mysql
            INNER JOIN menugrupo_mysql ON productos_mysql.grupo = menugrupo_mysql.grupo where   productos_mysql.estado='ACTIVO' ";
$result=$this->CON->consulta($consulta);
        $producto=$this->rellenar($result);
        if($producto==null){
            return null;
        }
        return $producto;
}

	 } //finclase


 ?>    
