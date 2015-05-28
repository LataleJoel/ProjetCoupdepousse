<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    
    class FormationsModel extends Model {
        static private $_formations = array('I1','I2','I3','B3','M1','M2');
        
        public function lister() {
            return self::$_formations;
        }
        
        public function estValide($formation){
            return in_array($formation, self::$_formations);
        }
        
    }