<?php

/**
 * CORRELATIVOS.class.php
 * 
 **/
class PRINTERSETTING {

	public static $DATABASE_NAME = 'posgourmet';
	public static $TABLE_NAME = 'printersetting';



/*
create table printersetting(
        id int primary key  AUTO_INCREMENT,
        ipcliente varchar(30)
)
*/
public $CONN;
	public $id ;
	public $printersetting ;

function PRINTERSETTING($con) {$this->CON=$con;}

	function contructor($id,$printersetting){
	$this->id=$id;
	$this->printersetting=$printersetting;

	}

function insertar() { 
$consulta="INSERT INTO(id,printersetting)values('".$this->id."','".$this->printersetting."')";
 return $this->CON->manipular($consulta);}

function rellenar($resultado){
    $printer="";
        if (count($resultado) > 0) {
            $lista=array();
            while($row = $resultado->fetch_assoc()) {
	$printer= new PRINTERSETTING("");

		$printer->id=$row["id"] ==null?"":$row["id"];
		$printer->printersetting=$row["ipcliente"] ==null?"":$row["ipcliente"];
	
		$lista[]=$printer;};
	return $lista;}
	else{
            return null;
        }
    }

function todo(){
        $consulta="select * from printersetting";
        $result=$this->CON->consulta($consulta);
        $printersetting=$this->rellenar($result);
        if($printersetting==null){
            return "";
        }
        return $printersetting;
    }


    function mostrarUltimo(){
    	  $consulta="select * from printersetting limit 1";
        $result=$this->CON->consulta($consulta);
        $printersetting=$this->rellenar($result);
        if($printersetting==null){
            return "";
        }
        return $printersetting;
    }

}
