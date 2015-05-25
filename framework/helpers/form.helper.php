<?php
    defined('__FRAMEWORK3IL__') or die('Acces interdit');
    require_once 'framework/authentification.php';
     require_once 'framework/helpers/http.helper.php';
    abstract class FormHelper {
        const SESSION_KEY = 'framework3il.csrfToken';
        
        public static $cle = null;        
   
        private static function getCle() {   
            if(!isset($_SESSION[self::SESSION_KEY])){
                $_SESSION[self::SESSION_KEY]= hash('sha256',uniqid());                
            }
            return $_SESSION[self::SESSION_KEY];
        }
        
        public static function cleCSRF() {  
         //  $clef= FormHelper::getCle();
         $cle= self::getCle();
      
            ?>
<input type="hidden" name="<?php echo $cle;?>" value="0"></input>
       <?php }
        
        public static function validerCleCSRF(){   
            if(!isset($_SESSION[self::SESSION_KEY])){
                return false;
            }
            
          $valeur= HTTPHelper::post($_SESSION[self::SESSION_KEY],'');
          if($valeur!=="0"){
              return false;
          }
          return true;
        }
        
    }

