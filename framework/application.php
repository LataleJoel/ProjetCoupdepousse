<?php
session_start();
define('__FRAMEWORK3IL__','');
require_once 'framework/message.php';
require_once 'framework/helpers/form.helper.php';
require_once 'framework/authentification.php';
require_once 'framework/configuration.php';
require_once 'framework/helpers/http.helper.php';
require_once 'framework/helpers/html.helper.php';
require_once 'framework/controller.php';
require_once 'framework/erreur.php';
require_once 'framework/page.php';
require_once 'framework/model.php';
require_once 'application/controllers/index.controller.php';
require_once 'application/helpers/navigation.helper.php';
class Application{

    private static $cheminAbsolu='';
    private static $controlleurCourant;
    private static $actionCourante;
    protected $controleurParDefaut='';
    private $base=null;
    private static $_instance=null;
    private $configuration=null;
   // private static $controlInst=null;
    private  function __construct($fichierIni){
        $this->cheminAbsolu=  realpath('.');
        $this->configuration= Configuration::getInstance($fichierIni);
        try{
            $this->base=new PDO('mysql:host=localhost;dbname=coupdepouce','root','');
} catch (PDOException $ex) {
    die("Erreur de connexion BD".$ex);
   
}
$this->base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    public static function getDB(){
       return self::$_instance->base;
    }
/**
 * retourne l'instance de l'application
 * @param string $fichierIni
 * @return Application
 */
    public static function getInstance($fichierIni){
        if(is_null(self::$_instance)){
            self::$_instance=new Application($fichierIni='application\configuration.ini');
          
        }
        return self::$_instance;
    }
    
    public static function getconfig(){
        return self::$_instance->configuration;
    }  
    public function executer(){
       $this->setControleurParDefaut('index');
       $controller=HTTPHelper::get('controller',$this->getControleurParDefaut());
       //$contr=  $this->getControleurParDefaut();
       
        $chemin='application/controllers/'.$controller.'.controller.php';
        if(!is_readable($chemin)){
            throw new Erreur('Fichier De Controleur Introuvable '.$controller);
        }
        else{
                require_once 'application/controllers/'.$controller.'.controller.php';
        }
        
    
        $NomClass=  ucfirst($controller).'Controller';
        if(!class_exists($NomClass)){
            die('Classe Introuvable '.$NomClass);
        }
        else{
            
           $ClassInstance=new $NomClass();
           
        $action=HTTPHelper::get('action',$ClassInstance->getActionParDefaut());
        $ClassInstance->executer($action);  
        }
       Page::afficher();
    }
    public static function getcontrolleurCourant(){
       return self::$controlleurCourant; 
    }
public static function getactionCourante(){
    return self::$actionCourante;   
    }
    public static function useHelper($nomHelper){
    
        $cheminHelper='application/helpers/'.$nomHelper.'.php';
        if(!file_exists($cheminHelper)){
            
            throw new Erreur('Helper introuvable');
        }
 else {
        require_once $cheminHelper; 
 }
    }
    public static function getcheminAbsolu(){
        return self::$cheminAbsolu;
    }
    public static function getPage(){
        return Page::getInstance();
        
    }
     public static function useModele($NomModele){
       $chemin='application/models/'.$NomModele.'.model.php'  ;
       if(!is_readable($chemin)){
           throw new Erreur('Model Introuvable');
       }
 else {
           require_once $chemin;     
       }
     }
     public function setControleurParDefaut($controleurParDefaut){
    
    if(isset($controleurParDefaut)){
        $this->controleurParDefaut=$controleurParDefaut; 
    }
    else {
        throw new Erreur("controleur inexistant");
    }   
}
public function getControleurParDefaut(){
    return $this->controleurParDefaut;
}
public function utiliserAuthentification(){
    try{
       Authentification::getInstance($this->configuration->auth_table,$this->configuration->auth_col_id,$this->configuration->auth_col_login,$this->configuration->auth_col_mot_de_passe,$this->configuration->auth_col_sel);
    }
 catch(Exception $ex){
    throw new Erreur('Authentification non configurer'.$ex->getMessage()); 
 }
}
}
 
