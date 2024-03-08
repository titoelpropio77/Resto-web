<?php

/**
 * VEN_GRAL_MYSQL.class.php
 * VEN_GRAL
 **/
class VEN_GRAL_MYSQL {

	public static $DATABASE_NAME = 'posgourmet';
	public static $TABLE_NAME = 'ven_gral_mysql';




public $CONN;
	/**
	 * @var FACTURA
	 */
	public $FACTURA ;
	/**
	 * @var ORDEN
	 */
	public $ORDEN ;
	/**
	 * @var F_VENTA
	 */
	public $F_VENTA ;
	/**
	 * @var LOGIN
	 */
	public $LOGIN ;
	/**
	 * @var FORMAPAGO
	 */
	public $FORMAPAGO ;
	/**
	 * @var ESTADO
	 */
	public $ESTADO ;
	/**
	 * @var ELIMINPOR
	 */
	public $ELIMINPOR ;
	/**
	 * @var SALIDA
	 */
	public $SALIDA ;
	/**
	 * @var TURNO
	 */
	public $TURNO ;
	/**
	 * @var COD_CLI
	 */
	public $COD_CLI ;
	/**
	 * @var VENDEDOR
	 */
	public $VENDEDOR ;
	/**
	 * @var DHORAVEN
	 */
	public $DHORAVEN ;
	/**
	 * @var CAM_OF
	 */
	public $CAM_OF ;
	/**
	 * @var TOTAL_FACT
	 */
	public $TOTAL_FACT ;
	/**
	 * @var TOT_DEUDA
	 */
	public $TOT_DEUDA ;
	/**
	 * @var XPAGAR
	 */
	public $XPAGAR ;
	/**
	 * @var PENDIENTE
	 */
	public $PENDIENTE ;
	/**
	 * @var OBSER
	 */
	public $OBSER ; 
	/**
	 * @var ANULADO
	 */
	public $ANULADO ;
	/**
	 * @var CERRADO
	 */
	public $CERRADO ;
	/**
	 * @var FORTAX
	 */
	public $FORTAX ;
	/**
	 * @var TOT_DES
	 */
	public $TOT_DES ;
	/**
	 * @var ALFA
	 */
	public $ALFA ;
	/**
	 * @var NUMORDEN
	 */
	public $NUMORDEN ;
	/**
	 * @var PAGO_US
	 */
	public $PAGO_US ;
	/**
	 * @var CAMBIO_US
	 */
	public $CAMBIO_US ;
	/**
	 * @var PAGO_BS
	 */
	public $PAGO_BS ;
	/**
	 * @var CAMBIO_BS
	 */
	public $CAMBIO_BS ;
	/**
	 * @var MONEDA
	 */
	public $MONEDA ;
	/**
	 * @var COD_EMPL
	 */
	public $COD_EMPL ;
	/**
	 * @var NIT_CLI
	 */
	public $NIT_CLI ;
	/**
	 * @var CI_CLI
	 */
	public $CI_CLI ;
	/**
	 * @var NOM_CLI
	 */
	public $NOM_CLI ;
	/**
	 * @var LLAVE
	 */
	public $LLAVE ;
	/**
	 * @var NROAUTORI
	 */
	public $NROAUTORI ;
	/**
	 * @var FECHA_LIM
	 */
	public $FECHA_LIM ;
	/**
	 * @var CIFRADO
	 */
	public $CIFRADO ;
	/**
	 * @var PRE_PAGO
	 */
	public $PRE_PAGO ;
	/**
	 * @var ORDENES
	 */
	public $ORDENES ;
	/**
	 * @var ENTREGADO
	 */
	public $ENTREGADO ;
	public $ID ;

function VEN_GRAL_MYSQL($con) {$this->CON=$con;}

