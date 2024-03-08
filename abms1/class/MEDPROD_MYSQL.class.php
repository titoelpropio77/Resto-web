<?php/** * MEDPROD_MYSQL.class.php *  **/class MEDPROD_MYSQL {	public static $DATABASE_NAME = 'posgourmet';	public static $TABLE_NAME = 'medprod_mysql';public $CONN;	public $id ;	public $cod_prod ;	public $nom_prod ;	public $presentacion ;function MEDPROD_MYSQL($con) {$this->CON=$con;}	function contructor($id,$cod_prod,$nom_prod,$presentacion){	$this->id=$id;	$this->cod_prod=$cod_prod;	$this->nom_prod=$nom_prod;	$this->presentacion=$presentacion;	}function insertar() { $consulta="INSERT INTO(id,cod_prod,nom_prod,presentacion)values('".$this->id."','".$this->cod_prod."','".$this->nom_prod."','".$this->presentacion."')"; return $this->CON->manipular($consulta);}function rellenar($resultado){
        if ($resultado->num_rows > 0) {
            $lista=array();
            while($row = $resultado->fetch_assoc()) {	$medprod_mysql= new MEDPROD_MYSQL("");		$medprod_mysql->id=$row["id"] ==null?"":$row["id"];		$medprod_mysql->cod_prod=$row["cod_prod"] ==null?"":$row["cod_prod"];		$medprod_mysql->nom_prod=$row["nom_prod"] ==null?"":$row["nom_prod"];		$medprod_mysql->presentacion=$row["presentacion"] ==null?"":$row["presentacion"];		$lista[]=$medprod_mysql;};	return $lista;}	else{
            return null;
        }}function todo(){
        $consulta="select * from medprod_mysql";
        $result=$this->CON->consulta($consulta);
        return $this->rellenar($result);
    }function buscarXID($id){
        $consulta="select * from medprod_mysql where ID=".$id;
        $result=$this->CON->consulta($consulta);
        $medprod_mysql=$this->rellenar($result);
        if($medprod_mysql==null){
            return null;
        }
        return $this->rellenar($result);
    }}