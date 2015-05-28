<?php
class IndexController extends Controller{
  public function __construct() {
 $this->setActionParDefaut('index');       
    }
public function indexAction(){
  $page=Application::getPage(); 
 $page->setTemplate('index');
 $page->setVue('index');
  $page->ajouterCSS('coupsdepousse');
}
}
