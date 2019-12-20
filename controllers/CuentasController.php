<?php

class CuentasController extends Controller {

    public function __construct(){
        parent::__construct();
    }

    public function listarCuentas(){
        $cuentasModel = new CuentasModel;
        echo "entreee";
        $this->functions->dbg("linea 12 ".print_r($_POST),"ListarCuentas");
        if($this->is_post()){
            //ojo: Crear funcion para limpiar contenido de post
            $datos = $cuentasModel->getCuentas();
            $this->functions->dbg("Datos ".print_r($datos)." en controller ".$_POST['controller'],"ListarCuentas");
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
        //if($this->is_post()){
            $this->functions->dbg("Datos ".print_r($_POST),"CrearCuentas");
        //}
    }

}