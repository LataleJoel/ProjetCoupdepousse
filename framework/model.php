<?php
defined('__FRAMEWORK3IL__') or die('Acèss Interdit');
require_once 'framework/application.php';
abstract class Model{
    protected $db=null;
    public function __construct(){
        $this->db=  Application::getDB();
    }
  
}


