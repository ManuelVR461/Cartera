<?php

class CuentasModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function setCuenta(){
        $sql = "SELECT "
        $row = $res->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCuentas(){
        
    }
}