	function contructor($FACTURA,$ORDEN,$F_VENTA,$LOGIN,$FORMAPAGO,$ESTADO,$ELIMINPOR,$SALIDA,$TURNO,$COD_CLI,$VENDEDOR,$DHORAVEN,$CAM_OF,$TOTAL_FACT,$TOT_DEUDA,$XPAGAR,$PENDIENTE,$OBSER,$ANULADO,$CERRADO,$FORTAX,$TOT_DES,$ALFA,$NUMORDEN,$PAGO_US,$CAMBIO_US,$PAGO_BS,$CAMBIO_BS,$MONEDA,$COD_EMPL,$NIT_CLI,$CI_CLI,$NOM_CLI,$LLAVE,$NROAUTORI,$FECHA_LIM,$CIFRADO,$PRE_PAGO,$ORDENES,$ENTREGADO,$ID){
	$this->FACTURA=$FACTURA;
	$this->ORDEN=$ORDEN;
	$this->F_VENTA=$F_VENTA;
	$this->LOGIN=$LOGIN;
	$this->FORMAPAGO=$FORMAPAGO;
	$this->ESTADO=$ESTADO;
	$this->ELIMINPOR=$ELIMINPOR;
	$this->SALIDA=$SALIDA;
	$this->TURNO=$TURNO;
	$this->COD_CLI=$COD_CLI;
	$this->VENDEDOR=$VENDEDOR;
	$this->DHORAVEN=$DHORAVEN;
	$this->CAM_OF=$CAM_OF;
	$this->TOTAL_FACT=$TOTAL_FACT;
	$this->TOT_DEUDA=$TOT_DEUDA;
	$this->XPAGAR=$XPAGAR;
	$this->PENDIENTE=$PENDIENTE;
	$this->OBSER=$OBSER;
	$this->ANULADO=$ANULADO;
	$this->CERRADO=$CERRADO;
	$this->FORTAX=$FORTAX;
	$this->TOT_DES=$TOT_DES;
	$this->ALFA=$ALFA;
	$this->NUMORDEN=$NUMORDEN;
	$this->PAGO_US=$PAGO_US;
	$this->CAMBIO_US=$CAMBIO_US;
	$this->PAGO_BS=$PAGO_BS;
	$this->CAMBIO_BS=$CAMBIO_BS;
	$this->MONEDA=$MONEDA;
	$this->COD_EMPL=$COD_EMPL;
	$this->NIT_CLI=$NIT_CLI;
	$this->CI_CLI=$CI_CLI;
	$this->NOM_CLI=$NOM_CLI;
	$this->LLAVE=$LLAVE;
	$this->NROAUTORI=$NROAUTORI;
	$this->FECHA_LIM=$FECHA_LIM;
	$this->CIFRADO=$CIFRADO;
	$this->PRE_PAGO=$PRE_PAGO;
	$this->ORDENES=$ORDENES;
	$this->ENTREGADO=$ENTREGADO;
	$this->ID=$ID;
	}

function insertar() { 
$llave = $this->CON->real_escape_string($this->LLAVE);
  $consulta="INSERT INTO ven_gral_mysql(FACTURA,ORDEN,F_VENTA,LOGIN,FORMAPAGO,ESTADO,ELIMINPOR,SALIDA,TURNO,COD_CLI,VENDEDOR,DHORAVEN,CAM_OF,TOTAL_FACT,TOT_DEUDA,XPAGAR,PENDIENTE,OBSER,ANULADO,CERRADO,FORTAX,TOT_DES,ALFA,NUMORDEN,PAGO_US,CAMBIO_US,PAGO_BS,CAMBIO_BS,MONEDA,COD_EMPL,NIT_CLI,CI_CLI,NOM_CLI,LLAVE,NROAUTORI,FECHA_LIM,CIFRADO,PRE_PAGO,ORDENES,ENTREGADO,ID)values('".$this->FACTURA."','".$this->ORDEN."','".$this->F_VENTA."','".$this->LOGIN."','".$this->FORMAPAGO."','".$this->ESTADO."','".$this->ELIMINPOR."','".$this->SALIDA."','".$this->TURNO."','".$this->COD_CLI."','".$this->VENDEDOR."','".$this->DHORAVEN."',".$this->CAM_OF.",'".$this->TOTAL_FACT."',".$this->TOT_DEUDA.",'".$this->XPAGAR."','".$this->PENDIENTE."','".$this->OBSER."','".$this->ANULADO."','".$this->CERRADO."','".$this->FORTAX."','".$this->TOT_DES."','".$this->ALFA."','".$this->NUMORDEN."','".$this->PAGO_US."','".$this->CAMBIO_US."','".$this->PAGO_BS."','".$this->CAMBIO_BS."','".$this->MONEDA."','".$this->COD_EMPL."','".$this->NIT_CLI."','".$this->CI_CLI."','".$this->NOM_CLI."','".$llave."','".$this->NROAUTORI."','".$this->FECHA_LIM."','".$this->CIFRADO."','".$this->PRE_PAGO."','".$this->ORDENES."','".$this->ENTREGADO."','".$this->ID."')";
  if (!$this->CON->manipular($consulta))
            return 0;
        $consulta = "SELECT LAST_INSERT_ID() as id";
        $resultado = $this->CON->consulta($consulta);
        return $resultado->fetch_assoc()['id'];
}

function rellenar($resultado){
        if ($resultado->num_rows > 0) {
            $lista=array();
            while($row = $resultado->fetch_assoc()) {
	$ven_gral_mysql= new VEN_GRAL_MYSQL("");

		$ven_gral_mysql->FACTURA=$row["FACTURA"] ==null?"":$row["FACTURA"];
		$ven_gral_mysql->ORDEN=$row["ORDEN"] ==null?"":$row["ORDEN"];
		$ven_gral_mysql->F_VENTA=$row["F_VENTA"] ==null?"":$row["F_VENTA"];
		$ven_gral_mysql->LOGIN=$row["LOGIN"] ==null?"":$row["LOGIN"];
		$ven_gral_mysql->FORMAPAGO=$row["FORMAPAGO"] ==null?"":$row["FORMAPAGO"];
		$ven_gral_mysql->ESTADO=$row["ESTADO"] ==null?"":$row["ESTADO"];
		$ven_gral_mysql->ELIMINPOR=$row["ELIMINPOR"] ==null?"":$row["ELIMINPOR"];
		$ven_gral_mysql->SALIDA=$row["SALIDA"] ==null?"":$row["SALIDA"];
		$ven_gral_mysql->TURNO=$row["TURNO"] ==null?"":$row["TURNO"];
		$ven_gral_mysql->COD_CLI=$row["COD_CLI"] ==null?"":$row["COD_CLI"];
		$ven_gral_mysql->VENDEDOR=$row["VENDEDOR"] ==null?"":$row["VENDEDOR"];
		$ven_gral_mysql->DHORAVEN=$row["DHORAVEN"] ==null?"":$row["DHORAVEN"];
		$ven_gral_mysql->CAM_OF=$row["CAM_OF"] ==null?"":$row["CAM_OF"];
		$ven_gral_mysql->TOTAL_FACT=$row["TOTAL_FACT"] ==null?"":$row["TOTAL_FACT"];
		$ven_gral_mysql->TOT_DEUDA=$row["TOT_DEUDA"] ==null?"":$row["TOT_DEUDA"];
		$ven_gral_mysql->XPAGAR=$row["XPAGAR"] ==null?"":$row["XPAGAR"];
		$ven_gral_mysql->PENDIENTE=$row["PENDIENTE"] ==null?"":$row["PENDIENTE"];
		$ven_gral_mysql->OBSER=$row["OBSER"] ==null?"":$row["OBSER"];
		$ven_gral_mysql->ANULADO=$row["ANULADO"] ==null?"":$row["ANULADO"];
		$ven_gral_mysql->CERRADO=$row["CERRADO"] ==null?"":$row["CERRADO"];
		$ven_gral_mysql->FORTAX=$row["FORTAX"] ==null?"":$row["FORTAX"];
		$ven_gral_mysql->TOT_DES=$row["TOT_DES"] ==null?"":$row["TOT_DES"];
		$ven_gral_mysql->ALFA=$row["ALFA"] ==null?"":$row["ALFA"];
		$ven_gral_mysql->NUMORDEN=$row["NUMORDEN"] ==null?"":$row["NUMORDEN"];
		$ven_gral_mysql->PAGO_US=$row["PAGO_US"] ==null?"":$row["PAGO_US"];
		$ven_gral_mysql->CAMBIO_US=$row["CAMBIO_US"] ==null?"":$row["CAMBIO_US"];
		$ven_gral_mysql->PAGO_BS=$row["PAGO_BS"] ==null?"":$row["PAGO_BS"];
		$ven_gral_mysql->CAMBIO_BS=$row["CAMBIO_BS"] ==null?"":$row["CAMBIO_BS"];
		$ven_gral_mysql->MONEDA=$row["MONEDA"] ==null?"":$row["MONEDA"];
		$ven_gral_mysql->COD_EMPL=$row["COD_EMPL"] ==null?"":$row["COD_EMPL"];
		$ven_gral_mysql->NIT_CLI=$row["NIT_CLI"] ==null?"":$row["NIT_CLI"];
		$ven_gral_mysql->CI_CLI=$row["CI_CLI"] ==null?"":$row["CI_CLI"];
		$ven_gral_mysql->NOM_CLI=$row["NOM_CLI"] ==null?"":$row["NOM_CLI"];
		$ven_gral_mysql->LLAVE=$row["LLAVE"] ==null?"":$row["LLAVE"];
		$ven_gral_mysql->NROAUTORI=$row["NROAUTORI"] ==null?"":$row["NROAUTORI"];
		$ven_gral_mysql->FECHA_LIM=$row["FECHA_LIM"] ==null?"":$row["FECHA_LIM"];
		$ven_gral_mysql->CIFRADO=$row["CIFRADO"] ==null?"":$row["CIFRADO"];
		$ven_gral_mysql->PRE_PAGO=$row["PRE_PAGO"] ==null?"":$row["PRE_PAGO"];
		$ven_gral_mysql->ORDENES=$row["ORDENES"] ==null?"":$row["ORDENES"];
		$ven_gral_mysql->ENTREGADO=$row["ENTREGADO"] ==null?"":$row["ENTREGADO"];
		$ven_gral_mysql->ID=$row["ID"] ==null?"":$row["ID"];
		$lista[]=$ven_gral_mysql;};
	return $lista;}
	else{
            return null;
        }}

function todo(){
        $consulta="select * from ven_gral_mysql";
         $result=$this->CON->consulta($consulta);
        $ven_gral_mysql=$this->rellenar($result);
        if($ven_gral_mysql==null){
            return $ven_gral_mysql="";
        }
        return $ven_gral_mysql;
    }
    function dadaFecha($fecha){
         $consulta="select * from ven_gral_mysql where F_VENTA='".$fecha."'";
         $result=$this->CON->consulta($consulta);
        $ven_gral_mysql=$this->rellenar($result);
        if($ven_gral_mysql==null){
            return $ven_gral_mysql="";
        }
        return $ven_gral_mysql;
    }
function buscarXID($id){
        $consulta="select FACTURA,ORDEN,date_format(F_VENTA,'%d/%m/%Y') as F_VENTA,LOGIN,FORMAPAGO,ESTADO,ELIMINPOR,SALIDA,TURNO,COD_CLI,VENDEDOR,DHORAVEN,CAM_OF,TOTAL_FACT,TOT_DEUDA,XPAGAR,PENDIENTE,OBSER,ANULADO,CERRADO,FORTAX,TOT_DES,ALFA,NUMORDEN,PAGO_US,CAMBIO_US,PAGO_BS,CAMBIO_BS,MONEDA,COD_EMPL,NIT_CLI,CI_CLI,NOM_CLI,LLAVE,NROAUTORI,FECHA_LIM,CIFRADO,PRE_PAGO,ORDENES,ENTREGADO,ID from ven_gral_mysql where ID=".$id;
        $result=$this->CON->consulta($consulta);
        $ven_gral_mysql=$this->rellenar($result);
        if($ven_gral_mysql==null){
            return null;
        }
        return $ven_gral_mysql;
    }

