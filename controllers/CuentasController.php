<?php

class CuentasController extends Controller {

    public function __construct(){
        parent::__construct();
    }

    public function listarCuentas(){
        $cuentasModel = new CuentasModel;
        if($this->is_post()){
            //ojo: Crear funcion para limpiar contenido de post
            $datos = $cuentasModel->getCuentas();
            if( $datos != null ){
                $lista = View::viewlist($_POST['controller'],$datos);
                echo $lista;
            }else{ 
                return 'No existen registros'; 
            }
            //echo json_encode($datos)
        }else{
            return false;
        }
        
    }

    public function crearCuentas(){
        if($this->is_post()){
            $cuentasModel = new CuentasModel;
            $cuentasModel->setCuentas();
            
            //$this->functions->dbg("Datos ".print_r($_POST),"CrearCuentas");
        }
    }

}