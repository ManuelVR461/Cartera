<?php

class CuentasController extends Controller {
    public function __construct(){
        parent::__construct();
        $cuentasModel = new CuentasModel;
    }

    public function listarCuentas(){
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
            
        }
    }

}