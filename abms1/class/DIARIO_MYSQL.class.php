<?php/** * DIARIO_MYSQL.class.php * DIARIO **/class DIARIO_MYSQL {	public static $DATABASE_NAME = 'posgourmet';	public static $TABLE_NAME = 'diario_mysql';public $CONN;	/**	 * @var CODSIS	 */	public $CODSIS ;	/**	 * @var NOMBRES	 */	public $NOMBRES ;	/**	 * @var APELLIDOS	 */	public $APELLIDOS ;	/**	 * @var HORAINGMA	 */	public $HORAINGMA ;	/**	 * @var HORASAMA	 */	public $HORASAMA ;	/**	 * @var HORAINGTA	 */	public $HORAINGTA ;	/**	 * @var HORASALTA	 */	public $HORASALTA ;	/**	 * @var FECHADIA	 */	public $FECHADIA ;	/**	 * @var RETRAZOM	 */	public $RETRAZOM ;	/**	 * @var RETRAZOT	 */	public $RETRAZOT ;	/**	 * @var TOTEFDEMIN	 */	public $TOTEFDEMIN ;	public $ID ;function DIARIO_MYSQL($con) {$this->CON=$con;}	function contructor($CODSIS,$NOMBRES,$APELLIDOS,$HORAINGMA,$HORASAMA,$HORAINGTA,$HORASALTA,$FECHADIA,$RETRAZOM,$RETRAZOT,$TOTEFDEMIN,$ID){	$this->CODSIS=$CODSIS;	$this->NOMBRES=$NOMBRES;	$this->APELLIDOS=$APELLIDOS;	$this->HORAINGMA=$HORAINGMA;	$this->HORASAMA=$HORASAMA;	$this->HORAINGTA=$HORAINGTA;	$this->HORASALTA=$HORASALTA;	$this->FECHADIA=$FECHADIA;	$this->RETRAZOM=$RETRAZOM;	$this->RETRAZOT=$RETRAZOT;	$this->TOTEFDEMIN=$TOTEFDEMIN;	$this->ID=$ID;	}function insertar() { $consulta="INSERT INTO(CODSIS,NOMBRES,APELLIDOS,HORAINGMA,HORASAMA,HORAINGTA,HORASALTA,FECHADIA,RETRAZOM,RETRAZOT,TOTEFDEMIN,ID)values('".$this->CODSIS."','".$this->NOMBRES."','".$this->APELLIDOS."','".$this->HORAINGMA."','".$this->HORASAMA."','".$this->HORAINGTA."','".$this->HORASALTA."','".$this->FECHADIA."','".$this->RETRAZOM."','".$this->RETRAZOT."','".$this->TOTEFDEMIN."','".$this->ID."')"; return $this->CON->manipular($consulta);}function rellenar($resultado){
        if ($resultado->num_rows > 0) {
            $lista=array();
            while($row = $resultado->fetch_assoc()) {	$diario_mysql= new DIARIO_MYSQL("");		$diario_mysql->CODSIS=$row["CODSIS"] ==null?"":$row["CODSIS"];		$diario_mysql->NOMBRES=$row["NOMBRES"] ==null?"":$row["NOMBRES"];		$diario_mysql->APELLIDOS=$row["APELLIDOS"] ==null?"":$row["APELLIDOS"];		$diario_mysql->HORAINGMA=$row["HORAINGMA"] ==null?"":$row["HORAINGMA"];		$diario_mysql->HORASAMA=$row["HORASAMA"] ==null?"":$row["HORASAMA"];		$diario_mysql->HORAINGTA=$row["HORAINGTA"] ==null?"":$row["HORAINGTA"];		$diario_mysql->HORASALTA=$row["HORASALTA"] ==null?"":$row["HORASALTA"];		$diario_mysql->FECHADIA=$row["FECHADIA"] ==null?"":$row["FECHADIA"];		$diario_mysql->RETRAZOM=$row["RETRAZOM"] ==null?"":$row["RETRAZOM"];		$diario_mysql->RETRAZOT=$row["RETRAZOT"] ==null?"":$row["RETRAZOT"];		$diario_mysql->TOTEFDEMIN=$row["TOTEFDEMIN"] ==null?"":$row["TOTEFDEMIN"];		$diario_mysql->ID=$row["ID"] ==null?"":$row["ID"];		$lista[]=$diario_mysql;};	return $lista;}	else{
            return null;
        }}function todo(){
        $consulta="select * from diario_mysql";
        $result=$this->CON->consulta($consulta);
        return $this->rellenar($result);
    }function buscarXID($id){
        $consulta="select * from diario_mysql where ID=".$id;
        $result=$this->CON->consulta($consulta);
        $diario_mysql=$this->rellenar($result);
        if($diario_mysql==null){
            return null;
        }
        return $this->rellenar($result);
    }}