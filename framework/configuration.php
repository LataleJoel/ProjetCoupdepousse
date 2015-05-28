<?php
defined('__FRAMEWORK3IL__') or die('Access Interdit');
class Configuration{
    private static $_instance=null;
    private $data=null;
    public function __construct($fichierIni){
      if(!is_readable($fichierIni)){
          die('Fichier de configuration Manquant.');
      } 
      $this->data=  parse_ini_file($fichierIni);
      if(!$this->data){
          die('Fichier de configuration invalide');
      }
    }
    public static function getInstance($fichierIni='application\configuration.ini'){
        if(is_null(self::$_instance)){
            self::$_instance=new Configuration($fichierIni);
        }
        return self::$_instance;
    }
     public function __get($propriete){
        if(!isset($this->data[$propriete])){
         die("Propriete de configuration inconnue: ".$propriete);   
        }
        return $this->data[$propriete];
    }
}


