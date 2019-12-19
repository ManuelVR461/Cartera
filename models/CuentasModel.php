<?php

class CuentasModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function getCuentas(){
        return $data =array("cuenta"=>"prueba","saldo"=>5000);
        //$sql = "SELECT * FROM cuentas WHERE 1";
        //return $this->select($sql);
    }


    
    public function setCuentas(){
        
    }
}