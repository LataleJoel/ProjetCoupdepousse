<?php
require_once 'framework/helpers/form.helper.php';
//require_once 'application/models/coup_de_pouce.model.php';
//require_once 'framework/application.php';

Application::useModele('coup_de_pouce');
class Coup_de_pouceController extends Controller{
  
    public function __construct() {
      
    }
    public function afficherAction(){
 $page=Application::getPage();
 $page->setTemplate('index');
 $page->setVue('afficher_coup_de_pouce');
 
 $id=  HTTPHelper::get('id');
 $id=  filter_var($id,FILTER_SANITIZE_NUMBER_INT);
 if(!filter_var($id,FILTER_VALIDATE_INT)){
     throw new Erreur("Id Non Conforme");
 }
 $model=new Coups_De_PouceModel();
 $cdp=$model->detail($id);
 if($cdp){
     throw new Erreur("Coup de pouce Introuvable".$id);
 }
 $page->cdp=$cdp;
}
    public  function listerAction(){
      $page=Application::getPage();
 $page->setTemplate('application');
 $page->setVue('lister_coup_de_pouce');
    }
    public  function supprimerAction(){
            echo __METHOD__;
    }
   
    public function ajouterAction() {
        $page=Application::getPage();
        $page->setTemplate('index');
 $page->setVue('editer_coup_de_pouce'); 
 Page::ajouterCSS('form');
 Page::ajouterCSS('ajouter_utilisateur');
 Page::ajouterCSS('coupsdepousse');
        // A - Si non authentifiÃ©, rediriger vers Erreur avec le message "Vous devez Ãªtre connectÃ©"
        if(!Authentification::estConnecte()){
       HTTPHelper::rediriger('?controller=erreur','Vous devez etre Connecter Pour Ajouter un coup de pouce');   
 $form=new FormationsModel();
 
 $page->listeFormations=$form->lister();
 $page->formation=filter_var(HTTPHelper::post('formation',''),FILTER_SANITIZE_STRING);
       $page->titre=filter_var(HTTPHelper::post('titre',''),FILTER_SANITIZE_STRING);
 $page->titre= trim($page->titre);
 $page->accroche=filter_var(HTTPHelper::post('accroche',''),FILTER_SANITIZE_STRING);
 $page->accroche= trim($page->accroche);
 $page->description=filter_var(HTTPHelper::post('description',''),FILTER_SANITIZE_STRING);
 $page->description= trim($page->description);
 $page->salle=filter_var(HTTPHelper::post('salle',''),FILTER_SANITIZE_STRING);
$page->salle= trim($page->salle);
$page->place=filter_var(HTTPHelper::post('place',''),FILTER_SANITIZE_NUMBER_INT);
 if($_SERVER['REQUEST_METHOD']=='GET'){
    return $page->formMessage; 
 }
$valcle=FormHelper::validerCleCSRF();
if(!$valcle){
    throw new Erreur('session invalide');
}
if($page->formation=='---'){
   return $page->formMessage='Veuillez choisir une formation';      
 }
 if(!$form->estValide($page->formation)){
      return $page->formMessage='Formation inconnue';
 }
if($page->place<1&&$page->place>10){
  throw new Erreur('choix entre 1 et 10');
         }
        if(strlen($page->titre)>256){
  throw new Erreur('Le Nom doit etre inférieur a 256 caractères');
         }  else if(empty($page->titre)){
    return $page->formMessage='Veuillez Remplir le champ Titre';
 }
      if(strlen($page->accroche)>256){
  throw new Erreur('Le champ Accroche doit etre inférieur a 256 caractères et ne doit etre vide'); 
        } else if(empty($page->accroche)){
    return $page->formMessage='Veuillez Remplir le champ Accroche';
 }
  if(strlen($page->description)>2048){
  throw new Erreur('Le champ Description doit etre inférieur a 256 caractères et ne doit etre vide'); 
        } else if(empty($page->description)){
    return $page->formMessage='Veuillez Remplir le champ Description';
 }
 if(strlen($page->salle)>32){
  throw new Erreur('Le champ Salle doit etre inférieur a 256 caractères et ne doit etre vide'); 
        } else if(empty($page->salle)){
    return $page->formMessage='Veuillez Remplir le champ Salle';
 }
 if(strlen($page->description)>2048){
  throw new Erreur('Le champ Description doit etre inférieur a 256 caractères et ne doit etre vide'); 
        } else if(empty($page->description)){
    return $page->formMessage='Veuillez Remplir le champ Description';
 }
         
         
        }
        // B - Appeler la mÃ©thode de rÃ©cupÃ©ration des donnÃ©es
        $this->_recuperation();
        // C - Appeler la mÃ©thode du formulaire avec pour paramÃ¨tre 'ajouter'
       $this->_formulaire('ajouter');
    }

    
    private function _recuperation() {
        // D - Charger la Page
    $page=Application::getPage();
   
        // E - RÃ©cupÃ©rer l'id dans POST avec 0 comme valeur par dÃ©faut
         $page->id=HTTPHelper::post('id','0');
        // F - RÃ©cupÃ©rer le titre dans POST avec '' comme valeur par dÃ©faut, en faire un filter_var() + trim()
         $page->titre=HTTPHelper::post('titre','');
    }

    
    