    function buscarBettweenDate($dateInit, $dateEnd){
        $consulta="select FACTURA,ORDEN,date_format(F_VENTA,'%Y-%m-%d') as F_VENTA,LOGIN,FORMAPAGO,ESTADO,ELIMINPOR,SALIDA,TURNO,COD_CLI,VENDEDOR,DHORAVEN,CAM_OF,TOTAL_FACT,TOT_DEUDA,XPAGAR,PENDIENTE,OBSER,ANULADO,CERRADO,FORTAX,TOT_DES,ALFA,NUMORDEN,PAGO_US,CAMBIO_US,PAGO_BS,CAMBIO_BS,MONEDA,COD_EMPL,NIT_CLI,CI_CLI,NOM_CLI,LLAVE,NROAUTORI,FECHA_LIM,CIFRADO,PRE_PAGO,ORDENES,ENTREGADO,ID from ven_gral_mysql where F_VENTA>='".$dateInit . "' and F_VENTA<= '" .$dateEnd."' and ESTADO='ACTIVO' ";
        // var_dump($consulta);
        // exit;
        $result=$this->CON->consulta($consulta);
        $ven_gral_mysql=$this->rellenar($result);
        if($ven_gral_mysql==null){
            return null;
        }
        return $ven_gral_mysql;
    }
   function  modificarFactura($id){
         $consulta="update ven_gral_mysql
         set FACTURA=".$id. "
           where ID=".$id;
    return $this->CON->manipular($consulta);     
   }

