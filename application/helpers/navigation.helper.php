<?php
defined('__COUPDEPOUCE__') or die('Access Interdit');
abstract class NavigationHelper{
  
  

    const VISIBILITE_CONSTANTE=0;
    const VISIBILITE_CONNECTE=1;
    const VISIBILITE_NONCONNECTE=2;
    public static $menu=Array(
        Array('titre'=>'ACCEUIL','controller'=>'index','action'=>'index','visibilite'=>self::VISIBILITE_CONSTANTE),
        Array('titre'=>"PROCHAINES SESSIONS",'controller'=>'utilisateurs','action'=>'seconnecter','visibilite'=>self::VISIBILITE_CONSTANTE),
        Array('titre'=>"S'IDENTIFIER",'controller'=>'utilisateurs','action'=>'seconnecter','visibilite'=>self::VISIBILITE_CONNECTE),
        Array('titre'=>"Se Deconnecter",'controller'=>'utilisateurs','action'=>'deconnecter','visibilite'=>self::VISIBILITE_NONCONNECTE));
    public static function afficher(){
        ?>
            <ul> 
                <?php
        foreach(self::$menu as $val){ 
        switch ($val['visibilite']) {
            case 0:
                self::menuItem($val['titre'],$val['controller'],$val['action']);

                break;

            case 1:
                if(!Authentification::estConnecte()){
                 self::menuItem($val['titre'],$val['controller'], $val['action']);    
                }
                break;
            case 2:
              if(Authentification::estConnecte()){
                 self::menuItem($val['titre'], $val['controller'], $val['action']);    
                }  
                break;
        }
        }
   ?> 
       </ul> 
           <?php  
    } 
      public static function menuItem($M,$controleur,$action){
           // $class = "nav-current";
       
            if(HTTPHelper::get('controller')==$controleur & HTTPHelper::get('action')==$action){
                $class = "nav-current";
            }   
            ?>
            <li class="nav-item <?php echo $class ;?>"><a href="?controller=<?php echo $controleur;?>&action=<?php echo $action ;?>"><?php echo $M;?></a></li>
            <?php          
        }
    }
    /*
         <li class="nav-item nav-current"> <a href="?controller=index&action=index" >Acceuil</a></li>  
                    <li class="nav-item"> <a href="#" >Prochaines Sessions </a></li>  
                    <li class="nav-item"><a href="#" >S'identifier</a></li>
     
     */