    private function _formulaire($action) {
        // G - Charger la Page
      $page=Application::getPage();
    
        //   - RÃ©glages template + vue
        $page->setTemplate('application');
         $page->setVue('editer_coup_de_pouce');
           Page::ajouterCSS('form');
           Page::ajouterCSS('coupsdepousse');
            Page::ajouterCSS('reset');
        //   - Ajouter le paramÃ¨tre $action dans Page
       $page->action=$action;
        // H - Si "envoyer" ne figure pas dans POST, return
         if(is_null($page->envoyer=HTTPHelper::post('envoyer'))){
           return ;}
        // I - Si le titre est vide, l'indiquer dans formMessage + return
         if(is_null($page->titre=HTTPHelper::post('titre'))){
             $page->formMessage;
           return ;
           
         }
        // J - Suivant le paramÃ¨tre $action exÃ©cuter sur le modÃ¨le sauver() ou modifier()
        //   - Adapter le message Ã  envoyer Ã  la redirection
          $model= new Coups_De_PouceModel() ;
        if($action=='ajouter'){
           $this->ajouterAction();
          $model->modifier($page->id,$action);
          Authentification::rediriger('?controller=coup_de_pouce&action=ajouter');
        }
        else if($action=='editer'){
         $this->editerAction();
           $model->modifier($page->id,$action);
         Authentification::rediriger('?controller=coup_de_pouce&action=editer');
        }

        
        // K - Rediriger vers la liste des coups de pouce         
    }
    
    
    
    public function editerAction() {
         $page=Application::getPage();
          Page::ajouterCSS('form');
           Page::ajouterCSS('reset');
           Page::ajouterCSS('coupsdepousse');
           Page::ajouterCSS('editer_coup_de_pouce');
        // L - Si non authentifiÃ©, rediriger vers Erreur avec le message "Vous devez Ãªtre connectÃ©"
        if(!Authentification::estConnecte()){
         HTTPHelper::rediriger('?controller=erreur','Vous devez etre Connecté');   
        }
        
        // M - RÃ©cupÃ©rer dans le POST l'id du coup pouce Ã  Ã©diter, valeur par dÃ©faut 0
        //   - Si l'id == 0, rediriger vers Erreur avec le message "Erreur Ã©dition coup de pouce"
        $page->id=HTTPHelper::post('id',0);
        if( $page->id==0){
         HTTPHelper::rediriger('?controller=erreur','Erreur Edition Coup De Pouce');    
        }
        // N - Charger le coup de pouce depuis le modÃ¨le
        //   - Si le modÃ¨le est null, rediriger vers Erreur avec le message "Erreur Ã©dition coup de pouce"
       $men= new Coups_De_PouceModel();
       if($men==null){
          HTTPHelper::rediriger('?controller=erreur','Erreur Edition Coup De Pouce');   
       }
        // O - Si l'utilisateur connectÃ© n'est pas le propriÃ©taire, rediriger vers Erreur avec le message "Vous n'Ãªte pas le propriÃ©taire du coup de pouce"
   if($page->id!==Authentification::getUtilisateurId()){
       HTTPHelper::rediriger('?controller=erreur','Vous n etes pas le propietaire de ce Coup De Pouce');  
   }
        // P - Si "envoyer" ne figure pas dans POST
        //   - TransfÃ©rer les donnÃ©es du coup de pouce chargÃ© dans la Page
        //   - Sinon lancer la rÃ©cupÃ©ration des donnÃ©es
        if(is_null(HTTPHelper::post('envoyer'))){           
         $cdp=detail($page->id);  
         
         $page->titre=$cdp['titre'];
         $page->accroche=$cdp['accroche'];
          $page->description=$cdp['description'];
         
        }else{
         $this->recuperation();   
        }
        // Q - Lancer le formulaire avec pour paramÃ¨tre 'editer'   
        $this->_formulaire('editer');
    }
}

