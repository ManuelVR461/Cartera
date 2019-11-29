<?php

class CuentasController extends Controller {
    public function __construct(){
        $cuentas = new CuentasModel;
    }

    public function listarCuentas(){
        $post = array("cuenta"=>$_POST['txtcuenta'],"saldo"=>$_POST['txtsaldo'],"mensaje"=>$_POST['mensaje']);
        echo $post;
    }
}