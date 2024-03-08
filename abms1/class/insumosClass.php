<?php

/**
 * 
 */
class insumosClass {

    public $id;
    public $cod_ins;
    public $nom_insumo;
    public $stock_min;
    public $stock_act;
    public $medida;
    public $medidaM;
    public $insumo;
    public $adicionado;
    public $can_adi;
    public $estado;
    public $ope_mx;
    public $ope_mm;
    public $CON;

    function insumo($con) {
        $this->CON = $con;
    }

    function contructor($id, $cod_ins, $nom_insumo, $stock_min, $stock_act, $medida, $medidaM, $insumo, $adicionado, $can_adi, $estado, $ope_mx, $ope_mm) {
        $this->id = $id;
        $this->cod_ins = $cod_ins;
        $this->nom_insumo = $nom_insumo;
        $this->estado = $estado;
        $this->stock_min = $stock_min;
        $this->insumo = $insumo;
        $this->stock_act = $stock_act;
        $this->medida = $medida;
        $this->adicionado = $adicionado;
        $this->can_adi = $can_adi;
        $this->medidaM = $medidaM;
        $this->ope_mx = $ope_mx;
        $this->ope_mm = $ope_mm;
    }

    function rellenar($resultado) {
        if ($resultado->num_rows > 0) {
            $lista = array();
            while ($row = $resultado->fetch_assoc()) {
                $insumo = new insumo("");
                $insumo->id = $row['ID'] == null ? "" : $row['ID'];
                $insumo->cod_insumo = $row['COD_insumo'] == null ? "" : $row['COD_insumo'];
                $insumo->nom_insumo = $row['NOM_insumo'] == null ? "" : $row['NOM_insumo'];
                $insumo->estado = $row['ESTADO'] == null ? "" : $row['ESTADO'];
                $insumo->insumo = $row['insumo'] == null ? "" : $row['insumo'];


                // $provedor->Contacto = $row['Contacto'] == null ? "" : $row['Contacto'];
                // $provedor->Telefono_Contacto = $row['Telefono_Contacto'] == null ? "" : $row['Telefono_Contacto'];
                // $provedor->sucursal_id = $row['sucursal_id'] == null ? "" : $row['sucursal_id'];
                $lista[] = $insumo;
            }
            return $lista;
        } else {
            return null;
        }
    }

    function ListarDadaId($id) {
       $consulta = "select *from insumo_mysql where id=$id";
        $result = $this->CON->consulta($consulta);
        $producto = $this->rellenar($result);
        if ($producto == null) {
            return null;
        }
        return $producto[0];
    }

    function insertar() {
        $consulta = "insert into insumo_mysql(ID, NOM_insumo,  ESTADO, COLORES, ORDEN) values(0,'" . $this->nom_insumo . "','" . $this->estado . "','" . $this->colores . "'," . $this->orden . ")";
        if (!$this->CON->manipular($consulta))
            return 0;
        $consulta = "SELECT LAST_INSERT_ID() as id";
        $resultado = $this->CON->consulta($consulta);
        return $resultado->fetch_assoc()['id'];
    }

    function modificar($id) {
        $consulta = "update insumo_mysql set  nom_prod ='" . $this->nom_prod . "', cantidad ='" . $this->cantidad . "', pre_venta ='" . $this->pre_venta . "',  colores ='" . $this->colores . "', disponible ='" . $this->disponible . "', barcode ='" . $this->barcode . "', insumo =" . $this->insumo . ", familia ='" . $this->familia . "' where id=" . $id;
        return $this->CON->manipular($consulta);
    }

    function modificarCodigoinsumo($id) {
        $consulta = "update insumo_mysql set  COD_insumo ='" . $this->cod_insumo . "', insumo =" . $this->insumo . " where id=" . $id;
        return $this->CON->manipular($consulta);
    }

    function todo() {
        $consulta = "select * from insumo_mysql order by ID desc";
        $result = $this->CON->consulta($consulta);
        return $this->rellenar($result);
    }

}

?>