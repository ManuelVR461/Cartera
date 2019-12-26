<?php

class CuentasController extends Controller {

    public function __construct(){
        parent::__construct();
    }

    public function obtenerCuenta(){
        if($this->is_get()){
            $cuentasModel = new CuentasModel;
            $data = array("id"=>$_GET['id']);
            $datos = $cuentasModel->get($data);
            echo json_encode($datos);
        }
    }

    public function listarCuentas(){
        $cuentasModel = new CuentasModel;
        if($this->is_post()){
            //ojo: Crear funcion para limpiar contenido de post
            $datos = $cuentasModel->getAll();
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
            $data = array('descripcion' => $_POST['txtcuenta'],
                          'saldo_inicial' => $_POST['txtsaldo'],
                          'signo_moneda' => '$',
                          'fecha' => date('Y-m-d'));
            $cuentasModel->set($data);
            $this->listarCuentas();
        }
    }

    public function borrarCuenta(){
        $cuentasModel = new CuentasModel;
        $data = array("id"=>$_GET['id']);
        $datos = $cuentasModel->del($data);
        $this->listarCuentas();
        echo json_encode($datos);
    }

}