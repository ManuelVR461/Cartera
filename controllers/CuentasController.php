<?php

class CuentasController extends Controller {

    public function __construct(){
        parent::__construct();
        $cuentasModel = new CuentasModel;
    }

    public function listarCuentas(){
        echo "entreee";
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
        $this->functions->dbg("Datos en crear","CuentasController.log");
        if($this->is_post()){
            $this->functions->dbg("Datos en crear ".json_encode($_REQUEST),"CuentasController.log");
        }
    }

}