   function anularVenta($id,$estado){
   		  $consulta="update ven_gral_mysql
   		set ESTADO='".$estado."'," .
   		"  ANULADO='S'".
   		" where ID=".$id;
    return $this->CON->manipular($consulta);     
   		
   }
   function listarUsuarioVenta($fecha){
   	$consulta="SELECT * FROM ven_gral_mysql WHERE F_VENTA='".$fecha."' GROUP BY LOGIN";
   $result=$this->CON->consulta($consulta);
        $ven_gral_mysql=$this->rellenar($result);
        if($ven_gral_mysql==null){
            return $ven_gral_mysql="";
        }
        return $ven_gral_mysql;  

   }
   function listaFacturasCredito($fecha,$vendedor,$entrada){
   	switch ($entrada) {
		case 'MAÑANA Y NOCHE':
			if ($vendedor=="") {
					$consulta="SELECT * FROM ven_gral_mysql WHERE ven_gral_mysql.FORMAPAGO='CREDITO' and ven_gral_mysql.F_VENTA='$fecha'";
			}else{
				$consulta="SELECT * FROM ven_gral_mysql WHERE ven_gral_mysql.FORMAPAGO='CREDITO' and ven_gral_mysql.F_VENTA='$fecha' and ven_gral_mysql.LOGIN='$vendedor'";
			}
			break;
		case 'MAÑANA':
			if ($vendedor=="") {
				$consulta="SELECT * FROM ven_gral_mysql WHERE ven_gral_mysql.FORMAPAGO='CREDITO' and ven_gral_mysql.F_VENTA='$fecha' AND TURNO='MAÑANA'";
				
			}else{
			$consulta="SELECT * FROM ven_gral_mysql WHERE ven_gral_mysql.FORMAPAGO='CREDITO' and ven_gral_mysql.F_VENTA='$fecha' AND TURNO='MAÑANA' and ven_gral_mysql.LOGIN='$vendedor'";
			}
			break;
			case 'NOCHE':
			if ($vendedor=="") {
				$consulta="SELECT * FROM ven_gral_mysql WHERE ven_gral_mysql.FORMAPAGO='CREDITO' and ven_gral_mysql.F_VENTA='$fecha' AND TURNO='NOCHE'";
			}else{
			 $consulta="SELECT * FROM ven_gral_mysql WHERE ven_gral_mysql.FORMAPAGO='CREDITO' and ven_gral_mysql.F_VENTA='$fecha' AND TURNO='NOCHE' and ven_gral_mysql.LOGIN='$vendedor'";
			}
				break;
		default:
			# code...
			break;
	}
   	
   $result=$this->CON->consulta($consulta);
        $ven_gral_mysql=$this->rellenar($result);
        if($ven_gral_mysql==null){
            return $ven_gral_mysql="";
        }
        return $ven_gral_mysql;  
   }
   function listaFacturasAnuladas($fecha){
   	
   	$consulta='SELECT * FROM ven_gral_mysql WHERE ven_gral_mysql.ESTADO="INACTIVO" and ven_gral_mysql.F_VENTA="'.$fecha.'"';
   $result=$this->CON->consulta($consulta);
        $ven_gral_mysql=$this->rellenar($result);
        if($ven_gral_mysql==null){
            return $ven_gral_mysql="";
        }
        return $ven_gral_mysql;  
   }
   function archivarTotales($fecha,$entrada,$empleado){

	switch ($entrada) {
		case 'LOS2TURNOS':
			if ($empleado=="") {
				$consulta="update ven_gral_mysql
				set CERRADO='S' WHERE F_VENTA='".$fecha."'";
			}else{
			 $consulta="update ven_gral_mysql
				set CERRADO='S' WHERE F_VENTA='".$fecha."' and LOGIN='$empleado'";
			}
			break;
		case 'TURNOMAÑANA':
			if ($empleado=="") {
				$consulta="update ven_gral_mysql
				set CERRADO='S' WHERE F_VENTA='".$fecha."' and TURNO='MAÑANA'";
			}else{
			 $consulta="update ven_gral_mysql
				set CERRADO='S' WHERE F_VENTA='".$fecha."' and TURNO='MAÑANA' and LOGIN='$empleado'";
			}
			break;
			case 'TURNONOCHE':
			if ($empleado=="") {
				$consulta="update ven_gral_mysql
				set CERRADO='S' WHERE F_VENTA='".$fecha."' and TURNO='NOCHE'";
			}else{
			 $consulta="update ven_gral_mysql
				set CERRADO='S' WHERE F_VENTA='".$fecha."' and TURNO='NOCHE' and LOGIN='$empleado'";
			}
				break;
		default:
			# code...
			break;
	}
	 return $this->CON->manipular($consulta);
	}
	
	function buscarTarjetaGift($tarjeta){
		$consulta="select *from ven_gral_mysql where FACTURA=$tarjeta";
		$result=$this->CON->consulta($consulta);
        $ven_gral_mysql=$this->rellenar($result);
        if($ven_gral_mysql==null){
            return $ven_gral_mysql="";
        }
        return $ven_gral_mysql;  
	}
	function modificarVentaTarjeta($tarjeta,$nuevoSaldo){
	$consulta="update ven_gral_mysql
	  set PRE_PAGO='$nuevoSaldo'
	   where FACTURA=$tarjeta";
	   return $this->CON->manipular($consulta);
	}
}
