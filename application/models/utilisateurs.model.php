<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    
    class UtilisateursModel extends Model {

        public function enregistrer($nom,$prenom,$login,$email,$mdp,$form) { 
          //  $sel= date(self::DATE_COOKIE);
            
            $sql = "INSERT INTO utilisateurs SET nom = :nom, prenom = :prenom,login=:login,email=:email,mot_de_passe=:mot_de_passe,formation=:formation,creation=:creation";
            
            $req = $this->db->prepare($sql);
            $req->bindValue(':nom',$nom); 
            $req->bindValue(':prenom',$prenom);
            $req->bindValue(':login',$login);
            $req->bindValue('mot_de_passe', Authentification::encoder($mdp,date('Y-m-d H:i:s'))); 
            $req->bindValue(':email',$email);             
            $req->bindValue('creation',date('Y-m-d H:i:s'));
             $req->bindValue('formation',$form);
            try {
                $req->execute();
            } catch (PDOException $ex) {
                throw new Erreur("Erreur SQL ".$ex->getMessage());
            }    
        }
        public function loginExiste($login){
          $sql="SELECT count(*) FROM utilisateurs WHERE login = :login" ;
          $req=$this->db->prepare($sql);
          $req->bindValue(':login',$login, PDO::PARAM_STR);
          try {
                $req->execute();
            } catch (PDOException $ex) {
                throw new Erreur("Erreur SQL ".$ex->getMessage());
            }         
            if($req->fetchColumn()){
                 $page=Application::getPage();
                 return $page->formMessage='Cet utilisateur existe deja';
           
              
        }
    }
    
    }   // william';INSERT INTO utilisateurs SET nom='Mechant', prenom='Pirate
