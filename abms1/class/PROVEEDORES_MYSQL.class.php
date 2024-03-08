<?php/** * PROVEEDORES_MYSQL.class.php * PROVEEDORES **/class PROVEEDORES_MYSQL {	public static $DATABASE_NAME = 'posgourmet';	public static $TABLE_NAME = 'proveedores_mysql';public $CONN;	/**	 * @var COD_PROV	 */	public $COD_PROV ;	/**	 * @var NOM_PROV	 */	public $NOM_PROV ;	/**	 * @var DIR_PROV	 */	public $DIR_PROV ;	/**	 * @var TEL_PROV	 */	public $TEL_PROV ;	/**	 * @var PAIS_PROV	 */	public $PAIS_PROV ;	public $ID ;function PROVEEDORES_MYSQL($con) {$this->CON=$con;}	function contructor($COD_PROV,$NOM_PROV,$DIR_PROV,$TEL_PROV,$PAIS_PROV,$ID){	$this->COD_PROV=$COD_PROV;	$this->NOM_PROV=$NOM_PROV;	$this->DIR_PROV=$DIR_PROV;	$this->TEL_PROV=$TEL_PROV;	$this->PAIS_PROV=$PAIS_PROV;	$this->ID=$ID;	}function insertar() { $consulta="INSERT INTO(COD_PROV,NOM_PROV,DIR_PROV,TEL_PROV,PAIS_PROV,ID)values('".$this->COD_PROV."','".$this->NOM_PROV."','".$this->DIR_PROV."','".$this->TEL_PROV."','".$this->PAIS_PROV."','".$this->ID."')"; return $this->CON->manipular($consulta);}function rellenar($resultado){
        if ($resultado->num_rows > 0) {
            $lista=array();
            while($row = $resultado->fetch_assoc()) {	$proveedores_mysql= new PROVEEDORES_MYSQL("");		$proveedores_mysql->COD_PROV=$row["COD_PROV"] ==null?"":$row["COD_PROV"];		$proveedores_mysql->NOM_PROV=$row["NOM_PROV"] ==null?"":$row["NOM_PROV"];		$proveedores_mysql->DIR_PROV=$row["DIR_PROV"] ==null?"":$row["DIR_PROV"];		$proveedores_mysql->TEL_PROV=$row["TEL_PROV"] ==null?"":$row["TEL_PROV"];		$proveedores_mysql->PAIS_PROV=$row["PAIS_PROV"] ==null?"":$row["PAIS_PROV"];		$proveedores_mysql->ID=$row["ID"] ==null?"":$row["ID"];		$lista[]=$proveedores_mysql;};	return $lista;}	else{
            return null;
        }}function todo(){
        $consulta="select * from proveedores_mysql";
        $result=$this->CON->consulta($consulta);
        return $this->rellenar($result);
    }function buscarXID($id){
        $consulta="select * from proveedores_mysql where ID=".$id;
        $result=$this->CON->consulta($consulta);
        $proveedores_mysql=$this->rellenar($result);
        if($proveedores_mysql==null){
            return null;
        }
        return $this->rellenar($result);
    }}