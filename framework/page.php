<?php
defined('__FRAMEWORK3IL__') or die('Access Interdit');
class Page{
    protected static $CSS=array();
   public $formMessage='';
    protected $vue=null;
     protected $template=null;
    private static $_instance=null;
    private function __construct() {   
    }
    public static function getInstance() {
     if(is_null(self::$_instance)) {
         self::$_instance= new Page() ;
     } 
     return self::$_instance;
    }
    public function setVue($fich){ 
        $fich='application/views/'.$fich.'.view.php';
       if(!is_readable($fich)){
         throw new Erreur('Fichier de Vue Inexistant');
       } 
         else{
           return $this->vue=$fich;
       }
    }
     public function setTemplate($fich){
         $fich='application/templates/'.$fich.'.template.php';
       if(!is_readable($fich)){
         throw new Erreur('Fichier de Template Inexistant');
       }
       else{
           return $this->template=$fich;
       }
    }   
    public static function afficher(){
        if(empty(self::$_instance->template)){
         throw new Erreur('Template non Renseigné');    
    }
 else {
        require_once self::$_instance->template; 
    }
    
}
  public function insererVue(){
           
    require_once self::$_instance->vue; 
}
  public static function afficherVue(){
        if(empty(self::$_instance->vue)){
         throw new Erreur('Vue non Renseignée');    
    }
 else {
       self::$_instance->insererVue();  
    }
   
}
public function ajouterCSS($param){
    $chem='styles/'.$param.'.css';
    if(file_exists($chem)){
        array_push(self::$CSS, $chem);
       
    }
    else{
        throw new Erreur('fichiers css introuvable');
    }
}
public static function enteteCSS(){
    foreach (self::$CSS as $val) {
        ?>
<link rel="stylesheet"  MEDIA="screen" TYPE="text/css" href=<?php echo $val ?>>                 
  <?php       
    }
}
}

