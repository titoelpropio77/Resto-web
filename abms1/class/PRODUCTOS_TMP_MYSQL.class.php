<?php/** * PRODUCTOS_TMP_MYSQL.class.php *  **/class PRODUCTOS_TMP_MYSQL {	public static $DATABASE_NAME = 'posgourmet';	public static $TABLE_NAME = 'productos_tmp_mysql';public $CONN;	public $ID ;	public $COD_PROD ;	public $USUARIO ;	public $CANTIDAD ;function PRODUCTOS_TMP_MYSQL($con) {$this->CON=$con;}	function contructor($ID,$COD_PROD,$USUARIO,$CANTIDAD){	$this->ID=$ID;	$this->COD_PROD=$COD_PROD;	$this->USUARIO=$USUARIO;	$this->CANTIDAD=$CANTIDAD;	}function insertar() { $consulta="INSERT INTO(ID,COD_PROD,USUARIO,CANTIDAD)values('".$this->ID."','".$this->COD_PROD."','".$this->USUARIO."','".$this->CANTIDAD."')"; return $this->CON->manipular($consulta);}function rellenar($resultado){
        if ($resultado->num_rows > 0) {
            $lista=array();
            while($row = $resultado->fetch_assoc()) {	$productos_tmp_mysql= new PRODUCTOS_TMP_MYSQL("");		$productos_tmp_mysql->ID=$row["ID"] ==null?"":$row["ID"];		$productos_tmp_mysql->COD_PROD=$row["COD_PROD"] ==null?"":$row["COD_PROD"];		$productos_tmp_mysql->USUARIO=$row["USUARIO"] ==null?"":$row["USUARIO"];		$productos_tmp_mysql->CANTIDAD=$row["CANTIDAD"] ==null?"":$row["CANTIDAD"];		$lista[]=$productos_tmp_mysql;};	return $lista;}	else{
            return null;
        }}function todo(){
        $consulta="select * from productos_tmp_mysql";
        $result=$this->CON->consulta($consulta);
        return $this->rellenar($result);
    }function buscarXID($id){
        $consulta="select * from productos_tmp_mysql where ID=".$id;
        $result=$this->CON->consulta($consulta);
        $productos_tmp_mysql=$this->rellenar($result);
        if($productos_tmp_mysql==null){
            return null;
        }
        return $this->rellenar($result);
    }}