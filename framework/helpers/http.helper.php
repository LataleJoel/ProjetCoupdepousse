<?php
defined('__FRAMEWORK3IL__')or die('Access Interdit');
abstract class HTTPHelper{
    private static function fetch($source,$cle,$defaut=null){
        if(isset($source[$cle])){
            return  $source[$cle];
        }
        return $defaut;
    }
    public static function get($cle,$defaut=null){
        return self::fetch($_GET,$cle,$defaut);
    }
    public static function post($cle,$defaut=null){
        return self::fetch($_POST,$cle,$defaut);
    }
    /**
     * Redirection avec Message
     * @param string $url
     * @param string $message
     */
    public static function rediriger($url,$message=null) {            
     if($message!==null){
        Message::deposer($message); 
    }
    if(!headers_sent()) {                        
        header('Location:'.$url);  
        die();
    } else {                
        ?>
        <script type="text/javascript">
            window.location = "<?php echo $url;?>";
        </script>
        <?php
    }
   
}
}

