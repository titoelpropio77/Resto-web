<?php/** * KARDEXPROD_MYSQL.class.php * KARDEXPROD **/class KARDEXPROD_MYSQL {	public static $DATABASE_NAME = 'posgourmet';	public static $TABLE_NAME = 'kardexprod_mysql';public $CONN;	/**	 * @var COD_PROD	 */	public $COD_PROD ;	/**	 * @var FECHA	 */	public $FECHA ;	/**	 * @var NOM_PROD	 */	public $NOM_PROD ;	/**	 * @var PORMENORES	 */	public $PORMENORES ;	/**	 * @var CANTIDAD	 */	public $CANTIDAD ;	/**	 * @var PRE_VENTA	 */	public $PRE_VENTA ;	/**	 * @var ENTRADA	 */	public $ENTRADA ;	/**	 * @var SALIDA	 */	public $SALIDA ;	/**	 * @var SALDO	 */	public $SALDO ;	/**	 * @var UNIDAD	 */	public $UNIDAD ;	/**	 * @var MOVIMIENTO	 */	public $MOVIMIENTO ;	public $ID ;function KARDEXPROD_MYSQL($con) {$this->CON=$con;}	function contructor($COD_PROD,$FECHA,$NOM_PROD,$PORMENORES,$CANTIDAD,$PRE_VENTA,$ENTRADA,$SALIDA,$SALDO,$UNIDAD,$MOVIMIENTO,$ID){	$this->COD_PROD=$COD_PROD;	$this->FECHA=$FECHA;	$this->NOM_PROD=$NOM_PROD;	$this->PORMENORES=$PORMENORES;	$this->CANTIDAD=$CANTIDAD;	$this->PRE_VENTA=$PRE_VENTA;	$this->ENTRADA=$ENTRADA;	$this->SALIDA=$SALIDA;	$this->SALDO=$SALDO;	$this->UNIDAD=$UNIDAD;	$this->MOVIMIENTO=$MOVIMIENTO;	$this->ID=$ID;	}function insertar() { $consulta="INSERT INTO(COD_PROD,FECHA,NOM_PROD,PORMENORES,CANTIDAD,PRE_VENTA,ENTRADA,SALIDA,SALDO,UNIDAD,MOVIMIENTO,ID)values('".$this->COD_PROD."','".$this->FECHA."','".$this->NOM_PROD."','".$this->PORMENORES."','".$this->CANTIDAD."','".$this->PRE_VENTA."','".$this->ENTRADA."','".$this->SALIDA."','".$this->SALDO."','".$this->UNIDAD."','".$this->MOVIMIENTO."','".$this->ID."')"; return $this->CON->manipular($consulta);}function rellenar($resultado){
        if ($resultado->num_rows > 0) {
            $lista=array();
            while($row = $resultado->fetch_assoc()) {	$kardexprod_mysql= new KARDEXPROD_MYSQL("");		$kardexprod_mysql->COD_PROD=$row["COD_PROD"] ==null?"":$row["COD_PROD"];		$kardexprod_mysql->FECHA=$row["FECHA"] ==null?"":$row["FECHA"];		$kardexprod_mysql->NOM_PROD=$row["NOM_PROD"] ==null?"":$row["NOM_PROD"];		$kardexprod_mysql->PORMENORES=$row["PORMENORES"] ==null?"":$row["PORMENORES"];		$kardexprod_mysql->CANTIDAD=$row["CANTIDAD"] ==null?"":$row["CANTIDAD"];		$kardexprod_mysql->PRE_VENTA=$row["PRE_VENTA"] ==null?"":$row["PRE_VENTA"];		$kardexprod_mysql->ENTRADA=$row["ENTRADA"] ==null?"":$row["ENTRADA"];		$kardexprod_mysql->SALIDA=$row["SALIDA"] ==null?"":$row["SALIDA"];		$kardexprod_mysql->SALDO=$row["SALDO"] ==null?"":$row["SALDO"];		$kardexprod_mysql->UNIDAD=$row["UNIDAD"] ==null?"":$row["UNIDAD"];		$kardexprod_mysql->MOVIMIENTO=$row["MOVIMIENTO"] ==null?"":$row["MOVIMIENTO"];		$kardexprod_mysql->ID=$row["ID"] ==null?"":$row["ID"];		$lista[]=$kardexprod_mysql;};	return $lista;}	else{
            return null;
        }}function todo(){
        $consulta="select * from kardexprod_mysql";
        $result=$this->CON->consulta($consulta);
        return $this->rellenar($result);
    }function buscarXID($id){
        $consulta="select * from kardexprod_mysql where ID=".$id;
        $result=$this->CON->consulta($consulta);
        $kardexprod_mysql=$this->rellenar($result);
        if($kardexprod_mysql==null){
            return null;
        }
        return $this->rellenar($result);
    }}