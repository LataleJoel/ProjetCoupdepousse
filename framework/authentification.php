<?php
    defined('__FRAMEWORK3IL__') or die('Acces interdit');
    
    class Authentification {
        protected $authTable;
        protected $authColId;
        protected $authColLogin;
        protected $authColMotDePasse;
        protected $authColSel;        
        protected static $utilisateur = null;
        
        private static $_instance = null;
        
        const SESSION_KEY = 'framework3il.authentification';
                
        
        private function __construct($authTable,$authColId,$authColLogin,$authColMotDePasse,$authColSel){
            $this->authTable            = $authTable;
            $this->authColId            = $authColId;
            $this->authColLogin         = $authColLogin;
            $this->authColMotDePasse    = $authColMotDePasse;
            $this->authColSel           = $authColSel;
        }
        
        
        public static function getInstance($authTable=null,$authColId=null,$authColLogin=null,$authColMotDePasse=null,$authColSel=null){
            if(is_null(self::$_instance)){                
                self::$_instance = new Authentification($authTable, $authColId, $authColLogin, $authColMotDePasse,$authColSel);                
            }
            return self::$_instance;
        }
        
        public static function authentifier($login,$motDePasse){
            
            $db=Application::getDB();
            $req='SELECT '.self::$_instance->authColId.','.self::$_instance->authColMotDePasse.','.self::$_instance->authColSel.' FROM '.self::$_instance->authTable.' where '.self::$_instance->authColLogin.'=:login;';
           
            $sql= $db->prepare($req);
            $sql->bindValue('login',$login);
          
            
            try{
                $sql->execute();
            } catch (Exception $ex) {
                throw new Erreur('Erreur sql'.$ex->getMessage());
            }    
            $data=$sql->fetch(PDO::FETCH_ASSOC);
            $mdp=self::encoder($motDePasse, $data[self::$_instance->authColSel]);
            if($mdp==$data[self::$_instance->authColMotDePasse]){
              
              $_SESSION[self::SESSION_KEY]=$data[self::$_instance->authColId]; 
              return TRUE;
            }
            else{
                return FALSE;
            }
        }
        
        public static function chargerUtilisateur() {
           if(!isset($_SESSION[self::SESSION_KEY])){
               throw new Erreur('Utilisateur Non Connecter!');
           }  else {
                $db=Application::getDB();
           $req='SELECT '.self::$_instance->authColId.','.self::$_instance->authColLogin.','.self::$_instance->authColMotDePasse.','.self::$_instance->authColSel.' FROM '.self::$_instance->authTable.' where '.self::$_instance->authColId.'=:id;';
           
            $sql= $db->prepare($req);
            $sql->bindValue('id',$_SESSION[self::SESSION_KEY]);
            try{
                $sql->execute();
            } catch (Exception $ex) {
                throw new Erreur('Erreur sql'.$ex->getMessage());
            }    
            $data=$sql->fetch(PDO::FETCH_ASSOC);
           }
          unset($data[self::$_instance->authColMotDePasse]) ;
        }
        
        public static function deconnecter() {
            self::$utilisateur = null;  
            unset($_SESSION[self::SESSION_KEY]);
            session_destroy($_SESSION[self::SESSION_KEY]);
            
        }
        
        public static function estConnecte() {
          if(isset($_SESSION[self::SESSION_KEY])){
                return true; 
          } 
        }
        
        public static function getUtilisateur() {
           if(self::$utilisateur==null) {
              self::$utilisateur= Authentification::chargerUtilisateur(); 
           }
           return self::$utilisateur;
        }
        
        public static function getUtilisateurId() {
          if(!isset($_SESSION[self::SESSION_KEY])){
           throw new Erreur("Utilisateur Non Connecté") ;
          }
          return $_SESSION[self::SESSION_KEY];
        }
        
        public static function encoder($motDePasse,$sel){
           
            $hashsel=hash('sha256',$sel);
            $hashmdp= hash('sha256',$motDePasse);
            $mdpEnc=hash('sha256',$hashmdp+$hashsel);
            return $mdpEnc;
        }
        
    }
