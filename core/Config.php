<?php
class Config{
    const APP_VERSION = '1.000'; //Version de la Aplicacion
    const APP_DATE_VERSION = '27-12-2019';
    const APP_DEVELOPER= 'Ing. Manuel Ramirez (ManuelVR461@gmail.com)';

    const APP="cartera"; //Nombre del Proyecto
    const DRIVER_DB = "PDO"; //Driver de conexion con base de Datos //PDO,MYSQL,POSTGRESS,SQLSERVER,SQLITE
    const DB_NAME="db_Cartera";
    const USER = "mramirez"; //Usuario de Base de Datos
    const PASS = "@mramirez123"; //Password de Base de Datos
    const SECRET_KEY='CentralOnline@2019'; //Clave Secreta de Encryptcion
    const SECRET_IV='123456'; //Clave Publica de Desencryptacion

    const DEBUG_GN=1;//1:activado,0:Desactivado Log de errores Generales
    const DEBUG_DB=1;//1:activado,0:Desactivado Log de Errores Base de Datos

    const SERVER ="localhost";
    const CHARSET = "utf8";
    const URL = "http://".self::SERVER."/".self::APP."/";

    const SGBD = "mysql:host=".self::SERVER.";dbname=".self::DB_NAME.";charset=".self::CHARSET;
    const METHOD="AES-256-CBC";
    
    const CONTROLLER_PATH = './controllers/';
    const MODEL_PATH = './models/';
    const VIEW_PATH = './views/';
    const LIST_PATH = './views/lists/';
    const LOGS_PATH = './logs/';

    public function __construct(){
        date_default_timezone_set('America/Santiago');
    }
    
}