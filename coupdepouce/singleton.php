<?php
class Singleton{
    private static $_instance=null;
    private  function __construct() {
        
    }
    private static function __getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance=new Singleton();
        }
        return self::$_instance;
    }
}

