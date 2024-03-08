<?php/** * IMPRODUCTOS_MYSQL.class.php * IMPRODUCTOS **/class IMPRODUCTOS_MYSQL {	public static $DATABASE_NAME = 'posgourmet';	public static $TABLE_NAME = 'improductos_mysql';public $CONN;	/**	 * @var COD_PROD	 */	public $COD_PROD ;	/**	 * @var NOM_PROD	 */	public $NOM_PROD ;	/**	 * @var IMAGENES	 */	public $IMAGENES ;	/**	 * @var ESTADO	 */	public $ESTADO ;	public $ID ;function IMPRODUCTOS_MYSQL($con) {$this->CON=$con;}	function contructor($COD_PROD,$NOM_PROD,$IMAGENES,$ESTADO,$ID){	$this->COD_PROD=$COD_PROD;	$this->NOM_PROD=$NOM_PROD;	$this->IMAGENES=$IMAGENES;	$this->ESTADO=$ESTADO;	$this->ID=$ID;	}function insertar() { $consulta="INSERT INTO(COD_PROD,NOM_PROD,IMAGENES,ESTADO,ID)values('".$this->COD_PROD."','".$this->NOM_PROD."','".$this->IMAGENES."','".$this->ESTADO."','".$this->ID."')"; return $this->CON->manipular($consulta);}function rellenar($resultado){
        if ($resultado->num_rows > 0) {
            $lista=array();
            while($row = $resultado->fetch_assoc()) {	$improductos_mysql= new IMPRODUCTOS_MYSQL("");		$improductos_mysql->COD_PROD=$row["COD_PROD"] ==null?"":$row["COD_PROD"];		$improductos_mysql->NOM_PROD=$row["NOM_PROD"] ==null?"":$row["NOM_PROD"];		$improductos_mysql->IMAGENES=$row["IMAGENES"] ==null?"":$row["IMAGENES"];		$improductos_mysql->ESTADO=$row["ESTADO"] ==null?"":$row["ESTADO"];		$improductos_mysql->ID=$row["ID"] ==null?"":$row["ID"];		$lista[]=$improductos_mysql;};	return $lista;}	else{
            return null;
        }}function todo(){
        $consulta="select * from improductos_mysql";
        $result=$this->CON->consulta($consulta);
        return $this->rellenar($result);
    }function buscarXID($id){
        $consulta="select * from improductos_mysql where ID=".$id;
        $result=$this->CON->consulta($consulta);
        $improductos_mysql=$this->rellenar($result);
        if($improductos_mysql==null){
            return null;
        }
        return $this->rellenar($result);
    }}