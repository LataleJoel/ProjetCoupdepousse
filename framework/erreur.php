<?php
defined('__FRAMEWORK3IL__')or die('Access Interdit');
class Erreur extends Exception{
   public function __construct($message) {
       parent::__construct($message, null, null);
   }
   public function __toString() {
       $config=Configuration::getInstance();
 if($config->__get('debug')==1){
     require_once 'framework/erreur_debug.php';
 }
 else {
    require_once 'framework/erreur_production.php'; 
 }
 die(); 
   }
   
    
    
}
