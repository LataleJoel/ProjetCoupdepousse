<?php
defined('__COUPDEPOUCE__')or die('Access Interdit');
class ErreurController extends Controller{
   
    public function __construct(){
    $this->setActionParDefaut('erreur') ;   
    }

    public function erreurAction(){
      
$page=Application::getPage();
 $page->setTemplate('application');
 $page->setVue('erreur');
 $page->ajouterCSS('coupsdepousse');
 $page->message=Message::retirer();
}

}