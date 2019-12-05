<?php

class CuentasController extends Controller {
    public function __construct(){
        $cuentas = new CuentasModel;
    }

    public function listarCuentas(){
        $datos = array("cuenta"=>$_POST['txtcuenta'],"saldo"=>$_POST['txtsaldo'],"mensaje"=>$_POST['mensaje']);
        if( $datos != null ){
            $uri_list = self::LIST_PATH."CuentasList.php";
            if(is_file($uri_list)){
                ob_start();
                include $uri_list;
                $table = ob_get_clean();
            }
        }else{ 
            return 'No existen registros'; 
        }
        echo $table;
    }
}