<?php/** * CORRELATIVOS.class.php *  **/class CORRELATIVOS {	public static $DATABASE_NAME = 'posgourmet';	public static $TABLE_NAME = 'correlativos';public $CONN;	public $id ;	public $tabla ;	public $folio ;	public $folior ;	public $ordendia ;    public $imprimir ;    public $multcon ;	public $mult ;function CORRELATIVOS($con) {$this->CON=$con;}	function contructor($id,$tabla,$folio,$folior,$ordendia, $imprimir,$multcon,$mult){	$this->id=$id;	$this->tabla=$tabla;	$this->folio=$folio;	$this->folior=$folior;	$this->ordendia=$ordendia;    $this->imprimir=$imprimir;    $this->multcon=$multcon;	$this->mult=$mult;	}function insertar() { $consulta="INSERT INTO(id,tabla,folio,folior,ordendia)values('".$this->id."','".$this->tabla."','".$this->folio."','".$this->folior."','".$this->ordendia."')"; return $this->CON->manipular($consulta);}function rellenar($resultado){        if (count($resultado) > 0) {            $lista=array();            while($row = $resultado->fetch_assoc()) {	$correlativos= new CORRELATIVOS("");		$correlativos->id=$row["id"] ==null?"":$row["id"];		$correlativos->tabla=$row["tabla"] ==null?"":$row["tabla"];		$correlativos->folio=$row["folio"] ==null?"":$row["folio"];		$correlativos->folior=$row["folior"] ==null?"":$row["folior"];		$correlativos->ordendia=$row["ordendia"] ==null?"":$row["ordendia"];        $correlativos->imprimir=$row["imprimir"] ==null?"":$row["imprimir"];        $correlativos->multcon=$row["multcon"] ==null?"0":$row["multcon"];		$correlativos->mult=$row["mult"] ==null?"":$row["mult"];		$lista[]=$correlativos;};	return $lista;}	else{            return null;        }}function todo(){        $consulta="select * from correlativos";        $result=$this->CON->consulta($consulta);        return $this->rellenar($result);    }function buscarXID($id){        $consulta="select * from correlativos where ID=".$id;        $result=$this->CON->consulta($consulta);        $correlativos=$this->rellenar($result);        if($correlativos==null){            return null;        }        return $this->rellenar($result);    }    function mostrarUltimo($tabla){    	  $consulta="select * from correlativos where tabla='".$tabla."'";        $result=$this->CON->consulta($consulta);        $correlativos=$this->rellenar($result);        if($correlativos==null){            return null;        }        return $correlativos;    }    function modificarFr($tabla,$ultimofolio,$ultimorondedia){     	$consulta="update correlativos    	set folio=".$ultimofolio."     	,  folior=".$ultimofolio."     	, ordendia=".$ultimorondedia."     	where tabla='".$tabla."'";    	$resultado=$this->CON->manipular($consulta);    	return $resultado;    }       function modificarF($tabla,$ultimofolior,$ultimorondedia){     	$consulta="update correlativos    	set folior=".$ultimofolior."     	    	, ordendia=".$ultimorondedia."     	where tabla='".$tabla."'";    	$resultado=$this->CON->manipular($consulta);    	return $resultado;    }           function modificarFi($tabla,$ultimofolio,$ultimorondedia){                $consulta="update correlativos        set folio=".$ultimofolio."              , ordendia=".$ultimorondedia."         where tabla='".$tabla."'";        $resultado=$this->CON->manipular($consulta);        return $resultado;    }    function modificarOrden(){         $consulta="update correlativos        set ordendia=0";        $resultado=$this->CON->manipular($consulta);        return $resultado;    }    function modificarFyFr($tabla,$ultimofolio,$ultimofolior){        $consulta="update correlativos        set folio=".$ultimofolio."              , folior=".$ultimofolior."          where tabla='".$tabla."'";        $resultado=$this->CON->manipular($consulta);        return $resultado;    }    function contadorMul($nombreTabla, $cont){         $consulta="update correlativos        set multcon=".$cont."             where tabla='".$nombreTabla."'";        $resultado=$this->CON->manipular($consulta);        return $resultado;    }    function modificarTodoMul($nombreTabla,$ultimofolio,$contador){         $consulta="update correlativos        set multcon=".$contador."               ,folio=".$ultimofolio."              , folior=".$ultimofolio."          where tabla='".$nombreTabla."'";        $resultado=$this->CON->manipular($consulta);        return $resultado;    }}