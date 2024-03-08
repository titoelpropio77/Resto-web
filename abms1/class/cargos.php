<?php
require_once 'conexion.php';
class Cargos extends Conexion {
    public $mysqli;
    public $data;
    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }
    //*****************************************************************
    // LISTADO DE CARGOS
    //*****************************************************************
    public function cargos(){
        $resultado = $this->mysqli->query("SELECT * FROM relprogru_mysql");
        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }
        if (isset($data)) {
            return $data; 
        }         
    }
}
?>