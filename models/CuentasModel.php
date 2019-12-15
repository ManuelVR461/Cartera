<?php

class CuentasModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function getCuentas(){
        $sql = "SELECT * FROM cuentas WHERE 1";
        return $this->select($sql);
    }


    
    public function setCuentas(){
        
    }
}