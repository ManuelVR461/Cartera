<?php
class Controller extends Config{
    protected $functions;

    public function __construct(){
        parent::__construct();
        $this->functions = new Functions; 
    }
    
    public function __set( string $var, $val ){
        $this->$var = $val;
    }
    
    public function __get( string $var ){
        return $this->$var;
    }

    protected static function clearString($string){
        //$string = trim($string); //Quita los espacios delante y destras de la cadena
        // $string = stripcslashes($string); // quita las barras invertidas de un string
        // $string = str_ireplace("<script>","",$string);
        // $string = str_ireplace("</script>","",$string);
        // $string = str_ireplace("<script src","",$string);
        // $string = str_ireplace("<script type=","",$string);
        // $string = str_ireplace("SELECT * FROM","",$string);
        // $string = str_ireplace("DELETE FROM","",$string);
        // $string = str_ireplace("INSERT INTO","",$string);
        // $string = str_ireplace("--","",$string);
        // $string = str_ireplace("^","",$string);
        // $string = str_ireplace("[","",$string);
        // $string = str_ireplace("]","",$string);
        // $string = str_ireplace("==","",$string);
        // $string = str_ireplace(";","",$string);
        return $string;
    }

    /**
     * sweet_alert
     * Mensajes de alertas Personalizados
     * Types: warning, error, success, info, and question
     *
     * @param  mixed $datos
     *
     * @return void
     */
    protected static function sweet_alert($datos){
        if($datos['alerta']=="simple"){
            $alerta="
                <script>
                    swal(
                        '".$datos['titulo']."',
                        '".$datos['texto']."',
                        '".$datos['tipo']."'
                    );
                </script>
            ";
        }else if($datos['alerta']=="recarga"){
            $alerta="
                <script>
                    Swal.fire({
                        title:'".$datos['titulo']."',
                        text:'".$datos['texto']."',
                        type: '".$datos['tipo']."', 
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        location.reaload();
                    });
                </script>
            ";
        }else if($datos['alerta']=="limpiar"){
            $alerta="
                <script>
                    Swal.fire({
                        title:'".$datos['titulo']."',
                        text:'".$datos['texto']."',
                        type: '".$datos['tipo']."',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        $('.formAjax')[0].reset();
                    });
                </script>
            ";
        }
        return $alerta;
    }

    public static function getNameController(){
        return explode("=",basename($_SERVER['QUERY_STRING']))[1];
    }

    function is_post(){
        $this->functions->dbg("datos post ".json_encode($_SERVER["REQUEST_METHOD"]),"Controller");
        return ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST) && !empty($_POST));
    }
    function is_get(){
        $this->functions->dbg("datos post ".json_encode($_SERVER["REQUEST_METHOD"]),"Controller");
        return ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET) && !empty($_GET));
    }

}