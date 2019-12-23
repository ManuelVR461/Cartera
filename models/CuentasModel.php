<?php

class CuentasModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function get_Cuentas(){
        echo "Lista de Cuentas";
        //return $data =array("cuenta"=>"prueba","saldo"=>5000);
        //$sql = "SELECT * FROM cuentas WHERE 1";
        //return $this->select($sql);
    }

    public function set_Cuenta(){
        echo "estoy en model";
        print_r($_POST);
    }

    public function put_Cuenta(){

    }

    public function del_Cuenta(){

    }

}