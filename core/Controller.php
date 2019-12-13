  
<?php
class Controller extends Config{
    public function __construct(){
        parent::__construct();
    }
    
    public function __set( string $var, $val ){
        $this->$var = $val;
    }
    
    public function __get( string $var ){
        return $this->$var;
    }
    public function __toString(){
        return "nombre del controller";
    }
    
    function is_post(){
        return ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST) && !empty($_POST));
    }

}