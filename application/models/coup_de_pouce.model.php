<?php
defined('__COUPDEPOUCE__') or die('Acèss Interdit');

 class Coups_De_PouceModel extends Model{
   
     public function detail($id){
         if($id==0){
             throw new Erreur('Mauvais Identifiant');
         } 
 
          $sql="SELECT * FROM coup_de_pouce WHERE id= :id";
          $req=$this->db->prepare($sql);
                $req->bindValue(':id',$id);
                try{
                    $req->execute();
                } catch (PDOException $ex) {
                    throw new Erreur('Erreur SQL'.$ex->getMessage());
                }
                $data=$req->fetchAll(PDO::FETCH_ASSOC);
                print_r($data);
 }
 public function sauver($titre,$accroche,$description,$date,$salle,$formation){
     $dateform=format($date);
    $db=Application::getDB();
  $sql="INSERT INTO coup_de_pouce set titre=:titre, utilisateur_id=:utilisateur_id,accroche=:accroche,date=:date,salle=:salle,place=:place,formation=:formation,creation=:creation;";
          $req=$db->prepare($sql);
                $req->bindValue(':titre',$titre);
                $req->bindValue(':utilisateur_id',Authentification::getUtilisateurId());
                $req->bindValue(':accroche',$accroche);
                $req->bindValue(':date',$dateform);
                $req->bindValue(':description',$description);
                $req->bindValue(':salle',$salle);
                $req->bindValue(':formation',$formation);
                $req->bindValue('creation',date('Y-m-d H:i:s'));
                try{
                    $req->execute();
                } catch (PDOException $ex) {
                    throw new Erreur('Erreur SQL'.$ex->getMessage());
                }
              /*  $data=$req->fetchAll(PDO::FETCH_ASSOC);
                print_r($data);*/
 }
public function modifier($id,$titre,$accroche,$description,$date,$salle,$formation){
   $dateform=format($date);
    $db=Application::getDB();
  $sql="INSERT INTO coup_de_pouce set titre=:titre, utilisateur_id=:utilisateur_id,accroche=:accroche,date=:date,salle=:salle,place=:place,formation=:formation,creation=:creation;";
          $req=$db->prepare($sql);
          $req->bindValue(':id',$id);
                $req->bindValue(':titre',$titre);
                $req->bindValue(':utilisateur_id',Authentification::getUtilisateurId());
                $req->bindValue(':accroche',$accroche);
                $req->bindValue(':date',$dateform);
                $req->bindValue(':description',$description);
                $req->bindValue(':salle',$salle);
                $req->bindValue(':formation',$formation);
                $req->bindValue('creation',date('Y-m-d H:i:s'));
                try{
                    $req->execute();
                } catch (PDOException $ex) {
                    throw new Erreur('Erreur SQL'.$ex->getMessage());
                }   
}
         
     }
    
     
     
 