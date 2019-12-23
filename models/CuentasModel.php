<?php

class CuentasModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function getAll(){
        $sql = "SELECT * FROM cuentas";
        return $this->selectAll($sql);
    }

    public function get($col,$where){
        $sql = "SELECT ".$this->getKeysArray($data)." FROM cuentas ";
        echo $sql .= "WHERE ".$this->getKeysArrayPDO($where);
        //return $this->select($sql,$where);
    }

    public function set($data){
        $sql = "INSERT INTO cuentas (".$this->getKeysArray($data).")";
        $sql .=" VALUES (".$this->getKeysArrayPDO($data).")";
        return $this->insert($sql,$this->getFormatDataPDO($data));
    }   

    public function put($datos){
        //print_r($_POST);
    }

    public function del(){

    }

}