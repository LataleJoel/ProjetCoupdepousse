<?php
defined('__FRAMEWORK3IL__') or die('Access Interdit');
abstract class Controller{
    protected $actionParDefaut='';
    
 public function executer($NomAction){
     $methode=$NomAction.'Action';  
     if(!method_exists($this,$methode)){  
         throw new Erreur('Methode Inexistante');
     }
       $this->$methode();        
}
public function setActionParDefaut($actionParDefaut){
    
    if(isset($actionParDefaut)){
        $this->actionParDefaut=$actionParDefaut; 
    }
    else {
        throw new Erreur("action inexistante");
    }
     
}
public function getActionParDefaut(){
    return $this->actionParDefaut;
}


}
