<?php

class CuentasController extends Controller {
    public function __construct(){
        $cuentas = new CuentasModel;
    }

    public function listarCuentas(){
        if($_POST){
            
            //ojo: Crear funcion para limpiar contenido de post

            $datos = array("cuenta"=>$_POST['txtcuenta'],"saldo"=>$_POST['txtsaldo'],"mensaje"=>$_POST['mensaje']);
            if( $datos != null ){
                $lista = View::viewlist($_POST['controller']);
                echo $lista;
            }else{ 
                return 'No existen registros'; 
            }
            //echo json_encode($datos)
        }else{
            return false;
        }
        
    }
}