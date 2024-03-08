<?php/** * PROV_GRAL_MYSQL.class.php * PROV_GRAL **/class PROV_GRAL_MYSQL {	public static $DATABASE_NAME = 'posgourmet';	public static $TABLE_NAME = 'prov_gral_mysql';public $CONN;	/**	 * @var TRANSAC	 */	public $TRANSAC ;	/**	 * @var COD_PROV	 */	public $COD_PROV ;	/**	 * @var CONCEPTO	 */	public $CONCEPTO ;	/**	 * @var FECHA	 */	public $FECHA ;	/**	 * @var CAM_OF	 */	public $CAM_OF ;	/**	 * @var FORMAPAGO	 */	public $FORMAPAGO ;	/**	 * @var TOTAL	 */	public $TOTAL ;	/**	 * @var ESTADO	 */	public $ESTADO ;	/**	 * @var NOM_PROV	 */	public $NOM_PROV ;	public $ID ;function PROV_GRAL_MYSQL($con) {$this->CON=$con;}	function contructor($TRANSAC,$COD_PROV,$CONCEPTO,$FECHA,$CAM_OF,$FORMAPAGO,$TOTAL,$ESTADO,$NOM_PROV,$ID){	$this->TRANSAC=$TRANSAC;	$this->COD_PROV=$COD_PROV;	$this->CONCEPTO=$CONCEPTO;	$this->FECHA=$FECHA;	$this->CAM_OF=$CAM_OF;	$this->FORMAPAGO=$FORMAPAGO;	$this->TOTAL=$TOTAL;	$this->ESTADO=$ESTADO;	$this->NOM_PROV=$NOM_PROV;	$this->ID=$ID;	}function insertar() { $consulta="INSERT INTO(TRANSAC,COD_PROV,CONCEPTO,FECHA,CAM_OF,FORMAPAGO,TOTAL,ESTADO,NOM_PROV,ID)values('".$this->TRANSAC."','".$this->COD_PROV."','".$this->CONCEPTO."','".$this->FECHA."','".$this->CAM_OF."','".$this->FORMAPAGO."','".$this->TOTAL."','".$this->ESTADO."','".$this->NOM_PROV."','".$this->ID."')"; return $this->CON->manipular($consulta);}function rellenar($resultado){
        if ($resultado->num_rows > 0) {
            $lista=array();
            while($row = $resultado->fetch_assoc()) {	$prov_gral_mysql= new PROV_GRAL_MYSQL("");		$prov_gral_mysql->TRANSAC=$row["TRANSAC"] ==null?"":$row["TRANSAC"];		$prov_gral_mysql->COD_PROV=$row["COD_PROV"] ==null?"":$row["COD_PROV"];		$prov_gral_mysql->CONCEPTO=$row["CONCEPTO"] ==null?"":$row["CONCEPTO"];		$prov_gral_mysql->FECHA=$row["FECHA"] ==null?"":$row["FECHA"];		$prov_gral_mysql->CAM_OF=$row["CAM_OF"] ==null?"":$row["CAM_OF"];		$prov_gral_mysql->FORMAPAGO=$row["FORMAPAGO"] ==null?"":$row["FORMAPAGO"];		$prov_gral_mysql->TOTAL=$row["TOTAL"] ==null?"":$row["TOTAL"];		$prov_gral_mysql->ESTADO=$row["ESTADO"] ==null?"":$row["ESTADO"];		$prov_gral_mysql->NOM_PROV=$row["NOM_PROV"] ==null?"":$row["NOM_PROV"];		$prov_gral_mysql->ID=$row["ID"] ==null?"":$row["ID"];		$lista[]=$prov_gral_mysql;};	return $lista;}	else{
            return null;
        }}function todo(){
        $consulta="select * from prov_gral_mysql";
        $result=$this->CON->consulta($consulta);
        return $this->rellenar($result);
    }function buscarXID($id){
        $consulta="select * from prov_gral_mysql where ID=".$id;
        $result=$this->CON->consulta($consulta);
        $prov_gral_mysql=$this->rellenar($result);
        if($prov_gral_mysql==null){
            return null;
        }
        return $this->rellenar($result);
    }}