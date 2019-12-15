<?php
class Model extends Config {
    protected $cnx;
    protected $sql;
    protected $rows = array();
        
    public function __construct(){
        parent::__construct();
        $this->cnx = $this->conexion();
    }
    /**
     * Metodo protegido para la abrir la base de datos
     *
     * @return void
     */
    protected function conexion(){
        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => FALSE,
            ];
            return new PDO(parent::SGBD,parent::USER,parent::PASS,$options);
        } catch (PDOException $e) {
            echo "Error: ".$e;
            die();
        }
    }
    /**
     * encrypter
     * Funcion para Encryptar las claves de Accesos
     * 
     * @param  mixed $string
     * @return void
     */
    protected static function encrypter($string){
        $output=FALSE;
        $key=hash('sha256', parent::SECRET_KEY);
        $iv=substr(hash('sha256', parent::SECRET_IV), 0, 16);
        $output=openssl_encrypt($string, parent::METHOD, $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
    }
    
    /**
     * decryption
     * Funcion para Desencryptar las claves de accesos
     * @param  mixed $string
     *
     * @return void
     */
    protected static function decryption($string){
        $key=hash('sha256', parent::SECRET_KEY);
        $iv=substr(hash('sha256', parent::SECRET_IV), 0, 16);
        $output=openssl_decrypt(base64_decode($string), parent::METHOD, $key, 0, $iv);
        return $output;
    }

    /** Ejecuta una consulta y devuelve un resultado.
	* @param String $sql		Texto de la consulta.
	* @param String $dataBase	Nombre de la Base de datos a la cual se conectará, por defecto es la indicada en
	* @return Array $result
	*
	*/
	public function select($sql,$where = array()){
        $ti = microtime(true);
        $res = $this->cnx->prepare($sql);
        $res->execute($where);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $res->closeCursor();
        $this->cnx = NULL;
		$tf = microtime(true);
		self::_log($ti,$tf,$sql,$row);
		return $row;
    }
    
    /**
	* Graba log con datos de tiempo de ejecución de consulta
	* @param string	$consulta	sentencia SQL ejecutada
	* @param arry	$resultado	resultado de la sentencia ejecutada
	* @param int	$ti			tiempo en microsegundos antes de ejecutar la consulta
	* @param int	$tf			tiempo en microsegundos después de ejecutar la consulta
	*/
	private static function _log($ti=0,$tf=0,$consulta='',$resultado=null){
		$sep = '||';
		$str = self::$_host.$sep.round($tf-$ti,2).$sep.$consulta.$sep.json_encode($resultado);
		dbg($str,'debug_db_'.date('Ymd').'.log',DEBUG_DB);
    }
    
}