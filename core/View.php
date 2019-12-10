<?php

class View extends Config{

    protected $controller;
    protected $method;
    protected $params;

    public function __construct($controller="Home",$method=null){
        $this->controller=$controller;
        $this->method=$method;
    }

    public function render(){
        $controller = $this->controller."Controller";
        $view = strtolower($this->controller);
        
        require_once( self::VIEW_PATH.'templates/header.php');

        if($_SESSION['datalogin']['ingreso']){
            require_once( self::VIEW_PATH.'templates/nav-hor.php');
            require_once( self::VIEW_PATH.'templates/nav-vert.php');
        }

        

        if(file_exists(self::VIEW_PATH.$view.'.php')){
            
            if(file_exists(self::CONTROLLER_PATH.$controller.'.php')){
                $ViewController = new $controller;
                if(isset($this->method)){
                    if(method_exists($ViewController,$this->method)){
                        $ViewController->{$this->method}();
                    }else{
                        echo "<br><br><br><h1>Error no existe el metodo</h1>";
                    }
                }else{
                    require_once( self::VIEW_PATH.$view.'.php');
                }
            }
        }else{
            require_once( self::VIEW_PATH.'404.php');
        }

        require_once( self::VIEW_PATH.'templates/footer.php');
    }

    public function viewList(){
        if(file_exists(self::LIST_PATH.$this->controller.'List.php')){
            $uri_list = self::LIST_PATH.$this->controller."List.php";
            if(is_file($uri_list)){
                ob_start();
                include $uri_list;
                $table = ob_get_clean();
            }
            return $table;
        }else{
            return "<h1>No Existe una Lista Asociada a este controlador!</h1>";
        }
    }

    public function __get( string $var ){
        return $this->$var;
    }

}